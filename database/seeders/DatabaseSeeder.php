<?php

namespace Database\Seeders;

use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\JenisCuti;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
            ],
            [
                'id' => Str::uuid(),
                'jenis_cuti' => 'Sakit',
                'jatah_hari' => 10,
                'require_end_date' => true,
                'require_attachment' => true,
            ],
            [
                'id' => Str::uuid(),
                'jenis_cuti' => 'Melahirkan',
                'jatah_hari' => 90,
                'require_end_date' => true,
                'require_attachment' => false,
            ],
        ]);
    }
}
