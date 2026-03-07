<?php

namespace App\Service\Impl;

use App\Repositories\JabatanRepsitory;
use App\Service\JabatanService;

class JabatanServiceImpl implements JabatanService
{
    protected $jabatan;

    /**
     * @param $jabatan
     */
    public function __construct(JabatanRepsitory $jabatan)
    {
        $this->jabatan = $jabatan;
    }
}
