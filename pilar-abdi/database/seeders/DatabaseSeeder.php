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
        // Buat akun admin default
        User::create([
            'name'     => 'Admin Pilar Abdi',
            'email'    => 'admin@pilarabdi.id',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
            'status'   => 'active',
            'whatsapp' => '081234567890',
        ]);

        // Buat akun siswa contoh (opsional untuk testing)
        User::create([
            'name'     => 'Siswa Contoh',
            'email'    => 'siswa@pilarabdi.id',
            'password' => Hash::make('siswa123'),
            'role'     => 'siswa',
            'status'   => 'active',
            'whatsapp' => '089876543210',
            'package'  => 'Paket Premium',
            'sekdin'   => 'PKN STAN',
            'address'  => 'Jakarta, Indonesia',
        ]);
    }
}
