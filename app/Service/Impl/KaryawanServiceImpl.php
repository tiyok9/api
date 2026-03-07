<?php

namespace App\Service\Impl;

use App\Repositories\KaryawanRepository;
use App\Service\KaryawanService;

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
}
