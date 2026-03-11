<?php

namespace App\Service\Impl;

use App\Repositories\AbsensiRepository;
use App\Service\AbsensiService;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AbsensiServiceImpl implements AbsensiService
{
    private $absensi;

    /**
     * @param $absensi
     */
    public function __construct(AbsensiRepository $absensi)
    {
        $this->absensi = $absensi;
    }
    public function getData($search = '',$perPage=10)
    {
        try {
            return $this->absensi->getData($search,$perPage);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }
    }

    public function absen(mixed $data)
    {
        DB::beginTransaction();
        try {
            $cekKaryawanAktif = $this->absensi->cekKaryawanAktif($data['nik']);
            if(!$cekKaryawanAktif){
                DB::rollBack();
                return false;

            }
            $cekAbsen = $this->absensi->cekAbsen($data['nik']);
            $getByNik = $this->absensi->getByNik($data['nik']);

            if (!empty($cekAbsen)) {
                $absensiData = [
                    'jam_keluar' => now(),
                ];
                $response = $this->absensi->pulang($absensiData,$cekAbsen->id);

            }else{
                $absensiData = [
                   'tanggal' => Carbon::now(),
                   'id_karyawan' => $getByNik->id,
                    'jam_masuk' => now(),
                ];
                $response = $this->absensi->masuk($absensiData);

            }
            if ($response) {
                DB::commit();
                return $getByNik;
            }
            DB::rollBack();
            return false;
        }catch (Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }
    }

    public function note(mixed $data,$id)
    {
        DB::beginTransaction();
        try {
            $response = $this->absensi->note($data,$id);
            if ($response) {
                DB::commit();
                return true;
            }
            DB::rollBack();
            return false;
        }catch (Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }
    }

    public function getDataUser()
    {
        try {
            $id = auth()->user()->id_karyawan;
            return $this->absensi->getDataUser($id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }
    }

    public function getRekap()
    {
        try {
            $id = auth()->user()->id_karyawan;
            return $this->absensi->getRekap($id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }
    }
}
