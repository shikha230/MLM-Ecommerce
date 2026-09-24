<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fresh Fruits & Vegetables',
                'slug' => 'fruits-vegetables',
                'icon' => '🥦',
                'description' => 'Farm-fresh seasonal fruits, leafy greens, and organic vegetables delivered daily.',
            ],
            [
                'name' => 'Dairy, Eggs & Bakery',
                'slug' => 'dairy-eggs-bakery',
                'icon' => '🥛',
                'description' => 'Fresh milk, paneer, curd, eggs, bread, and artisanal morning bakery items.',
            ],
            [
                'name' => 'Grains, Rice & Pulses',
                'slug' => 'grains-rice-pulses',
                'icon' => '🌾',
                'description' => 'Premium Basmati rice, farm chakki atta, organic dals, and staple pantry grains.',
            ],
            [
                'name' => 'Snacks & Beverages',
                'slug' => 'snacks-beverages',
                'icon' => '🧃',
                'description' => 'Crispy namkeens, healthy dry fruit mixes, cold-pressed juices, and morning tea & coffee.',
            ],
            [
                'name' => 'Spices, Oil & Masalas',
                'slug' => 'spices-oil-masalas',
                'icon' => '🌶️',
                'description' => 'Aromatic ground spices, pure cold-pressed mustard & sunflower oils, and desi cow ghee.',
            ],
            [
                'name' => 'Frozen & Instant Foods',
                'slug' => 'frozen-instant-foods',
                'icon' => '🍱',
                'description' => 'Quick 2-minute meals, ready-to-cook delicacies, noodles, and frozen green peas.',
            ],
            [
                'name' => 'Personal Care & Hygiene',
                'slug' => 'personal-care-hygiene',
                'icon' => '🧴',
                'description' => 'Gentle herbal soaps, shampoos, ayurvedic toothpaste, and essential family hygiene care.',
            ],
            [
                'name' => 'Organic & Health Foods',
                'slug' => 'organic-health-foods',
                'icon' => '🌿',
                'description' => 'Certified organic produce, rolled oats, tulsi green teas, and nutritional superfoods.',
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => $cat['slug'] ?? Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'icon' => $cat['icon'],
                    'description' => $cat['description'],
                    'is_active' => true,
                ]
            );
        }
    }
}
