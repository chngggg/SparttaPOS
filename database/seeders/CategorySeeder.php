<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Oli & Pelumas',
                'icon' => 'oil-can',
                'description' => 'Oli mesin, oli samping, dan pelumas'
            ],
            [
                'name' => 'Filter',
                'icon' => 'filter',
                'description' => 'Filter oli, filter udara, filter bensin'
            ],
            [
                'name' => 'Kampas Rem',
                'icon' => 'brake',
                'description' => 'Kampas rem depan dan belakang'
            ],
            [
                'name' => 'Busi & Kelistrikan',
                'icon' => 'bolt',
                'description' => 'Busi, koil, aki, dan komponen kelistrikan'
            ],
            [
                'name' => 'Rantai & Gear',
                'icon' => 'chain',
                'description' => 'Rantai, gear set, dan perlengkapannya'
            ],
            [
                'name' => 'Ban & Velg',
                'icon' => 'tire',
                'description' => 'Ban dalam, ban luar, dan velg'
            ],
            [
                'name' => 'Lampu',
                'icon' => 'lightbulb',
                'description' => 'Lampu depan, lampu belakang, lampu sein'
            ],
            [
                'name' => 'Aksesoris',
                'icon' => 'crown',
                'description' => 'Aksesoris dan sparepart tambahan'
            ],
        ];

        foreach ($categories as $cat) {
            $slug = Str::slug($cat['name']);

            // Update atau create
            Category::updateOrCreate(
                ['slug' => $slug], // Cari berdasarkan slug
                [
                    'name' => $cat['name'],
                    'icon' => $cat['icon'],
                    'description' => $cat['description'],
                    'is_active' => true,
                ]
            );

            $this->command->info("Kategori {$cat['name']} diproses.");
        }

        $this->command->info('Seeder kategori selesai!');
    }
}
