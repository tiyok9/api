<?php

namespace App\Repositories;

use App\Http\Resources\Collection\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserRepository
{
    protected $user;

    /**
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function getData(mixed $search,$perPage)
    {
        $query = $this->user->with('karyawan');

        if (!empty($search)) {
            $query->where('username', 'like', '%' . $search . '%');
        }

        $data = $query->paginate($perPage);
        return new UserCollection($data);
    }

    public function store(mixed $data)
    {
        return $this->user->create($data);
    }

    public function update(mixed $data, $id)
    {
        return $this->user->where('id',$id)->update($data);
    }

    public function destroy($id)
    {
        return $this->user->where('id',$id)->delete();

    }

    public function getUserById($id)
    {
        $data = $this->user->where('id',$id)->with('karyawan')->firstOrFail();
        return new UserResource($data);

    }
}
