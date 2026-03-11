<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $user;

    /**
     * @param $user
     */
    public function __construct(UserService $user)
    {
        $this->user = $user;
    }

    public function getData(Request $request)
    {
        $search = $request->search;
        $perPage = $request->per_page;

        return $this->user->getData($search,$perPage);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        Log::debug($data);
        $response = $this->user->store($data);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->validated();
        $response = $this->user->update($data,$id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function destroy($id)
    {

        if (auth()->user() == $id) {
            return response()->json('Failed Delete User', 400);
        }
        $response = $this->user->destroy($id);
        if ($response) {
            return response()->json($response, 201);
        }

        return response()->json($response, 400);
    }

    public function getUserById($id)
    {

        return $this->user->getUserById($id);
    }
}
