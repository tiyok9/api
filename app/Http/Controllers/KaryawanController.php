<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKaryawanRequest;
use App\Service\KaryawanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class KaryawanController extends Controller
{
    protected $karyawan;

    /**
     * @param $karyawan
     */
    public function __construct(KaryawanService $karyawan)
    {
        $this->karyawan = $karyawan;
    }
    public function getData(Request $request)
    {
        $search = $request->search;
        $perPage = $request->per_page;

        return $this->karyawan->getData($search,$perPage);
    }

    public function store(StoreKaryawanRequest $request)
    {
        $data = $request->validated();
        $response = $this->karyawan->store($data);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function update(StoreKaryawanRequest $request, $id)
    {
        $data = $request->validated();
        $response = $this->karyawan->update($data,$id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function destroy($id)
    {
        $response = $this->karyawan->destroy($id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function updateStatus($id)
    {
        $response = $this->karyawan->updateStatus($id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function getKaryawanById($id)
    {
        return $this->karyawan->getKaryawanById($id);
    }

    public function export()
    {
        try {
            $fileName = "karyawan.csv";
            $headers = [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
            ];
            $callback = function () {

                try {
                    $file = fopen('php://output', 'w');
                    fputcsv($file, [
                        'Nama',
                        'NIK',
                        'No_HP',
                        'Alamat',
                        'Aktif',
                        'Jabatan',
                    ]);
                    fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

                    $data = $this->karyawan->getExport();
                    foreach ($data as $item) {
                        fputcsv($file, [
                            $item->nama,
                            $item->nik,
                            $item->no_hp,
                            $item->alamat,
                            $item->aktif ? 'Aktif' : 'Tidak Aktif',
                            $item->jabatan?->jabatan ?? '-',
                        ]);
                    }

                    fclose($file);

                } catch (Throwable $e) {
                    Log::error('Export CSV Error', [
                        'message' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]);
                    throw $e;
                }
            };
            return response()->stream($callback, 200, $headers);

        } catch (Throwable $e) {
            Log::error('Export CSV Failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal export data karyawan'
            ], 500);
        }
    }
}
