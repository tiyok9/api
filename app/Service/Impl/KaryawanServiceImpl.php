<?php

namespace App\Service\Impl;

use App\Repositories\KaryawanRepository;
use App\Service\KaryawanService;
use Exception;
use Illuminate\Support\Facades\Log;

class KaryawanServiceImpl implements KaryawanService
{
    protected $karyawan;

    /**
     * @param $karyawan
     */
    public function __construct(KaryawanRepository $karyawan)
    {
        $this->karyawan = $karyawan;
    }

    public function getData($search = '',$perPage=10)
    {
        try {
            return $this->karyawan->getData($search,$perPage);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }
    }

    public function store(mixed $data)
    {
        try {
            return $this->karyawan->store($data);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }

    public function update(mixed $data, $id)
    {
        try {
            return $this->karyawan->update($data, $id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }

    public function destroy($id)
    {
        try {
            return $this->karyawan->destroy( $id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }

    public function getKaryawanById($id)
    {
        try {
            return $this->karyawan->getKaryawanById($id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }
    }

    public function updateStatus($id)
    {
        try {
            return $this->karyawan->updateStatus( $id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }
}
