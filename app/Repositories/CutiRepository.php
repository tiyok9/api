<?php

namespace App\Repositories;

use App\Http\Resources\Collection\CutiCollection;
use App\Models\Cuti;
use App\Models\User;

class CutiRepository
{
    protected $cuti;
    protected $user;

    public function __construct(Cuti $cuti,User $user)
    {
        $this->cuti = $cuti;
        $this->user = $user;
    }

    public function getData(mixed $search,$perPage)
    {
        $query = $this->cuti->with('karyawan');

        if (!empty($search)) {
            $query->whereHas('karyawan',function ($q) use ($search) {
                $q->where('karyawan', 'like', '%' . $search . '%');
            });
        }

        $data = $query->paginate($perPage);
        return new CutiCollection($data);
    }

    public function store(mixed $data)
    {
        return $this->cuti->create($data);
    }

    public function update(mixed $data,$id)
    {
        return $this->cuti->where('id',$id)->update($data);
    }

    public function getAdmin()
    {
        return $this->user->where('role','admin')->get();
    }
}
