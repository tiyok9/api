<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJenisCutiRequest;
use App\Service\JenisCutiService;
use Illuminate\Http\Request;

class JenisCutiController extends Controller
{
    protected $jenisCuti;

    /**
     * @param $jenisCuti
     */
    public function __construct(JenisCutiService $jenisCuti)
    {
        $this->jenisCuti = $jenisCuti;
    }

    public function getData(Request $request)
    {
        $search = $request->search;

        return $this->jenisCuti->getData($search);
    }

    public function store(StoreJenisCutiRequest $request)
    {
        $data = $request->validated();
        $response = $this->jenisCuti->store($data);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function update(StoreJenisCutiRequest $request, $id)
    {
        $data = $request->validated();
        $response = $this->jenisCuti->update($data,$id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function destroy($id)
    {
        $response = $this->jenisCuti->destroy($id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }
    public function getJenisCutiById($id)
    {
        return $this->jenisCuti->getJenisCutiById($id);
    }

}
