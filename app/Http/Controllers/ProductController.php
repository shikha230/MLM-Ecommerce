<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController
{
    /**
     * Display a listing of products with search and category filtering.
     */
    public function index(Request $request)
    {
        $query = Product::query()
            ->where('is_active', true)
            ->with(['category', 'seller']);

        // Search Filter
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Category Filter (supports slug or ID)
        $selectedCategory = null;
        if ($request->filled('category')) {
            $catParam = $request->input('category');
            $selectedCategory = Category::where('slug', $catParam)
                ->orWhere('id', $catParam)
                ->first();

            if ($selectedCategory) {
                $query->where('category_id', $selectedCategory->id);
            }
        }

        // Price Filter
        if ($request->filled('min_price') && is_numeric($request->input('min_price'))) {
            $query->where('price', '>=', (float) $request->input('min_price'));
        }
        if ($request->filled('max_price') && is_numeric($request->input('max_price'))) {
            $query->where('price', '<=', (float) $request->input('max_price'));
        }

        // In Stock Filter
        if ($request->boolean('in_stock')) {
            $query->where('stock', '>', 0);
        }

        // Sorting
        $sort = $request->input('sort', 'featured');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'featured':
            default:
                $query->orderBy('is_featured', 'desc')->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        // Get all active categories with product counts
        $categories = Category::where('is_active', true)
            ->withCount(['products' => function ($q) {
                $q->where('is_active', true);
            }])
            ->get();

        $totalActiveProducts = Product::where('is_active', true)->count();

        return view('products.index', compact(
            'products',
            'categories',
            'selectedCategory',
            'totalActiveProducts'
        ));
    }

    /**
     * Display a single product's detail page.
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'seller', 'images', 'variations'])
            ->firstOrFail();

        // Increment views
        $product->increment('views_count');

        // Related products
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with(['category', 'seller'])
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
