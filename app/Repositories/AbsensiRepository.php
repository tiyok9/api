<?php

namespace App\Repositories;

use App\Models\Absensi;
use App\Models\Karyawan;

class AbsensiRepository
{
    protected $absensi;
    protected $karyawan;

    /**
     * @param $absensi
     * @param $karyawan
     */
    public function __construct(Absensi $absensi,Karyawan $karyawan)
    {
        $this->absensi = $absensi;
        $this->karyawan = $karyawan;
    }

    public function getData(mixed $search)
    {
        $query = $this->absensi->query();

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

    public function cekAbsen(mixed $nik)
    {
        return $this->absensi->whereHas('karyawan',function ($q) use ($nik){
            $q->where('nik', $nik);
        })->whereDate('tanggal', today())
            ->first();
    }

    public function masuk(mixed $absensiData)
    {
        return $this->absensi->create($absensiData);
    }

    public function getIdByNik(mixed $nik)
    {
        return $this->karyawan->where('nik', $nik)->firstOrFail()->id;
    }

    public function pulang(mixed $absensiData,$id)
    {
        return $this->absensi->where('id', $id)->update($absensiData);
    }

    public function note(mixed $data, $id)
    {
        return $this->absensi->where('id', $id)->update($data);
    }
}
