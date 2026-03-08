<?php

namespace App\Repositories;

use App\Http\Resources\Collection\KaryawanCollection;
use App\Models\Karyawan;

class KaryawanRepository
{
    protected $karyawan;

    /**
     * @param $karyawan
     */
    public function __construct(Karyawan $karyawan)
    {
        $this->karyawan = $karyawan;
    }

    public function getData(mixed $search)
    {
        $query = $this->karyawan->query();

        if (!empty($search)) {
            $query->where('nama', 'like', '%' . $search . '%');
        }

        $data = $query->paginate(10);
        return new KaryawanCollection($data);
    }

    public function store(mixed $data)
    {
        return $this->karyawan->create($data);
    }

    public function update(mixed $data, $id)
    {
        return $this->karyawan->where('id',$id)->update($data);
    }

    public function destroy($id)
    {
        return $this->karyawan->where('id',$id)->delete();

    }
}
