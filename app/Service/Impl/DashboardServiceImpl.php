<?php

namespace App\Service\Impl;

use App\Repositories\DashboardRepository;
use App\Service\DashboardService;
use Exception;
use Illuminate\Support\Facades\Log;

class DashboardServiceImpl implements DashboardService
{
    protected $dashboard;

    /**
     * @param $dashboard
     */
    public function __construct(DashboardRepository $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    public function rekap()
    {
        try {
            return $this->dashboard->rekap();
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }
    }

    public function graph()
    {
        try {
            return $this->dashboard->graph();
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }
    }

    public function graphClient()
    {
        try {
            $idKaryawan = auth('api')->user()->id_karyawan;
            return $this->dashboard->graphClient($idKaryawan);
        }catch (Exception $e){

            Log::error($e->getMessage());
            return [];
        }
    }
}
