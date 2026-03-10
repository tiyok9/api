<?php

namespace App\Repositories;

use App\Http\Resources\Collection\AbsensiCollection;
use App\Http\Resources\Collection\AbsensiUserCollection;
use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Karyawan;

class AbsensiRepository
{
    protected $absensi;
    protected $karyawan;
    protected $cuti;

    /**
     * @param $absensi
     * @param $karyawan
     */
    public function __construct(Absensi $absensi,Karyawan $karyawan,Cuti $cuti)
    {
        $this->absensi = $absensi;
        $this->karyawan = $karyawan;
        $this->cuti = $cuti;
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
        return new AbsensiCollection($data);
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

    public function getByNik(mixed $nik)
    {
        return $this->karyawan->where('nik', $nik)->firstOrFail();
    }

    public function pulang(mixed $absensiData,$id)
    {
        return $this->absensi->where('id', $id)->update($absensiData);
    }

    public function note(mixed $data, $id)
    {
        return $this->absensi->where('id', $id)->update($data);
    }

    public function getDataUser($id)
    {
        $data = $this->absensi
            ->selectRaw("
            *,
            CASE
                WHEN jam_masuk::time <= '07:00:00' THEN 'present'
                ELSE 'late'
            END as status
        ")
            ->where('id_karyawan', $id)
            ->paginate(10);

        return new AbsensiUserCollection($data);
    }

    public function getRekap(mixed $id)
    {
        $present = Absensi::where('id_karyawan', $id)
            ->whereTime('jam_masuk', '<=', '07:00:00')
            ->count();

        $late = Absensi::where('id_karyawan', $id)
            ->whereTime('jam_masuk', '>', '07:00:00')
            ->count();

        $absent = Cuti::where('id_karyawan', $id)
            ->where('status', 'approved')
            ->count();

        return [
            'present' => $present,
            'late' => $late,
            'absent' => $absent,
        ];

    }
}
