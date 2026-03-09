<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJabatanRequest;
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

    public function getData(Request $request)
    {
        $search = $request->search;

        return $this->jabatan->getData($search);
    }

    public function store(StoreJabatanRequest $request)
    {
        $data = $request->validated();
        $response = $this->jabatan->store($data);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function update(StoreJabatanRequest $request, $id)
    {
        $data = $request->validated();
        $response = $this->jabatan->update($data,$id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function destroy($id)
    {
        $response = $this->jabatan->destroy($id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function getJabatanById($id)
    {
        return $this->jabatan->getJabatanById($id);
    }
}
