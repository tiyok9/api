<?php

namespace App\Service\Impl;

use App\Repositories\JenisCutiRepository;
use App\Service\JenisCutiService;

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
}
