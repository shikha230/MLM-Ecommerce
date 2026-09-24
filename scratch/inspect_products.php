<?php
require dirname(__DIR__) . '/vendor/autoload.php';
$app = require_once dirname(__DIR__) . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== CATEGORIES ===\n";
foreach (\App\Models\Category::all() as $c) {
    echo "ID: {$c->id} | {$c->name} ({$c->slug}) | Products count: {$c->products()->count()}\n";
}

echo "\n=== PRODUCTS ===\n";
foreach (\App\Models\Product::with('category')->get() as $p) {
    echo "ID: {$p->id} | {$p->name} | Price: ₹{$p->price} | Category: " . ($p->category->name ?? 'None') . " | Image: {$p->featured_image} | Active: {$p->is_active}\n";
}
