<?php

namespace App\Service\Impl;

use App\Repositories\DepartemenRepository;
use App\Service\DepartemenService;
use Exception;
use Illuminate\Support\Facades\Log;

class DepartemenServiceImpl implements DepartemenService
{
    protected $departemen;

    /**
     * @param $departemen
     */
    public function __construct(DepartemenRepository $departemen)
    {
        $this->departemen = $departemen;
    }

    public function getData($search = '',$perPage=10)
    {
        try {
            return $this->departemen->getData($search,$perPage);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }
    }

    public function store(mixed $data)
    {
        try {
            return $this->departemen->store($data);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }

    public function update(mixed $data, $id)
    {
        try {
            return $this->departemen->update($data, $id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }

    public function destroy($id)
    {
        try {
            return $this->departemen->destroy( $id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }

    public function getDepartementById($id)
    {
        try {
            return $this->departemen->getDepartementById($id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }    }

}
