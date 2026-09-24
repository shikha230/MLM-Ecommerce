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
                'name' => 'Electronics & Gadgets',
                'icon' => '📱',
                'description' => 'Mobile phones, laptops, smart accessories and audio devices.',
            ],
            [
                'name' => 'Fashion & Apparel',
                'icon' => '👗',
                'description' => 'Trendy clothing, shoes, ethnic wear, and daily apparel.',
            ],
            [
                'name' => 'Health & Personal Care',
                'icon' => '🌿',
                'description' => 'Skincare, wellness supplements, personal hygiene, and beauty products.',
            ],
            [
                'name' => 'Home & Kitchen Essentials',
                'icon' => '🍳',
                'description' => 'Kitchen appliances, cookware, home decor, and cleaning supplies.',
            ],
            [
                'name' => 'MLM Wellness & Nutrition',
                'icon' => '💎',
                'description' => 'Premium MLM health packs, herbal supplements, and immunity boosters.',
            ],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['slug' => Str::slug($cat['name'])],
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
