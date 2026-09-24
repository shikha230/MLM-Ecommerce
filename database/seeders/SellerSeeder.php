<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
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
        // 1. Create or Find Seller User
        $user = User::firstOrCreate(
            ['email' => 'seller@shopsphere.com'],
            [
                'name' => 'Apex Retailers',
                'phone' => '9876543210',
                'password' => Hash::make('Password123!'),
                'role' => 'seller',
                'referral_code' => 'SELLER01',
            ]
        );

        // 2. Create Seller Profile
        $seller = Seller::firstOrCreate(
            ['user_id' => $user->id],
            [
                'store_name' => 'Apex Mega Store',
                'store_slug' => 'apex-mega-store',
                'store_phone' => '9876543210',
                'store_email' => 'seller@shopsphere.com',
                'store_description' => 'Official authorized vendor for electronics, wellness, and lifestyle products with fast shipping across India.',
                'gst_number' => '27AAACA1234A1Z5',
                'pan_number' => 'AAACA1234A',
                'bank_name' => 'HDFC Bank',
                'bank_account_holder' => 'Apex Retailers LLP',
                'bank_account_number' => '50100234567890',
                'bank_ifsc' => 'HDFC0001234',
                'address' => 'Plot 42, Tech Park, Andheri East',
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
                'pincode' => '400069',
                'status' => 'approved',
                'rating' => 4.85,
            ]
        );

        $catElectronics = Category::where('slug', 'electronics-gadgets')->first();
        $catFashion = Category::where('slug', 'fashion-apparel')->first();
        $catWellness = Category::where('slug', 'mlm-wellness-nutrition')->first();

        // 3. Sample Products
        $productsData = [
            [
                'name' => 'Pro Wireless Noise Cancelling Earbuds',
                'category_id' => $catElectronics?->id,
                'price' => 2499.00,
                'compare_at_price' => 4999.00,
                'cost_price' => 1400.00,
                'stock' => 45,
                'stock_status' => 'in_stock',
                'short_description' => 'True wireless stereo earbuds with active noise cancellation and 36hr battery.',
                'description' => 'Experience crystal-clear acoustics and deep bass with high-fidelity dynamic drivers. Features Bluetooth 5.3, IPX5 water resistance, and rapid type-C fast charging.',
                'is_featured' => true,
                'variations' => [
                    ['type' => 'Color', 'name' => 'Midnight Black', 'sku' => 'EAR-BLK-01', 'price' => 2499.00, 'stock' => 25],
                    ['type' => 'Color', 'name' => 'Pearl White', 'sku' => 'EAR-WHT-02', 'price' => 2499.00, 'stock' => 20],
                ],
            ],
            [
                'name' => 'Premium Men\'s Slim Fit Cotton Shirt',
                'category_id' => $catFashion?->id,
                'price' => 1199.00,
                'compare_at_price' => 1999.00,
                'cost_price' => 600.00,
                'stock' => 18,
                'stock_status' => 'in_stock',
                'short_description' => '100% breathable organic combed cotton formal and casual wear shirt.',
                'description' => 'Tailored to perfection with a modern slim fit silhouette. Pre-shrunk fabric ensures durability and all-day comfort for work and evening occasions.',
                'is_featured' => false,
                'variations' => [
                    ['type' => 'Size', 'name' => 'Medium (M)', 'sku' => 'SHIRT-M-01', 'price' => 1199.00, 'stock' => 8],
                    ['type' => 'Size', 'name' => 'Large (L)', 'sku' => 'SHIRT-L-02', 'price' => 1199.00, 'stock' => 6],
                    ['type' => 'Size', 'name' => 'XL', 'sku' => 'SHIRT-XL-03', 'price' => 1299.00, 'stock' => 4],
                ],
            ],
            [
                'name' => 'Gold MLM Immunity Booster Health Pack',
                'category_id' => $catWellness?->id,
                'price' => 3499.00,
                'compare_at_price' => 4499.00,
                'cost_price' => 1800.00,
                'stock' => 5,
                'stock_status' => 'low_stock',
                'short_description' => 'Supercharge your daily energy and immunity with 100% natural Ayurvedic botanicals.',
                'description' => 'Comprehensive multi-level marketing wellness combo packed with Ashwagandha, Giloy, Curcumin, and essential multivitamins. High affiliate bonus potential.',
                'is_featured' => true,
                'variations' => [],
            ],
        ];

        foreach ($productsData as $pData) {
            $variations = $pData['variations'];
            unset($pData['variations']);

            $slug = Str::slug($pData['name']);
            $product = Product::firstOrCreate(
                ['slug' => $slug],
                array_merge($pData, [
                    'seller_id' => $seller->id,
                    'sku' => 'SKU-' . strtoupper(Str::random(6)),
                    'is_active' => true,
                ])
            );

            // Add variations
            foreach ($variations as $var) {
                ProductVariation::firstOrCreate(
                    [
                        'product_id' => $product->id,
                        'name' => $var['name'],
                        'type' => $var['type'],
                    ],
                    $var
                );
            }
        }

        // 4. Create Sample Customer and Demo Order for Seller
        $customer = User::firstOrCreate(
            ['email' => 'customer_demo@example.com'],
            [
                'name' => 'Rohit Saxena',
                'phone' => '9988776655',
                'password' => Hash::make('Password123!'),
                'role' => 'customer',
                'referral_code' => 'ROHIT123',
            ]
        );

        $firstProduct = Product::where('seller_id', $seller->id)->first();
        if ($firstProduct) {
            $order = Order::firstOrCreate(
                ['order_number' => 'ORD-2026-9842'],
                [
                    'user_id' => $customer->id,
                    'total_amount' => $firstProduct->price * 2,
                    'shipping_amount' => 0.00,
                    'payment_method' => 'UPI',
                    'payment_status' => 'paid',
                    'payment_id' => 'pay_upi_sample982',
                    'order_status' => 'processing',
                    'shipping_name' => 'Rohit Saxena',
                    'shipping_phone' => '9988776655',
                    'shipping_email' => 'customer_demo@example.com',
                    'shipping_address' => 'Flat 302, Green Valley Apartments, Sector 14',
                    'shipping_city' => 'Gurugram',
                    'shipping_state' => 'Haryana',
                    'shipping_pincode' => '122001',
                    'notes' => 'Please deliver between 2 PM to 6 PM.',
                ]
            );

            $commission = round($firstProduct->price * 2 * 0.10, 2); // 10% platform fee
            $earning = ($firstProduct->price * 2) - $commission;

            OrderItem::firstOrCreate(
                ['order_id' => $order->id, 'seller_id' => $seller->id],
                [
                    'product_id' => $firstProduct->id,
                    'product_name' => $firstProduct->name,
                    'variation_details' => 'Midnight Black',
                    'price' => $firstProduct->price,
                    'quantity' => 2,
                    'subtotal' => $firstProduct->price * 2,
                    'commission_amount' => $commission,
                    'seller_earning' => $earning,
                    'status' => 'processing',
                ]
            );
        }
    }
}
