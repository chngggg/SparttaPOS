<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;
use Illuminate\Support\Str;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'PT Astra Honda Parts',
                'city' => 'Jakarta',
                'phone' => '021-5551234',
            ],
            [
                'name' => 'PT Yamaha Indonesia Parts',
                'city' => 'Bekasi',
                'phone' => '021-5555678',
            ],
            [
                'name' => 'CV Suzuki Parts Center',
                'city' => 'Bandung',
                'phone' => '022-5559012',
            ],
            [
                'name' => 'UD Kawasaki Parts',
                'city' => 'Semarang',
                'phone' => '024-5553456',
            ],
            [
                'name' => 'Toko Parts Jaya Abadi',
                'city' => 'Surabaya',
                'phone' => '031-5557890',
            ],
        ];

        foreach ($suppliers as $index => $supplier) {
            Supplier::create([
                'name' => $supplier['name'],
                'code' => 'SUP' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'contact_person' => 'Contact ' . ($index + 1),
                'phone' => $supplier['phone'],
                'email' => 'supplier' . ($index + 1) . '@example.com',
                'address' => 'Jl. Raya No. ' . ($index + 1),
                'city' => $supplier['city'],
                'province' => 'Jawa ' . ['Barat', 'Tengah', 'Timur'][array_rand(['Barat', 'Tengah', 'Timur'])],
                'postal_code' => '1' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'is_active' => true,
            ]);
        }
    }
}
