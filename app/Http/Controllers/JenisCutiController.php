<?php

namespace App\Http\Controllers;

use App\Service\JenisCutiService;
use Illuminate\Http\Request;

class JenisCutiController extends Controller
{
    protected $jenisCuti;

    /**
     * @param $jenisCuti
     */
    public function __construct(JenisCutiService $jenisCuti)
    {
        $this->jenisCuti = $jenisCuti;
    }
}
