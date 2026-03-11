<?php

namespace App\Http\Controllers;

use App\Service\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboard;

    /**
     * @param $dashboard
     */
    public function __construct(DashboardService $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    public function rekap()
    {
        return $this->dashboard->rekap();
    }

    public function graph()
    {
        return $this->dashboard->graph();
    }

    public function graphClient()
    {
        return $this->dashboard->graphClient();

    }
}
