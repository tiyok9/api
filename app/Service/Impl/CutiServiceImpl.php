<?php

namespace App\Service\Impl;

use App\Repositories\CutiRepository;
use App\Service\CutiService;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CutiServiceImpl implements CutiService
{
    protected $cuti;

    /**
     * @param $cuti
     */
    public function __construct(CutiRepository $cuti)
    {
        $this->cuti = $cuti;
    }

    public function getData($search = '')
    {
        try {
            return $this->cuti->getData($search);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }
    }

    public function store(mixed $data)
    {
        DB::beginTransaction();
        try {
            $tanggalMulai = Carbon::parse($data['tanggal_mulai']);
            $tanggalSelesai = Carbon::parse($data['tanggal_selesai']);

            $jumlahHari = $tanggalMulai->diffInDays($tanggalSelesai) + 1;
            $data['id_karyawan'] = auth()->user()->karyawan->id ?? 'cd8b0c72-3d8c-4257-a6db-33382b73f1c7';
            $data['status'] = 'pending';
            $data['jumlah_hari'] = $jumlahHari;
            $response = $this->cuti->store($data);
            if ($response) {
                DB::commit();
                return true;
            }
            DB::commit();
            return false;
        }catch (Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }
    }

    public function update($data,$id)
    {
        DB::beginTransaction();
        try {
            $data['approved_by'] = auth()->user()->id ?? '1ec31b58-0db6-41c3-8a6e-8344e6da32e2';
            $data['approved_at'] = now();
            $response = $this->cuti->update($data,$id);
            if ($response) {
                DB::commit();
                return true;
            }
            DB::commit();
            return false;
        }catch (Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }
    }
}
