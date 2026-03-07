<?php

namespace App\Service\Impl;

use App\Repositories\AbsensiRepository;
use App\Service\AbsensiService;

class AbsensiServiceImpl implements AbsensiService
{
    private $absensi;

    /**
     * @param $absensi
     */
    public function __construct(AbsensiRepository $absensi)
    {
        $this->absensi = $absensi;
    }
}
