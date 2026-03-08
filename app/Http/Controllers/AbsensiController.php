<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
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

    public function getData(Request $request)
    {
        $search = $request->search;

        return $this->absensi->getData($search);
    }

    public function absen(StoreAbsensiRequest $request)
    {
        $data = $request->validated();
        $response = $this->absensi->absen($data);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }
    public function note(UpdateAbsensiRequest $request,$id)
    {
        $data = $request->validated();
        $response = $this->absensi->note($data,$id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }
}
