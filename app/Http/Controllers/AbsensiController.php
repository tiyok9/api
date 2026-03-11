<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use App\Http\Resources\KaryawanResource;
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
        $perPage = $request->per_page;

        return $this->absensi->getData($search,$perPage);
    }

    public function getDataUser()
    {
        return $this->absensi->getDataUser();
    }
    public function absen(StoreAbsensiRequest $request)
    {
        $data = $request->validated();
        $response = $this->absensi->absen($data);
        if ($response) {
            return new KaryawanResource($response);
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

    public function getRekap()
    {
        return $this->absensi->getRekap();
    }
}
