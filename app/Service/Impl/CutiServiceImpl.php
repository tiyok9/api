<?php

namespace App\Service\Impl;

use App\Repositories\CutiRepository;
use App\Service\CutiService;

class CutiServiceImpl implements CutiService
{
    protected $cuti;

    /**
     * @param $cuti
     */
    public function __construct(CutiRepository $cuti)
    {
        $this->cuti = $cuti;
    }
}
