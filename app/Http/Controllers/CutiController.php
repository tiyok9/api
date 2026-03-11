<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCutiRequest;
use App\Http\Requests\UpdateStatusCutiRequest;
use App\Service\CutiService;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    protected $cuti;

    /**
     * @param $cuti
     */
    public function __construct(CutiService $cuti)
    {
        $this->cuti = $cuti;
    }


    public function getData(Request $request)
    {
        $search = $request->search;
        $perPage = $request->per_page;

        return $this->cuti->getData($search,$perPage);
    }

    public function store(StoreCutiRequest $request)
    {
        $data = $request->validated();
        $response = $this->cuti->store($data);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function updateStatus(UpdateStatusCutiRequest $request,$id)
    {
        $data = $request->validated();
        $response = $this->cuti->update($data,$id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }


}
