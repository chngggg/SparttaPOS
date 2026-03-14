<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sparepart;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Barcode;
use Illuminate\Support\Str;

class SparepartSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        // Data sparepart Viar Original
        $viarSpareparts = [
            // Oli & Pelumas
            [
                'name' => 'Oli Mesin Viar SAE 20W-50',
                'category_name' => 'Oli & Pelumas',
                'brand' => 'Viar',
                'brand_type' => 'viar',
                'purchase_price' => 35000,
                'selling_price' => 45000,
                'min_stock' => 10,
                'unit' => 'liter',
            ],
            [
                'name' => 'Oli Samping Viar 2T',
                'category_name' => 'Oli & Pelumas',
                'brand' => 'Viar',
                'brand_type' => 'viar',
                'purchase_price' => 25000,
                'selling_price' => 35000,
                'min_stock' => 10,
                'unit' => 'liter',
            ],

            // Filter
            [
                'name' => 'Filter Oli Viar Original',
                'category_name' => 'Filter',
                'brand' => 'Viar',
                'brand_type' => 'viar',
                'purchase_price' => 15000,
                'selling_price' => 25000,
                'min_stock' => 5,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Filter Udara Viar Sport',
                'category_name' => 'Filter',
                'brand' => 'Viar',
                'brand_type' => 'viar',
                'purchase_price' => 20000,
                'selling_price' => 35000,
                'min_stock' => 5,
                'unit' => 'pcs',
            ],

            // Kampas Rem
            [
                'name' => 'Kampas Rem Depan Viar Original',
                'category_name' => 'Kampas Rem',
                'brand' => 'Viar',
                'brand_type' => 'viar',
                'purchase_price' => 25000,
                'selling_price' => 40000,
                'min_stock' => 5,
                'unit' => 'set',
            ],
            [
                'name' => 'Kampas Rem Belakang Viar Original',
                'category_name' => 'Kampas Rem',
                'brand' => 'Viar',
                'brand_type' => 'viar',
                'purchase_price' => 25000,
                'selling_price' => 40000,
                'min_stock' => 5,
                'unit' => 'set',
            ],

            // Busi & Kelistrikan
            [
                'name' => 'Busi Viar Original',
                'category_name' => 'Busi & Kelistrikan',
                'brand' => 'Viar',
                'brand_type' => 'viar',
                'purchase_price' => 15000,
                'selling_price' => 25000,
                'min_stock' => 10,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Aki Viar 12V 7Ah',
                'category_name' => 'Busi & Kelistrikan',
                'brand' => 'Viar',
                'brand_type' => 'viar',
                'purchase_price' => 150000,
                'selling_price' => 225000,
                'min_stock' => 3,
                'unit' => 'pcs',
            ],

            // Rantai & Gear
            [
                'name' => 'Rantai Viar Original',
                'category_name' => 'Rantai & Gear',
                'brand' => 'Viar',
                'brand_type' => 'viar',
                'purchase_price' => 75000,
                'selling_price' => 120000,
                'min_stock' => 3,
                'unit' => 'set',
            ],
            [
                'name' => 'Gear Set Viar Original',
                'category_name' => 'Rantai & Gear',
                'brand' => 'Viar',
                'brand_type' => 'viar',
                'purchase_price' => 85000,
                'selling_price' => 135000,
                'min_stock' => 3,
                'unit' => 'set',
            ],

            // Ban & Velg
            [
                'name' => 'Ban Dalam Viar 70/90-17',
                'category_name' => 'Ban & Velg',
                'brand' => 'Viar',
                'brand_type' => 'viar',
                'purchase_price' => 35000,
                'selling_price' => 55000,
                'min_stock' => 5,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Ban Luar Viar 70/90-17',
                'category_name' => 'Ban & Velg',
                'brand' => 'Viar',
                'brand_type' => 'viar',
                'purchase_price' => 120000,
                'selling_price' => 185000,
                'min_stock' => 3,
                'unit' => 'pcs',
            ],

            // Lampu
            [
                'name' => 'Lampu Depan Viar LED',
                'category_name' => 'Lampu',
                'brand' => 'Viar',
                'brand_type' => 'viar',
                'purchase_price' => 45000,
                'selling_price' => 75000,
                'min_stock' => 5,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Lampu Sein Viar Original',
                'category_name' => 'Lampu',
                'brand' => 'Viar',
                'brand_type' => 'viar',
                'purchase_price' => 20000,
                'selling_price' => 35000,
                'min_stock' => 5,
                'unit' => 'pasang',
            ],

            // Aksesoris Original
            [
                'name' => 'Spion Viar Original',
                'category_name' => 'Aksesoris Original',
                'brand' => 'Viar',
                'brand_type' => 'viar',
                'purchase_price' => 25000,
                'selling_price' => 45000,
                'min_stock' => 5,
                'unit' => 'pasang',
            ],
            [
                'name' => 'Cover Jok Viar Original',
                'category_name' => 'Aksesoris Original',
                'brand' => 'Viar',
                'brand_type' => 'viar',
                'purchase_price' => 35000,
                'selling_price' => 65000,
                'min_stock' => 3,
                'unit' => 'pcs',
            ],
        ];

        // Data sparepart non-Viar (dari seeder lama)
        $nonViarSpareparts = [
            [
                'name' => 'Oli Samping Motul 800',
                'category_name' => 'Oli & Pelumas',
                'brand' => 'Motul',
                'brand_type' => 'non-viar',
                'purchase_price' => 85000,
                'selling_price' => 100000,
                'min_stock' => 10,
                'unit' => 'liter',
            ],
            [
                'name' => 'Oli Mesin Castrol Power1',
                'category_name' => 'Oli & Pelumas',
                'brand' => 'Castrol',
                'brand_type' => 'non-viar',
                'purchase_price' => 75000,
                'selling_price' => 90000,
                'min_stock' => 15,
                'unit' => 'liter',
            ],
            [
                'name' => 'Busi NGK Standard',
                'category_name' => 'Busi & Kelistrikan',
                'brand' => 'NGK',
                'brand_type' => 'non-viar',
                'purchase_price' => 25000,
                'selling_price' => 35000,
                'min_stock' => 20,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Kampas Rem Depan Honda',
                'category_name' => 'Kampas Rem',
                'brand' => 'Honda Genuine',
                'brand_type' => 'non-viar',
                'purchase_price' => 45000,
                'selling_price' => 60000,
                'min_stock' => 8,
                'unit' => 'set',
            ],
            [
                'name' => 'Filter Udara Yamaha',
                'category_name' => 'Filter',
                'brand' => 'Yamaha Genuine',
                'brand_type' => 'non-viar',
                'purchase_price' => 35000,
                'selling_price' => 50000,
                'min_stock' => 12,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Rantai RK X-ring',
                'category_name' => 'Rantai & Gear',
                'brand' => 'RK',
                'brand_type' => 'non-viar',
                'purchase_price' => 350000,
                'selling_price' => 425000,
                'min_stock' => 5,
                'unit' => 'set',
            ],
            [
                'name' => 'Lampu Depan LED',
                'category_name' => 'Lampu',
                'brand' => 'Philips',
                'brand_type' => 'non-viar',
                'purchase_price' => 150000,
                'selling_price' => 225000,
                'min_stock' => 7,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Ban Dalam IRC',
                'category_name' => 'Ban & Velg',
                'brand' => 'IRC',
                'brand_type' => 'non-viar',
                'purchase_price' => 45000,
                'selling_price' => 65000,
                'min_stock' => 15,
                'unit' => 'pcs',
            ],
        ];

        // Data sparepart optional (khusus kategori Aksesoris & Optional)
        $optionalSpareparts = [
            [
                'name' => 'Stiker Motor Viar',
                'category_name' => 'Aksesoris & Optional',
                'brand' => 'Viar',
                'brand_type' => 'optional',
                'purchase_price' => 5000,
                'selling_price' => 10000,
                'min_stock' => 20,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Gantungan Kunci Viar',
                'category_name' => 'Aksesoris & Optional',
                'brand' => 'Viar',
                'brand_type' => 'optional',
                'purchase_price' => 3000,
                'selling_price' => 8000,
                'min_stock' => 20,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Sarung Tangan Motor',
                'category_name' => 'Aksesoris & Optional',
                'brand' => 'Progrip',
                'brand_type' => 'optional',
                'purchase_price' => 25000,
                'selling_price' => 45000,
                'min_stock' => 10,
                'unit' => 'pasang',
            ],
        ];

        // Gabungkan semua data
        $allSpareparts = array_merge($viarSpareparts, $nonViarSpareparts, $optionalSpareparts);

        $index = 0;
        foreach ($allSpareparts as $item) {
            // Cari category berdasarkan nama
            $category = $categories->firstWhere('name', $item['category_name']);
            if (!$category) {
                // Jika kategori tidak ditemukan, skip
                continue;
            }

            // Ambil supplier random
            $supplier = $suppliers->random();

            // Generate kode unik
            $code = 'SPR' . str_pad($index + 1, 4, '0', STR_PAD_LEFT);

            // Buat sparepart
            $sparepart = Sparepart::create([
                'code' => $code,
                'barcode' => '899' . rand(100000000, 999999999),
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'category_id' => $category->id,
                'supplier_id' => $supplier->id,
                'brand' => $item['brand'],
                'brand_type' => $item['brand_type'],
                'unit' => $item['unit'] ?? 'pcs',
                'stock' => rand(10, 50),
                'min_stock' => $item['min_stock'],
                'max_stock' => $item['min_stock'] * 5,
                'purchase_price' => $item['purchase_price'],
                'selling_price' => $item['selling_price'],
                'discount' => 0,
                'location_rack' => 'Rak ' . ($item['brand_type'] == 'viar' ? 'Viar ' : 'Non-Viar ') . chr(65 + rand(0, 5)) . rand(1, 10),
                'description' => "Sparepart {$item['name']} kualitas terbaik",
                'is_active' => true,
            ]);

            // Buat barcode untuk sparepart
            Barcode::create([
                'sparepart_id' => $sparepart->id,
                'barcode_number' => $sparepart->barcode,
                'type' => 'code128',
                'is_active' => true,
            ]);

            $index++;
        }

        $this->command->info('Sparepart berhasil ditambahkan!');
        $this->command->info('Total: ' . $index . ' sparepart');
    }
}
