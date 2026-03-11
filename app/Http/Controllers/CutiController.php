<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCutiRequest;
use App\Http\Requests\UpdateStatusCutiRequest;
use App\Service\CutiService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

class CutiController extends Controller
{
    protected $cuti;

    /**
     * @param $cuti
     */
    public function __construct(CutiService $cuti)
    {
        $this->cuti = $cuti;
    }


    public function getData(Request $request)
    {
        $search = $request->search;
        $perPage = $request->per_page;

        return $this->cuti->getData($search,$perPage);
    }

    public function store(StoreCutiRequest $request)
    {
        $data = $request->validated();
        $response = $this->cuti->store($data);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function updateStatus(UpdateStatusCutiRequest $request,$id)
    {
        $data = $request->validated();
        $response = $this->cuti->update($data,$id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }
    public function export()
    {
        try {
            $fileName = "cuti.csv";
            $headers = [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
            ];

            $callback = function () {
                $file = fopen('php://output', 'w');

                fputcsv($file, [
                    'Nama Karyawan',
                    'Jenis Cuti',
                    'Tanggal Mulai',
                    'Tanggal Selesai',
                    'Jumlah Hari',
                    'Alasan',
                    'Status',
                    'Approved By',
                    'Approved At'
                ]);

                $data = $this->cuti->getExport();

                foreach ($data as $item) {

                    fputcsv($file, [
                        $item->karyawan?->nama ?? '-',
                        $item->jenisCuti?->jenis_cuti ?? '-',
                        Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y'),
                        $item->tanggal_selesai
                            ? Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y')
                            : '-',
                        $item->jumlah_hari,
                        $item->alasan,
                        ucfirst($item->status),
                        $item->approvedBy?->karyawan->nama ?? '-',
                        $item->approved_at
                            ? Carbon::parse($item->approved_at)->translatedFormat('d F Y H:i')
                            : '-'
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);

        } catch (Throwable $e) {
            Log::error('Export Cuti CSV Failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal export data cuti'
            ], 500);
        }
    }

}
