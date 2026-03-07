<?php

namespace App\Service\Impl;

use App\Repositories\DepartemenRepository;
use App\Service\DepartemenService;

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
}
