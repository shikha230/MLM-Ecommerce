<?php

// Run: php scratch/update_grocery_data.php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Artisan;

echo "Seeding fresh grocery categories and products...\n";
Artisan::call('db:seed', ['--force' => true]);
echo Artisan::output();

echo 'Total Categories: '.Category::count()."\n";
echo 'Total Grocery Products: '.Product::count()."\n";
echo "Done!\n";
