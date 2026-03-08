<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKaryawanRequest;
use App\Service\KaryawanService;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    protected $karyawan;

    /**
     * @param $karyawan
     */
    public function __construct(KaryawanService $karyawan)
    {
        $this->karyawan = $karyawan;
    }
    public function getData(Request $request)
    {
        $search = $request->search;

        return $this->karyawan->getData($search);
    }

    public function store(StoreKaryawanRequest $request)
    {
        $data = $request->validated();
        $response = $this->karyawan->store($data);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function update(StoreKaryawanRequest $request, $id)
    {
        $data = $request->validated();
        $response = $this->karyawan->update($data,$id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function destroy($id)
    {
        $response = $this->karyawan->destroy($id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }
}
