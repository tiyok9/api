<?php

namespace App\Http\Controllers;

use App\Service\JabatanService;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    protected $jabatan;

    /**
     * @param $jabatan
     */
    public function __construct(JabatanService $jabatan)
    {
        $this->jabatan = $jabatan;
    }
}
