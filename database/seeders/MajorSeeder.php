<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Major;
use Illuminate\Support\Str;

class MajorSeeder extends Seeder
{
    public function run(): void
    {
        $majors = [
            ['name' => 'AKL',  'motto' => 'Akuntansi dan Keuangan Lembaga'],
            ['name' => 'TE',   'motto' => 'Teknik Elektronika'],
            ['name' => 'TJKT', 'motto' => 'Teknik Jaringan Komputer dan Telekomunikasi'],
            ['name' => 'TKR',  'motto' => 'Teknik Kendaraan Ringan'],
            ['name' => 'TAB',  'motto' => 'Teknik Alat Berat'],
            ['name' => 'TSM',  'motto' => 'Teknik Sepeda Motor'],
        ];

        foreach ($majors as $major) {
            Major::updateOrCreate(
                ['slug' => Str::slug($major['name'])],
                [
                    'name' => $major['name'],
                    'motto' => $major['motto'],
                    'is_active' => true
                ]
            );
        }
    }
}
