<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create or Find Grocery Seller User
        $user = User::firstOrCreate(
            ['email' => 'seller@freshbasket.com'],
            [
                'name' => 'Green Valley Organics',
                'phone' => '9876543210',
                'password' => Hash::make('Password123!'),
                'role' => 'seller',
                'referral_code' => 'GROCERY01',
            ]
        );

        // 2. Create Seller Profile
        $seller = Seller::firstOrCreate(
            ['user_id' => $user->id],
            [
                'store_name' => 'FreshBasket Farm Hub',
                'store_slug' => 'freshbasket-farm-hub',
                'store_phone' => '9876543210',
                'store_email' => 'seller@freshbasket.com',
                'store_description' => 'Direct farm-to-door fresh produce, certified organic vegetables, A2 dairy, and premium pantry staples with express delivery.',
                'gst_number' => '27AAACG1234A1Z1',
                'pan_number' => 'AAACG1234A',
                'bank_name' => 'HDFC Bank',
                'bank_account_holder' => 'Green Valley Organics LLP',
                'bank_account_number' => '50100432109876',
                'bank_ifsc' => 'HDFC0001234',
                'address' => 'Warehouse 12, Agri-Logistics Park, Vashi',
                'city' => 'Navi Mumbai',
                'state' => 'Maharashtra',
                'pincode' => '400703',
                'status' => 'approved',
                'rating' => 4.92,
            ]
        );

        $catVeg = Category::where('slug', 'fruits-vegetables')->first();
        $catDairy = Category::where('slug', 'dairy-eggs-bakery')->first();
        $catGrains = Category::where('slug', 'grains-rice-pulses')->first();
        $catSnacks = Category::where('slug', 'snacks-beverages')->first();
        $catSpices = Category::where('slug', 'spices-oil-masalas')->first();
        $catFrozen = Category::where('slug', 'frozen-instant-foods')->first();
        $catPersonal = Category::where('slug', 'personal-care-hygiene')->first();
        $catOrganic = Category::where('slug', 'organic-health-foods')->first();

        // 3. Grocery Products List
        $productsData = [
            // Fruits & Veggies
            [
                'name' => 'Fresh Farm Spinach (Palak) 500g',
                'category_id' => $catVeg?->id,
                'price' => 29.00,
                'compare_at_price' => 40.00,
                'cost_price' => 15.00,
                'stock' => 120,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1576045057995-568f588f82fb?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Crisp, organically grown tender spinach leaves, washed & ready for cooking.',
                'description' => 'Harvested fresh every morning from local partner farms. Rich in dietary iron, folate, and vitamins A & C. Washed using ozone purification to remove dust and contaminants.',
                'is_featured' => true,
                'variations' => [
                    ['type' => 'Weight', 'name' => '500g Bunch', 'sku' => 'PALAK-500G', 'price' => 29.00, 'stock' => 80],
                    ['type' => 'Weight', 'name' => '1kg Family Pack', 'sku' => 'PALAK-1KG', 'price' => 52.00, 'stock' => 40],
                ],
            ],
            [
                'name' => 'Organic Ripe Red Tomatoes 1kg',
                'category_id' => $catVeg?->id,
                'price' => 45.00,
                'compare_at_price' => 60.00,
                'cost_price' => 25.00,
                'stock' => 180,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1592924357228-91a4daadcfea?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Farm-ripened juicy desi tomatoes, perfect for curries, salads and sauces.',
                'description' => 'Naturally vine-ripened tomatoes grown without chemical growth boosters. Firm texture, sweet tanginess, and vibrant deep red colour.',
                'is_featured' => true,
                'variations' => [
                    ['type' => 'Weight', 'name' => '1 kg', 'sku' => 'TOMATO-1KG', 'price' => 45.00, 'stock' => 120],
                    ['type' => 'Weight', 'name' => '2 kg Bag', 'sku' => 'TOMATO-2KG', 'price' => 84.00, 'stock' => 60],
                ],
            ],
            [
                'name' => 'Premium Ratnagiri Alphonso Mango 1kg',
                'category_id' => $catVeg?->id,
                'price' => 349.00,
                'compare_at_price' => 420.00,
                'cost_price' => 220.00,
                'stock' => 60,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1553279768-865429fa0078?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Authentic GI-tagged Ratnagiri Hapus mangoes, naturally sweetened and fragrant.',
                'description' => 'The King of Mangoes! Authentic Ratnagiri Alphonso mangoes delivered with aromatic saffron pulp, rich texture, and no artificial carbide ripening.',
                'is_featured' => true,
                'variations' => [
                    ['type' => 'Quantity', 'name' => '1 kg Box (~3-4 pcs)', 'sku' => 'MANGO-1KG', 'price' => 349.00, 'stock' => 40],
                    ['type' => 'Quantity', 'name' => '1 Dozen Peti (~3.5kg)', 'sku' => 'MANGO-1DOZ', 'price' => 1199.00, 'stock' => 20],
                ],
            ],
            [
                'name' => 'Nashik Red Onions 2kg Bag',
                'category_id' => $catVeg?->id,
                'price' => 55.00,
                'compare_at_price' => 70.00,
                'cost_price' => 32.00,
                'stock' => 250,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1618512496248-a07fe83aa8cb?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Pungent, crispy medium-sized red onions sourced directly from Nashik farms.',
                'description' => 'Dry outer skin with juicy layers. Essential base ingredient for every Indian tadka, gravy, and fresh salad.',
                'is_featured' => false,
                'variations' => [
                    ['type' => 'Weight', 'name' => '2 kg Net Bag', 'sku' => 'ONION-2KG', 'price' => 55.00, 'stock' => 150],
                    ['type' => 'Weight', 'name' => '5 kg Saver Sack', 'sku' => 'ONION-5KG', 'price' => 129.00, 'stock' => 100],
                ],
            ],
            [
                'name' => 'Crisp Green Shimla Capsicum 500g',
                'category_id' => $catVeg?->id,
                'price' => 38.00,
                'compare_at_price' => 50.00,
                'cost_price' => 22.00,
                'stock' => 95,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1563565375-f3fdfdbefa83?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Fresh crunchy green bell peppers, great for stir-fries, pizza & fajitas.',
                'description' => 'Thick-walled crunchy green bell peppers loaded with vitamin C. Handpicked from temperature-controlled polyhouses.',
                'is_featured' => false,
            ],

            // Dairy, Eggs & Bakery
            [
                'name' => 'Amul Taaza Toned Fresh Milk 1L Pouch',
                'category_id' => $catDairy?->id,
                'price' => 56.00,
                'compare_at_price' => 58.00,
                'cost_price' => 50.00,
                'stock' => 300,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Pasteurised toned milk with 3.0% fat, fortified with vitamins A & D.',
                'description' => 'Fresh pasteurised milk delivered cold every morning. Ideal for daily tea, coffee, curd making, and drinking.',
                'is_featured' => true,
            ],
            [
                'name' => 'Farm Fresh Brown Eggs (Tray of 30)',
                'category_id' => $catDairy?->id,
                'price' => 189.00,
                'compare_at_price' => 220.00,
                'cost_price' => 140.00,
                'stock' => 110,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1582722872445-44dc5f7e3c8f?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Antibiotic-free, clean graded eggs with rich yellow yolk and high protein.',
                'description' => 'Collected from hygienic cruelty-free poultry units. UV disinfected and sorted to ensure unbroken shells and high nutritional value.',
                'is_featured' => true,
                'variations' => [
                    ['type' => 'Pack Size', 'name' => '6 Pcs Pack', 'sku' => 'EGG-6PK', 'price' => 48.00, 'stock' => 40],
                    ['type' => 'Pack Size', 'name' => '30 Pcs Egg Tray', 'sku' => 'EGG-30PK', 'price' => 189.00, 'stock' => 70],
                ],
            ],
            [
                'name' => 'Mother Dairy Fresh Malai Paneer 200g',
                'category_id' => $catDairy?->id,
                'price' => 89.00,
                'compare_at_price' => 95.00,
                'cost_price' => 74.00,
                'stock' => 140,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Ultra soft and spongy cottage cheese cubes made with pure cow milk.',
                'description' => 'Smooth, crumbly yet firm texture that absorbs curry flavours thoroughly. Rich in calcium and muscle-building protein.',
                'is_featured' => false,
            ],
            [
                'name' => '100% Whole Wheat Artisan Bread 400g',
                'category_id' => $catDairy?->id,
                'price' => 45.00,
                'compare_at_price' => 50.00,
                'cost_price' => 30.00,
                'stock' => 85,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Freshly baked sliced loaf made with 100% whole grain flour, zero maida.',
                'description' => 'Soft, fibre-rich morning bread baked fresh every dawn. Free from palm oil and artificial preservatives.',
                'is_featured' => false,
            ],

            // Grains, Rice & Pulses
            [
                'name' => 'India Gate Super Basmati Rice 5kg Bag',
                'category_id' => $catGrains?->id,
                'price' => 599.00,
                'compare_at_price' => 699.00,
                'cost_price' => 460.00,
                'stock' => 90,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Aged extra long grain Basmati rice with exquisite aroma and pearl-white grains.',
                'description' => 'Aged for 2 years in Himalayan foothills. Each grain elongates to double its size upon cooking, remaining non-sticky and fluffy.',
                'is_featured' => true,
                'variations' => [
                    ['type' => 'Weight', 'name' => '1 kg Pouch', 'sku' => 'RICE-1KG', 'price' => 135.00, 'stock' => 40],
                    ['type' => 'Weight', 'name' => '5 kg Bag', 'sku' => 'RICE-5KG', 'price' => 599.00, 'stock' => 50],
                ],
            ],
            [
                'name' => 'Aashirvaad Shudh Whole Wheat Atta 10kg',
                'category_id' => $catGrains?->id,
                'price' => 439.00,
                'compare_at_price' => 490.00,
                'cost_price' => 370.00,
                'stock' => 110,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Traditional stone-ground golden grains for softer, puffier and healthier rotis.',
                'description' => 'Made from whole wheat grain sourced from Sehore fields of MP. 0% maida, retaining all original bran fibre and natural goodness.',
                'is_featured' => true,
                'variations' => [
                    ['type' => 'Weight', 'name' => '5 kg Pack', 'sku' => 'ATTA-5KG', 'price' => 225.00, 'stock' => 50],
                    ['type' => 'Weight', 'name' => '10 kg Pack', 'sku' => 'ATTA-10KG', 'price' => 439.00, 'stock' => 60],
                ],
            ],
            [
                'name' => 'Tata Sampann Unpolished Toor Dal 1kg',
                'category_id' => $catGrains?->id,
                'price' => 155.00,
                'compare_at_price' => 175.00,
                'cost_price' => 125.00,
                'stock' => 160,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1585994192701-f1a505c817ea?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Unpolished protein-rich pigeon peas with natural pulse sweetness.',
                'description' => 'Does not undergo any artificial water, oil, or leather polishing, preserving natural nutrients and rich yellow hue.',
                'is_featured' => false,
            ],
            [
                'name' => 'Organic White Kabuli Chana 1kg',
                'category_id' => $catGrains?->id,
                'price' => 145.00,
                'compare_at_price' => 165.00,
                'cost_price' => 110.00,
                'stock' => 130,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1515543237350-b3eea1ec8082?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Large size uniform chickpeas ideal for Amritsari Chole and fresh hummus.',
                'description' => 'Quick-boiling premium chickpea variety packed with plant-based protein and gut-healthy soluble fibre.',
                'is_featured' => false,
            ],

            // Snacks & Beverages
            [
                'name' => 'Haldirams Aloo Bhujia Crispy Namkeen 400g',
                'category_id' => $catSnacks?->id,
                'price' => 125.00,
                'compare_at_price' => 140.00,
                'cost_price' => 95.00,
                'stock' => 200,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1621996346565-e3d5d6281691?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Crisp spicy potato and gram flour strings seasoned with mint and spices.',
                'description' => 'The ultimate tea-time crunch loved across India. Perfectly spiced with red chilli, mint, and dry mango powder.',
                'is_featured' => true,
            ],
            [
                'name' => 'Real 100% Mixed Fruit Juice 1L',
                'category_id' => $catSnacks?->id,
                'price' => 99.00,
                'compare_at_price' => 120.00,
                'cost_price' => 75.00,
                'stock' => 140,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Juicy blend of 9 handpicked fruits with no added sugar or artificial colours.',
                'description' => 'Refreshing morning breakfast juice enriched with natural vitamins and antioxidants. Tetra-pack sealed for prolonged freshness.',
                'is_featured' => false,
            ],
            [
                'name' => 'Tata Tea Gold Fragrant Leaf Tea 500g',
                'category_id' => $catSnacks?->id,
                'price' => 295.00,
                'compare_at_price' => 330.00,
                'cost_price' => 220.00,
                'stock' => 115,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1544787219-7f47ccb76574?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Finest Assam CTC teas gently blended with 15% long-leaf Orthodox tea leaves.',
                'description' => 'Produces rich golden liquor with an irresistible floral aroma. The quintessential Indian morning chai indulgence.',
                'is_featured' => false,
            ],

            // Spices & Oils
            [
                'name' => 'Fortune Sunlite Refined Sunflower Oil 5L Jar',
                'category_id' => $catSpices?->id,
                'price' => 730.00,
                'compare_at_price' => 840.00,
                'cost_price' => 610.00,
                'stock' => 95,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Light, clear cooking oil rich in natural vitamin E and omega fatty acids.',
                'description' => 'Low absorption technology ensures your daily frying and sauteing remains light and heart friendly.',
                'is_featured' => true,
            ],
            [
                'name' => 'Patanjali Pure Desi Cow Ghee 1L Tin',
                'category_id' => $catSpices?->id,
                'price' => 595.00,
                'compare_at_price' => 660.00,
                'cost_price' => 480.00,
                'stock' => 80,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1589985270826-4b7bb135bc9d?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Aromatic golden clarified butter crafted using time-honoured bilona traditions.',
                'description' => 'Granular texture and mouth-watering fragrance that elevates dal tadka, parathas, and traditional sweets.',
                'is_featured' => true,
            ],
            [
                'name' => 'Everest Pure Haldi (Turmeric) Powder 200g',
                'category_id' => $catSpices?->id,
                'price' => 58.00,
                'compare_at_price' => 68.00,
                'cost_price' => 40.00,
                'stock' => 190,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'High curcumin Salem turmeric root ground finely for immune health & rich colour.',
                'description' => 'Naturally dried Salem turmeric rhizomes. Free from artificial fillers, starch, and lead chromate.',
                'is_featured' => false,
            ],

            // Frozen & Instant Foods
            [
                'name' => 'Maggi 2-Minute Masala Noodles (Pack of 12)',
                'category_id' => $catFrozen?->id,
                'price' => 168.00,
                'compare_at_price' => 180.00,
                'cost_price' => 135.00,
                'stock' => 240,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1612927601601-6638404737ce?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Favorite Indian instant noodles enriched with iron and roasted aromatic spices.',
                'description' => 'Quick, satisfying snack ready in just 2 minutes with signature tastemaker sachet in every pouch.',
                'is_featured' => true,
            ],
            [
                'name' => 'Safal Fresh Select Frozen Green Peas 1kg',
                'category_id' => $catFrozen?->id,
                'price' => 130.00,
                'compare_at_price' => 150.00,
                'cost_price' => 95.00,
                'stock' => 85,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Individually Quick Frozen (IQF) sweet green matar directly from North Indian fields.',
                'description' => 'Retains farm freshness, tender crunch, and sweet taste. Ready to cook directly without thawing.',
                'is_featured' => false,
            ],

            // Personal Care & Hygiene
            [
                'name' => 'Colgate MaxFresh Peppermint Toothpaste 300g',
                'category_id' => $catPersonal?->id,
                'price' => 139.00,
                'compare_at_price' => 165.00,
                'cost_price' => 105.00,
                'stock' => 150,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1559563458-527698bf5295?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Infused with cooling cooling crystals for 10x longer fresh breath.',
                'description' => 'Fights cavities, plaque, and morning bad breath with icy cooling gel and intense mint burst.',
                'is_featured' => false,
            ],
            [
                'name' => 'Dove Moisturising Beauty Bathing Bar (Pack of 4)',
                'category_id' => $catPersonal?->id,
                'price' => 199.00,
                'compare_at_price' => 240.00,
                'cost_price' => 150.00,
                'stock' => 130,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1607006314177-3e11a13b0c53?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Gentle formula with 1/4th moisturising cream for radiant and soft skin.',
                'description' => 'Unlike normal soaps, Dove does not strip natural skin oils, leaving skin supple and touchably smooth.',
                'is_featured' => false,
            ],

            // Organic & Health
            [
                'name' => 'Organic India Tulsi Green Tea 25 Infusion Bags',
                'category_id' => $catOrganic?->id,
                'price' => 175.00,
                'compare_at_price' => 199.00,
                'cost_price' => 130.00,
                'stock' => 110,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Certified USDA Organic holy basil & green tea leaves for daily detoxification.',
                'description' => 'Boosts natural metabolic rate, uplifts mood, and strengthens body resistance against seasonal allergies.',
                'is_featured' => true,
            ],
            [
                'name' => 'Saffola FITTIFY Rolled Multigrain Oats 1kg',
                'category_id' => $catOrganic?->id,
                'price' => 289.00,
                'compare_at_price' => 340.00,
                'cost_price' => 210.00,
                'stock' => 90,
                'stock_status' => 'in_stock',
                'featured_image' => 'https://images.unsplash.com/photo-1517673132405-a56a62b18caf?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'High-protein rolled wholegrain oats with beta-glucan for heart health & weight care.',
                'description' => 'Slow-burning energy for breakfast porridge, smoothie bowls, and homemade healthy granola.',
                'is_featured' => false,
            ],
        ];

        // 4. Upsert Products
        foreach ($productsData as $data) {
            $variations = $data['variations'] ?? [];
            unset($data['variations']);

            $slug = Str::slug($data['name']);
            $product = Product::updateOrCreate(
                ['slug' => $slug],
                array_merge($data, [
                    'seller_id' => $seller->id,
                    'sku' => strtoupper(Str::random(8)),
                    'is_active' => true,
                ])
            );

            // Re-seed variations if provided
            if (! empty($variations)) {
                $product->variations()->delete();
                foreach ($variations as $var) {
                    ProductVariation::create(array_merge($var, ['product_id' => $product->id]));
                }
            }
        }
    }
}
