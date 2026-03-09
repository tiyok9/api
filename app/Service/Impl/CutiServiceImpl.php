<?php

namespace App\Service\Impl;

use App\Repositories\CutiRepository;
use App\Service\CutiService;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        $imagePath = null;

        try {
            $tanggalMulai = Carbon::parse($data['tanggal_mulai']);
            $tanggalSelesai = Carbon::parse($data['tanggal_selesai']) ?? 0 ;

            $jumlahHari = $tanggalMulai->diffInDays($tanggalSelesai) + 1;
            if (isset($data['img']) && $data['img']->isValid()) {
                $filename = time() . '.' . $data['img']->extension();
                $imagePath = $data['img']->storeAs('cuti', $filename, 'public');
                $data['img'] = $imagePath;
            } else {
                unset($data['img']);
            }

            $data['id_karyawan'] = auth()->user()->karyawan->id ?? 'b0c5e6ce-4a81-4292-85c6-9e7966a262da';
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
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            Log::error($e->getMessage());
            return false;
        }
    }

    public function update($data,$id)
    {
        DB::beginTransaction();
        try {
            $data['approved_by'] = auth()->user()->id ?? '1eb2b999-33a1-48ca-bd18-2be4a2f80ab5';
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
