<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use App\Http\Resources\KaryawanResource;
use App\Service\AbsensiService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

class AbsensiController extends Controller
{
    protected $absensi;

    /**
     * @param $absensi
     */
    public function __construct(AbsensiService $absensi)
    {
        $this->absensi = $absensi;
    }

    public function getData(Request $request)
    {
        $search = $request->search;
        $perPage = $request->per_page;

        return $this->absensi->getData($search,$perPage);
    }

    public function getDataUser()
    {
        return $this->absensi->getDataUser();
    }
    public function absen(StoreAbsensiRequest $request)
    {
        $data = $request->validated();
        $response = $this->absensi->absen($data);
        if ($response) {
            return new KaryawanResource($response);
        }

        return response()->json($response, 400);
    }
    public function note(UpdateAbsensiRequest $request,$id)
    {
        $data = $request->validated();
        $response = $this->absensi->note($data,$id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function getRekap()
    {
        return $this->absensi->getRekap();
    }
    public function export()
    {
        try {

            $fileName = "absensi.csv";

            $headers = [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
            ];

            $callback = function () {

                $file = fopen('php://output', 'w');

                fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

                fputcsv($file, [
                    'Nama Karyawan',
                    'Tanggal',
                    'Jam Masuk',
                    'Jam Keluar',
                    'Status',
                    'Catatan'
                ]);

                $data = $this->absensi->getExport();

                foreach ($data as $item) {
                    $status = Carbon::parse($item->jam_masuk)->format('H:i:s') <= '07:00:00'
                        ? 'Present'
                        : 'Late';

                    fputcsv($file, [
                        $item->karyawan?->nama ?? '-',
                        Carbon::parse($item->tanggal)->translatedFormat('l, d F Y'),
                        Carbon::parse($item->jam_masuk)->format('H:i'),
                        $item->jam_keluar
                            ? Carbon::parse($item->jam_keluar)->format('H:i')
                            : 'Not Checked Out',
                        $status,
                        $item->note ?? '-'
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);

        } catch (Throwable $e) {

            Log::error('Export Absensi CSV Failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal export data absensi'
            ], 500);
        }
    }
}
