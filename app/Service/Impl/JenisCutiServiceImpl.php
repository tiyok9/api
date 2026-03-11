<?php

namespace App\Service\Impl;

use App\Repositories\JenisCutiRepository;
use App\Service\JenisCutiService;
use Exception;
use Illuminate\Support\Facades\Log;

class JenisCutiServiceImpl implements JenisCutiService
{
    protected $jenisCuti;

    /**
     * @param $jenisCuti
     */
    public function __construct(JenisCutiRepository $jenisCuti)
    {
        $this->jenisCuti = $jenisCuti;
    }

    public function getData($search = '',$perPage=10)
    {
        try {
            return $this->jenisCuti->getData($search,$perPage);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }
    }

    public function store(mixed $data)
    {
        try {
            return $this->jenisCuti->store($data);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }

    public function update(mixed $data, $id)
    {
        try {
            return $this->jenisCuti->update($data, $id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }

    public function destroy($id)
    {
        try {
            return $this->jenisCuti->destroy( $id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }

    public function getJenisCutiById($id)
    {
        try {
            return $this->jenisCuti->getJenisCutiById($id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }    }
}
