<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\Jabatan;
use App\Models\JenisSurat;
use App\Models\Relasi;
use App\Models\RuangPenyimpanan;
use App\Models\Bagian;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->count(10)->create();
        Jabatan::factory()->count(5)->create();
        JenisSurat::factory()->count(5)->create();
        Relasi::factory()->count(5)->create();
        RuangPenyimpanan::factory()->count(5)->create();
        Bagian::factory()->count(5)->create();
        SuratMasuk::factory()->count(10)->create();
        SuratKeluar::factory()->count(10)->create();
    }
}
