<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [

            // ===============================
            // EXCLUSIVE (HANYA 1 ORANG)
            // ===============================

            ['name' => 'Kepala Sekolah SMP', 'level' => 'smp', 'is_exclusive' => true],
            ['name' => 'Kepala Sekolah SMK', 'level' => 'smk', 'is_exclusive' => true],

            ['name' => 'Wakil Kepala Sekolah Bid. Kurikulum', 'level' => 'both', 'is_exclusive' => true],
            ['name' => 'Wakil Kepala Sekolah Bid. Penjamin Mutu', 'level' => 'both', 'is_exclusive' => true],
            ['name' => 'Wakil Kepala Sekolah Bid. Kesiswaan', 'level' => 'both', 'is_exclusive' => true],

            // Kepala Program (Exclusive - hanya 1 per jurusan)
            ['name' => 'Kepala Program Akuntansi dan Keuangan Lembaga', 'level' => 'smk', 'is_exclusive' => true],
            ['name' => 'Kepala Program Teknik Elektronika', 'level' => 'smk', 'is_exclusive' => true],
            ['name' => 'Kepala Program Teknik Jaringan Komputer dan Telekomunikasi', 'level' => 'smk', 'is_exclusive' => true],
            ['name' => 'Kepala Program Teknik Kendaraan Ringan', 'level' => 'smk', 'is_exclusive' => true],
            ['name' => 'Kepala Program Teknik Alat Berat', 'level' => 'smk', 'is_exclusive' => true],
            ['name' => 'Kepala Program Teknik Sepeda Motor', 'level' => 'smk', 'is_exclusive' => true],

            // ===============================
            // NON EXCLUSIVE (BOLEH BANYAK)
            // ===============================

            ['name' => 'Kepala Tata Usaha', 'level' => 'both', 'is_exclusive' => false],
            ['name' => 'Staff Tata Usaha', 'level' => 'both', 'is_exclusive' => false],
            ['name' => 'Bendahara', 'level' => 'both', 'is_exclusive' => false],
            ['name' => 'Staff Dapodik', 'level' => 'both', 'is_exclusive' => false],
            ['name' => 'Staff Toolmen', 'level' => 'smk', 'is_exclusive' => false],
            ['name' => 'Kepala Bengkel', 'level' => 'smk', 'is_exclusive' => false],

        ];

        foreach ($positions as $position) {

            Position::updateOrCreate(
                ['slug' => Str::slug($position['name'])],
                [
                    'name'         => $position['name'],
                    'level'        => $position['level'],
                    'is_exclusive' => $position['is_exclusive'],
                    'is_active'    => true
                ]
            );
        }
    }
}