<?php

namespace App\Http\Controllers;

use App\Service\KaryawanService;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    protected $karyawan;

    /**
     * @param $karyawan
     */
    public function __construct(KaryawanService $karyawan)
    {
        $this->karyawan = $karyawan;
    }

}
