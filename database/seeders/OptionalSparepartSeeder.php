<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sparepart;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Barcode;
use Illuminate\Support\Str;

class OptionalSparepartSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::where('name', 'Aksesoris & Optional')->first();
        $suppliers = Supplier::all();

        if (!$category) {
            $this->command->error('Kategori Aksesoris & Optional tidak ditemukan!');
            return;
        }

        $optionalSpareparts = [
            [
                'name' => 'Stiker Motor Viar',
                'brand' => 'Viar',
                'purchase_price' => 5000,
                'selling_price' => 10000,
                'min_stock' => 20,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Gantungan Kunci Viar',
                'brand' => 'Viar',
                'purchase_price' => 3000,
                'selling_price' => 8000,
                'min_stock' => 20,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Sarung Tangan Motor',
                'brand' => 'Progrip',
                'purchase_price' => 25000,
                'selling_price' => 45000,
                'min_stock' => 10,
                'unit' => 'pasang',
            ],
            [
                'name' => 'Helm Viar Open Face',
                'brand' => 'Viar',
                'purchase_price' => 150000,
                'selling_price' => 250000,
                'min_stock' => 5,
                'unit' => 'pcs',
            ],
            [
                'name' => 'Jas Hujan Motor',
                'brand' => 'Raincoat',
                'purchase_price' => 35000,
                'selling_price' => 65000,
                'min_stock' => 10,
                'unit' => 'set',
            ],
        ];

        $lastSparepart = Sparepart::latest()->first();
        $startIndex = $lastSparepart ? $lastSparepart->id + 1 : 1;

        foreach ($optionalSpareparts as $index => $item) {
            $code = 'SPR' . str_pad($startIndex + $index, 4, '0', STR_PAD_LEFT);

            $sparepart = Sparepart::create([
                'code' => $code,
                'barcode' => '899' . rand(100000000, 999999999),
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'category_id' => $category->id,
                'supplier_id' => $suppliers->random()->id,
                'brand' => $item['brand'],
                'brand_type' => 'optional',
                'unit' => $item['unit'],
                'stock' => rand(10, 30),
                'min_stock' => $item['min_stock'],
                'max_stock' => $item['min_stock'] * 3,
                'purchase_price' => $item['purchase_price'],
                'selling_price' => $item['selling_price'],
                'discount' => 0,
                'location_rack' => 'Rak Optional ' . chr(65 + rand(0, 2)) . rand(1, 5),
                'description' => "{$item['name']} - aksesoris motor berkualitas",
                'is_active' => true,
            ]);

            Barcode::create([
                'sparepart_id' => $sparepart->id,
                'barcode_number' => $sparepart->barcode,
                'type' => 'code128',
                'is_active' => true,
            ]);

            $this->command->info("Menambahkan: {$item['name']}");
        }

        $this->command->info('Data optional berhasil ditambahkan!');
    }
}
