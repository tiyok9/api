<?php

namespace App\Repositories;

use App\Http\Resources\Collection\CutiCollection;
use App\Models\Cuti;

class CutiRepository
{
    protected $cuti;

    public function __construct(Cuti $cuti)
    {
        $this->cuti = $cuti;
    }

    public function getData(mixed $search)
    {
        $query = $this->cuti->query();

        if (!empty($search)) {
            $query->whereHas('karyawan',function ($q) use ($search) {
                $q->where('karyawan', 'like', '%' . $search . '%');
            });
        }

        $data = $query->paginate(10);
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
}
