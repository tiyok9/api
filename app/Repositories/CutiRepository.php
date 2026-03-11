<?php

namespace App\Repositories;

use App\Http\Resources\Collection\CutiCollection;
use App\Models\Cuti;
use App\Models\JenisCuti;
use App\Models\User;

class CutiRepository
{
    protected $cuti;
    protected $jenisCuti;
    protected $user;

    public function __construct(Cuti $cuti,User $user,JenisCuti $jenisCuti)
    {
        $this->cuti = $cuti;
        $this->user = $user;
        $this->jenisCuti = $jenisCuti;
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

    public function getExport()
    {
        return $this->cuti
            ->with(['jenisCuti','karyawan','approve'])->get();
    }

    public function getJataHari($id)
    {
        return $this->jenisCuti->where('id',$id)->first()->jatah_hari;
    }
}
