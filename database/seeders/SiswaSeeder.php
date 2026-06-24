<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            [
                'nis' => '250001',
                'nama' => 'Ahmad Fauzan',
                'jk' => 'L',
                'kelas' => 'VII A',
                'kategori' => 'Reguler'
            ],

            [
                'nis' => '250002',
                'nama' => 'Siti Aisyah',
                'jk' => 'P',
                'kelas' => 'VII A',
                'kategori' => 'Yatim'
            ],

            [
                'nis' => '250003',
                'nama' => 'Muhammad Rizky',
                'jk' => 'L',
                'kelas' => 'VII B',
                'kategori' => 'Reguler'
            ],

            [
                'nis' => '250004',
                'nama' => 'Nurul Hidayah',
                'jk' => 'P',
                'kelas' => 'VII B',
                'kategori' => 'SKTM'
            ],

            [
                'nis' => '250005',
                'nama' => 'Rafi Maulana',
                'jk' => 'L',
                'kelas' => 'VIII A',
                'kategori' => 'Reguler'
            ],

            [
                'nis' => '250006',
                'nama' => 'Putri Zahra',
                'jk' => 'P',
                'kelas' => 'VIII A',
                'kategori' => 'Yatim'
            ],

            [
                'nis' => '250007',
                'nama' => 'Dimas Saputra',
                'jk' => 'L',
                'kelas' => 'VIII B',
                'kategori' => 'Reguler'
            ],

            [
                'nis' => '250008',
                'nama' => 'Aulia Rahman',
                'jk' => 'P',
                'kelas' => 'VIII B',
                'kategori' => 'SKTM'
            ],

            [
                'nis' => '250009',
                'nama' => 'Fajar Ramadhan',
                'jk' => 'L',
                'kelas' => 'IX A',
                'kategori' => 'Reguler'
            ],

            [
                'nis' => '250010',
                'nama' => 'Nabila Salsabila',
                'jk' => 'P',
                'kelas' => 'IX A',
                'kategori' => 'Yatim'
            ],

            [
                'nis' => '250011',
                'nama' => 'Bagas Pratama',
                'jk' => 'L',
                'kelas' => 'IX B',
                'kategori' => 'Reguler'
            ],

            [
                'nis' => '250012',
                'nama' => 'Anisa Khairunnisa',
                'jk' => 'P',
                'kelas' => 'IX B',
                'kategori' => 'SKTM'
            ],

        ];

        foreach ($data as $item) {

            $kelas = Kelas::where('nama_kelas', $item['kelas'])->first();
            $kategori = Kategori::where('nama_kategori', $item['kategori'])->first();

            $user = User::create([
                'name' => $item['nama'],
                'email' => $item['nis'] . '@assulthon.com',
                'password' => Hash::make($item['nis']),
                'role' => 'user',
            ]);

            Siswa::create([
                'user_id' => $user->id,
                'kategori_id' => $kategori?->id,
                'kelas_id' => $kelas?->id,

                'nis' => $item['nis'],
                'nama_siswa' => $item['nama'],
                'jenis_kelamin' => $item['jk'],

                'tanggal_lahir' => fake()->dateTimeBetween(
                    '2009-01-01',
                    '2013-12-31'
                ),

                'alamat' => fake()->address(),

                'no_hp' => '08' . fake()->numerify('##########'),

                'nama_wali' => fake('id_ID')->name(),

                'no_hp_wali' => '08' . fake()->numerify('##########'),

                'status_aktif' => true,
            ]);
        }
    }
}
