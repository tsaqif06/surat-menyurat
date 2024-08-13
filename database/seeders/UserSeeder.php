<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::insert([
            [
                'id_jabatan' => 1,
                'nama_user' => 'Admin',
                'username' => 'admin',
                'password' => 'admin123', // Gunakan Hash untuk mengenkripsi password
            ],
            [
                'id_jabatan' => 2,
                'nama_user' => 'User',
                'username' => 'user',
                'password' => 'user123', // Gunakan Hash untuk mengenkripsi password
            ],
        ]);
    }
}
