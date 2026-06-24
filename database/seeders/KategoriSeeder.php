<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            [
                'nama_kategori' => 'Reguler',
                'biaya_dasar' => 500000,
                'persentase_potongan' => 0,
            ],

            [
                'nama_kategori' => 'Yatim',
                'biaya_dasar' => 500000,
                'persentase_potongan' => 50,
            ],

            [
                'nama_kategori' => 'SKTM',
                'biaya_dasar' => 500000,
                'persentase_potongan' => 25,
            ],

            [
                'nama_kategori' => 'Anak Guru',
                'biaya_dasar' => 500000,
                'persentase_potongan' => 100,
            ],

            [
                'nama_kategori' => 'Prestasi',
                'biaya_dasar' => 500000,
                'persentase_potongan' => 30,
            ],

        ];

        foreach ($data as $item) {
            Kategori::create($item);
        }
    }
}