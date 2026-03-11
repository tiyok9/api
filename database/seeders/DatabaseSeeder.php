<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\JenisCuti;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $departemen = Departemen::create([
            'id' => Str::uuid(),
            'departemen' => 'HRD',
        ]);

        $jabatan = Jabatan::create([
            'id' => Str::uuid(),
            'jabatan' => 'HRD Staff',
            'id_departemen' => $departemen->id,
        ]);

        for ($i = 1; $i <= 20; $i++) {

            $karyawan = Karyawan::create([
                'id' => Str::uuid(),
                'nama' => 'karyawan ' . $i,
                'nik' => '12345678901234' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'no_hp' => '08765432' . $i,
                'alamat' => 'alamat ' . $i,
                'id_jabatan' => $jabatan->id,
            ]);

            User::create([
                'id' => Str::uuid(),
                'username' => 'user' . $i,
                'password' => Hash::make('123456'),
                'id_karyawan' => $karyawan->id,
                'role' => 'karyawan'
            ]);
        }
        JenisCuti::insert([
            [
                'id' => Str::uuid(),
                'jenis_cuti' => 'Cuti Tahunan',
                'jatah_hari' => 10,
                'require_end_date' => true,
                'require_attachment' => false,
                'using_annual_leave' => true,
            ],
            [
                'id' => Str::uuid(),
                'jenis_cuti' => 'Sakit',
                'jatah_hari' => 10,
                'require_end_date' => true,
                'require_attachment' => true,
                'using_annual_leave' => false,

            ],
            [
                'id' => Str::uuid(),
                'jenis_cuti' => 'Melahirkan',
                'jatah_hari' => 90,
                'require_end_date' => true,
                'require_attachment' => false,
                'using_annual_leave' => false,

            ],
        ]);


        Cuti::insert([
            [
                'id' => Str::uuid(),
                'id_karyawan' => Karyawan::inRandomOrder()->first()->id,
                'id_jenis_cuti' => JenisCuti::inRandomOrder()->first()->id,
                'tanggal_mulai' => '2026-03-15',
                'tanggal_selesai' => '2026-03-17',
                'jumlah_hari' => 3,
                'alasan' => 'Cuti keluarga',
                'img' => null,
                'status' => 'pending',
                'approved_at' => null,
                'approved_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::uuid(),
                'id_karyawan' => Karyawan::inRandomOrder()->first()->id,
                'id_jenis_cuti' => JenisCuti::inRandomOrder()->first()->id,
                'tanggal_mulai' => '2026-03-20',
                'tanggal_selesai' => '2026-03-22',
                'jumlah_hari' => 3,
                'alasan' => 'Liburan',
                'img' => null,
                'status' => 'approved',
                'approved_at' => Carbon::now(),
                'approved_by' => User::inRandomOrder()->first()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::uuid(),
                'id_karyawan' => Karyawan::inRandomOrder()->first()->id,
                'id_jenis_cuti' => JenisCuti::inRandomOrder()->first()->id,
                'tanggal_mulai' => '2026-04-01',
                'tanggal_selesai' => '2026-04-01',
                'jumlah_hari' => 1,
                'alasan' => 'Keperluan pribadi',
                'img' => null,
                'status' => 'rejected',
                'approved_at' => Carbon::now(),
                'approved_by' => User::inRandomOrder()->first()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);

        $karyawan = Karyawan::pluck('id');

        foreach ($karyawan as $id_karyawan) {

            for ($i = 0; $i < 10; $i++) {

                $tanggal = Carbon::now()->subDays(rand(1,30));

                $jamMasuk = $tanggal->copy()->setTime(8, rand(0,30));
                $jamKeluar = $tanggal->copy()->setTime(17, rand(0,30));

                Absensi::insert([
                    'id' => Str::uuid(),
                    'tanggal' => $tanggal->toDateString(),
                    'id_karyawan' => $id_karyawan,
                    'jam_masuk' => $jamMasuk,
                    'jam_keluar' => $jamKeluar,
                    'note' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

        }

        $karyawans = Karyawan::all();

        foreach ($karyawans as $karyawan) {

            for ($i = 1; $i <= 30; $i++) {

                $tanggal = Carbon::now()->subDays($i);

                $jamMasuk = $tanggal->copy()->setTime(8, rand(0, 30));
                $jamKeluar = $tanggal->copy()->setTime(17, rand(0, 30));

                Absensi::insert([
                    'id' => Str::uuid(),
                    'tanggal' => $tanggal->toDateString(),
                    'id_karyawan' => $karyawan->id,
                    'jam_masuk' => $jamMasuk,
                    'jam_keluar' => rand(0,10) > 1 ? $jamKeluar : null,
                    'note' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            }
        }
    }
}
