<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wargas')->insert([
            [
                'user_id' => 1,
                'nama' => 'Ahmad Surya',
                'nik' => '3201234567890001',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'jenis_kelamin' => 'Laki-laki',
                'pekerjaan' => 'Programmer',
                'agama' => 'Islam',
                'tanggal_lahir' => '1990-05-15', // Tambahan tanggal lahir
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'nama' => 'Siti Aisyah',
                'nik' => '3201234567890002',
                'alamat' => 'Jl. Diponegoro No. 15, Bandung',
                'jenis_kelamin' => 'Perempuan',
                'pekerjaan' => 'Guru',
                'agama' => 'Islam',
                'tanggal_lahir' => '1995-09-22', // Tambahan tanggal lahir
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
