<?php

namespace App\Repositories;

use App\Http\Resources\Collection\GraphCollection;
use App\Http\Resources\GraphClientResource;
use App\Http\Resources\RekapResource;
use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\JenisCuti;
use App\Models\Karyawan;
use Illuminate\Support\Carbon;

class DashboardRepository
{
    protected $karyawan;
    protected $cuti;
    protected $absensi;
    protected $jenisCuti;

    /**
     * @param $karyawan
     */
    public function __construct(Karyawan $karyawan,Cuti $cuti,Absensi $absensi,JenisCuti $jenisCuti)
    {
        $this->karyawan = $karyawan;
        $this->cuti = $cuti;
        $this->absensi = $absensi;
        $this->jenisCuti = $jenisCuti;
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

    public function graphClient($idKaryawan)
    {
        $tahun = Carbon::now()->year;

        $cutiDipakai = $this->cuti
            ->where('id_karyawan', $idKaryawan)
            ->where('status', 'approved')
            ->where('using_annual_leave',false)
            ->whereYear('tanggal_mulai', $tahun)
            ->sum('jumlah_hari');

        $batasCuti = $this->jenisCuti->sum('jatah_hari');

        $sisaCuti = max($batasCuti - $cutiDipakai, 0);

        $absensiHariIni = $this->absensi
            ->where('id_karyawan', $idKaryawan)
            ->whereDate('jam_masuk', Carbon::today())
            ->first();

        $statusAbsen = 'Not Record';

        if ($absensiHariIni && $absensiHariIni->jam_masuk) {

            $jamMasuk = Carbon::parse($absensiHariIni->jam_masuk);
            $batasJamMasuk = Carbon::today()->setTime(7, 0, 0);

            $statusAbsen = $jamMasuk->greaterThan($batasJamMasuk)
                ? 'Late Checked In'
                : 'Checked In';
        }

        $pendingRequest = $this->cuti
            ->where('id_karyawan', $idKaryawan)
            ->where('status', 'pending')
            ->whereYear('tanggal_mulai', $tahun)
            ->count();
        $data = [
            'sisa_cuti' => (int) $sisaCuti,
            'pending_cuti' => (int) $pendingRequest,
            'absen_hari_ini' => $statusAbsen,
        ];
        return new GraphClientResource($data);
    }
}
