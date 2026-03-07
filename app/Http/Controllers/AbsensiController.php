<?php

namespace App\Http\Controllers;

use App\Service\AbsensiService;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    protected $absensi;

    /**
     * @param $absensi
     */
    public function __construct(AbsensiService $absensi)
    {
        $this->absensi = $absensi;
    }
}
