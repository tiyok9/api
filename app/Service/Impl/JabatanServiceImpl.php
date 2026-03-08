<?php

namespace App\Service\Impl;

use App\Repositories\JabatanRepsitory;
use App\Service\JabatanService;
use Exception;
use Illuminate\Support\Facades\Log;

class JabatanServiceImpl implements JabatanService
{
    protected $jabatan;

    /**
     * @param $jabatan
     */
    public function __construct(JabatanRepsitory $jabatan)
    {
        $this->jabatan = $jabatan;
    }


    public function getData($search = '')
    {
        try {
            return $this->jabatan->getData($search);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }
    }

    public function store(mixed $data)
    {
        try {
            return $this->jabatan->store($data);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }

    public function update(mixed $data, $id)
    {
        try {
            return $this->jabatan->update($data, $id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }

    public function destroy($id)
    {
        try {
            return $this->jabatan->destroy( $id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }
}
