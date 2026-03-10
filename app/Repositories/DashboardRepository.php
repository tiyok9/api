<?php

namespace App\Repositories;

use App\Http\Resources\Collection\GraphCollection;
use App\Http\Resources\GraphResource;
use App\Http\Resources\RekapResource;
use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Karyawan;
use Illuminate\Support\Carbon;

class DashboardRepository
{
    protected $karyawan;
    protected $cuti;
    protected $absensi;

    /**
     * @param $karyawan
     */
    public function __construct(Karyawan $karyawan,Cuti $cuti,Absensi $absensi)
    {
        $this->karyawan = $karyawan;
        $this->cuti = $cuti;
        $this->absensi = $absensi;
    }

    public function rekap()
    {
        $data = [
            'total_karyawan' => $this->karyawan->count(),
            'karyawan_aktif' => $this->karyawan
                ->where('aktif', 1)
                ->count(),
            'cuti_bulan_ini' => $this->cuti
                ->whereMonth('tanggal_mulai', Carbon::now()->month)
                ->whereYear('tanggal_mulai', Carbon::now()->year)
                ->count(),
        ];

        return new RekapResource($data);
    }

    public function graph()
    {
        $absensi = Absensi::selectRaw('EXTRACT(MONTH FROM tanggal) as bulan, COUNT(*) as hadir')
            ->groupBy('bulan')
            ->pluck('hadir', 'bulan');

        $cuti = Cuti::selectRaw('EXTRACT(MONTH FROM tanggal_mulai) as bulan, COUNT(*) as cuti')
            ->where('status', 'approved')
            ->groupBy('bulan')
            ->pluck('cuti', 'bulan');

        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];

        $data = [];

        foreach ($months as $num => $name) {
            $data[] = [
                'month' => $name,
                'hadir' => $absensi[$num] ?? 0,
                'cuti' => $cuti[$num] ?? 0,
            ];
        }

        return new GraphCollection($data);
    }
}
