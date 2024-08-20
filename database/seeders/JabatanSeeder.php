<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jabatan::truncate();

        // Tambahkan data tetap
        Jabatan::create(['nama_jabatan' => 'sekretaris']);
        Jabatan::create(['nama_jabatan' => 'user']);
    }
}
