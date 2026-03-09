<?php

namespace App\Repositories;

use App\Http\Resources\Collection\KaryawanCollection;
use App\Http\Resources\KaryawanResource;
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

    public function getData(mixed $search,$perPage)
    {
        $query = $this->karyawan->with('jabatan');

        if (!empty($search)) {
            $query->where('nama', 'like', '%' . $search . '%');
        }

        $data = $query->paginate($perPage);
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

    public function getKaryawanById($id)
    {
        $data = $this->karyawan->where('id',$id)->with('jabatan')->firstOrFail();
        return new KaryawanResource($data);
    }
}
