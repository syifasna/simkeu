<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            [
                'nama_kelas' => 'VII A',
                'tingkat' => 'VII',
                'wali_kelas' => 'Ahmad Fauzi, S.Pd',
                'kapasitas' => 30,
            ],

            [
                'nama_kelas' => 'VII B',
                'tingkat' => 'VII',
                'wali_kelas' => 'Nur Aisyah, S.Pd',
                'kapasitas' => 30,
            ],

            [
                'nama_kelas' => 'VIII A',
                'tingkat' => 'VIII',
                'wali_kelas' => 'Budi Budiman, S.Ag',
                'kapasitas' => 30,
            ],

            [
                'nama_kelas' => 'VIII B',
                'tingkat' => 'VIII',
                'wali_kelas' => 'Nira Sunarni, S.Pd',
                'kapasitas' => 30,
            ],

            [
                'nama_kelas' => 'IX A',
                'tingkat' => 'IX',
                'wali_kelas' => 'Yeni Suryani, S.Pd',
                'kapasitas' => 30,
            ],

            [
                'nama_kelas' => 'IX B',
                'tingkat' => 'IX',
                'wali_kelas' => 'Rudi Hartono, S.Pd',
                'kapasitas' => 30,
            ],

        ];

        foreach ($data as $item) {
            Kelas::create($item);
        }
    }
}