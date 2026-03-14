<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@spartta.com',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
            'phone' => '081234567890',
            'is_active' => true,
            'created_by' => null, // Super Admin dibuat oleh sistem
        ]);

        // Buat Admin (Omku)
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@spartta.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '081234567891',
            'is_active' => true,
            'created_by' => $superAdmin->id,
        ]);

        // Buat Kasir 1
        User::create([
            'name' => 'Kasir 1 - Budi',
            'email' => 'kasir1@spartta.com',
            'password' => Hash::make('password123'),
            'role' => 'kasir',
            'phone' => '081234567892',
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        // Buat Kasir 2
        User::create([
            'name' => 'Kasir 2 - Siti',
            'email' => 'kasir2@spartta.com',
            'password' => Hash::make('password123'),
            'role' => 'kasir',
            'phone' => '081234567893',
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        // Buat Kasir 3
        User::create([
            'name' => 'Kasir 3 - Joko',
            'email' => 'kasir3@spartta.com',
            'password' => Hash::make('password123'),
            'role' => 'kasir',
            'phone' => '081234567894',
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        // Buat user nonaktif (contoh)
        User::create([
            'name' => 'User Nonaktif',
            'email' => 'nonaktif@spartta.com',
            'password' => Hash::make('password123'),
            'role' => 'kasir',
            'phone' => '081234567895',
            'is_active' => false,
            'created_by' => $admin->id,
        ]);
    }
}
