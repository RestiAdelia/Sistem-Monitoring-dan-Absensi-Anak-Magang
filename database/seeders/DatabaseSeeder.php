<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'nomor_induk' => 'ADM-001',
            'instansi' => null,
            'mentor_id' => null,
        ]);

        // 2. Seed Mentor
        $mentor = User::create([
            'name' => 'Budi Santoso (Mentor)',
            'email' => 'mentor@example.com',
            'password' => Hash::make('password'),
            'role' => 'mentor',
            'nomor_induk' => 'MTR-100',
            'instansi' => 'PT Solusi Teknologi',
            'mentor_id' => null,
        ]);

        // 3. Seed Intern
        User::create([
            'name' => 'Resti Adelia (Anak Magang)',
            'email' => 'intern@example.com',
            'password' => Hash::make('password'),
            'role' => 'magang',
            'nomor_induk' => '123456789',
            'instansi' => 'Universitas Gunadarma',
            'mentor_id' => $mentor->id,
        ]);
    }
}
