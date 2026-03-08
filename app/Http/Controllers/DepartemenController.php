<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartemenRequest;
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

    public function getData(Request $request)
    {
        $search = $request->search;

        return $this->departemen->getData($search);
    }

    public function store(DepartemenRequest $request)
    {
        $data = $request->validated();
        $response = $this->departemen->store($data);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function update(DepartemenRequest $request, $id)
    {
        $data = $request->validated();
        $response = $this->departemen->update($data,$id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function destroy($id)
    {
        $response = $this->departemen->destroy($id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }
}
