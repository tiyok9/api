<?php

namespace App\Http\Controllers;

use App\Service\DepartemenService;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    protected $departemen;

    /**
     * @param $departemen
     */
    public function __construct(DepartemenService$departemen)
    {
        $this->departemen = $departemen;
    }
}
