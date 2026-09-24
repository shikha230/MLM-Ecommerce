<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SellerProductController extends Controller
{
    /**
     * Display a listing of seller products with filters.
     */
    public function index(Request $request)
    {
        $seller = Auth::user()->seller;

        $query = Product::where('seller_id', $seller->id)
            ->with(['category', 'variations']);

        // Search by name or SKU
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Filter by Category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by Status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            } elseif ($request->status === 'low_stock') {
                $query->where('stock', '<=', 5);
            }
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        return view('seller.products.index', compact('products', 'categories', 'seller'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('seller.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $seller = Auth::user()->seller;

        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'category_id'       => 'nullable|exists:categories,id',
            'sku'               => 'nullable|string|max:100|unique:products,sku',
            'price'             => 'required|numeric|min:0',
            'compare_at_price'  => 'nullable|numeric|gt:price',
            'cost_price'        => 'nullable|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'featured_image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'gallery_images.*'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'is_active'         => 'nullable|boolean',
            'is_featured'       => 'nullable|boolean',
            
            // Variations
            'variations'                => 'nullable|array',
            'variations.*.type'         => 'required_with:variations|string|max:50',
            'variations.*.name'         => 'required_with:variations|string|max:100',
            'variations.*.sku'          => 'nullable|string|max:100',
            'variations.*.price'        => 'nullable|numeric|min:0',
            'variations.*.stock'        => 'nullable|integer|min:0',
        ]);

        // Generate Slug
        $slug = Str::slug($validated['name']);
        if (Product::where('slug', $slug)->exists()) {
            $slug .= '-' . strtolower(Str::random(5));
        }

        // Handle Featured Image Upload
        $featuredImagePath = null;
        if ($request->hasFile('featured_image')) {
            $featuredImagePath = $request->file('featured_image')->store('products/featured', 'public');
        }

        // Determine Stock Status
        $stockStatus = 'in_stock';
        if ($validated['stock'] <= 0) {
            $stockStatus = 'out_of_stock';
        } elseif ($validated['stock'] <= 5) {
            $stockStatus = 'low_stock';
        }

        // Create Product
        $product = Product::create([
            'seller_id'         => $seller->id,
            'category_id'       => $validated['category_id'] ?? null,
            'name'              => $validated['name'],
            'slug'              => $slug,
            'sku'               => !empty($validated['sku']) ? $validated['sku'] : 'SKU-' . strtoupper(Str::random(8)),
            'short_description' => $validated['short_description'] ?? null,
            'description'       => $validated['description'] ?? null,
            'price'             => $validated['price'],
            'compare_at_price'  => $validated['compare_at_price'] ?? null,
            'cost_price'        => $validated['cost_price'] ?? null,
            'stock'             => $validated['stock'],
            'stock_status'      => $stockStatus,
            'featured_image'    => $featuredImagePath,
            'is_active'         => $request->boolean('is_active', true),
            'is_featured'       => $request->boolean('is_featured', false),
        ]);

        // Handle Gallery Images Upload
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $idx => $galleryFile) {
                $path = $galleryFile->store('products/gallery', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'sort_order' => $idx,
                    'is_primary' => false,
                ]);
            }
        }

        // Handle Variations
        if (!empty($validated['variations'])) {
            foreach ($validated['variations'] as $vData) {
                if (!empty($vData['name'])) {
                    ProductVariation::create([
                        'product_id' => $product->id,
                        'type'       => $vData['type'] ?? 'Size',
                        'name'       => $vData['name'],
                        'sku'        => $vData['sku'] ?? null,
                        'price'      => !empty($vData['price']) ? $vData['price'] : $product->price,
                        'stock'      => $vData['stock'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('seller.products.index')
            ->with('success', 'Product "' . $product->name . '" has been published successfully!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $seller = Auth::user()->seller;

        if ($product->seller_id !== $seller->id) {
            abort(403, 'Unauthorized product access.');
        }

        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $product->load(['images', 'variations']);

        return view('seller.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $seller = Auth::user()->seller;

        if ($product->seller_id !== $seller->id) {
            abort(403, 'Unauthorized product access.');
        }

        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'category_id'       => 'nullable|exists:categories,id',
            'sku'               => 'nullable|string|max:100|unique:products,sku,' . $product->id,
            'price'             => 'required|numeric|min:0',
            'compare_at_price'  => 'nullable|numeric|gt:price',
            'cost_price'        => 'nullable|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'featured_image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'gallery_images.*'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'is_active'         => 'nullable|boolean',
            'is_featured'       => 'nullable|boolean',

            // Existing Variations update
            'existing_variations'       => 'nullable|array',
            'existing_variations.*.id'  => 'required|exists:product_variations,id',
            'existing_variations.*.type'=> 'required|string',
            'existing_variations.*.name'=> 'required|string',
            'existing_variations.*.sku' => 'nullable|string',
            'existing_variations.*.price'=> 'nullable|numeric',
            'existing_variations.*.stock'=> 'nullable|integer',

            // New Variations
            'new_variations'            => 'nullable|array',
            'new_variations.*.type'     => 'nullable|string',
            'new_variations.*.name'     => 'nullable|string',
            'new_variations.*.sku'      => 'nullable|string',
            'new_variations.*.price'    => 'nullable|numeric',
            'new_variations.*.stock'    => 'nullable|integer',
        ]);

        // Featured Image Upload
        if ($request->hasFile('featured_image')) {
            if ($product->featured_image) {
                Storage::disk('public')->delete($product->featured_image);
            }
            $product->featured_image = $request->file('featured_image')->store('products/featured', 'public');
        }

        // Determine Stock Status
        $stockStatus = 'in_stock';
        if ($validated['stock'] <= 0) {
            $stockStatus = 'out_of_stock';
        } elseif ($validated['stock'] <= 5) {
            $stockStatus = 'low_stock';
        }

        $product->update([
            'category_id'       => $validated['category_id'] ?? null,
            'name'              => $validated['name'],
            'sku'               => $validated['sku'] ?? $product->sku,
            'short_description' => $validated['short_description'] ?? null,
            'description'       => $validated['description'] ?? null,
            'price'             => $validated['price'],
            'compare_at_price'  => $validated['compare_at_price'] ?? null,
            'cost_price'        => $validated['cost_price'] ?? null,
            'stock'             => $validated['stock'],
            'stock_status'      => $stockStatus,
            'is_active'         => $request->boolean('is_active', true),
            'is_featured'       => $request->boolean('is_featured', false),
        ]);

        // Upload additional gallery images
        if ($request->hasFile('gallery_images')) {
            $startOrder = $product->images()->count();
            foreach ($request->file('gallery_images') as $idx => $galleryFile) {
                $path = $galleryFile->store('products/gallery', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'sort_order' => $startOrder + $idx,
                    'is_primary' => false,
                ]);
            }
        }

        // Update Existing Variations
        if (!empty($validated['existing_variations'])) {
            foreach ($validated['existing_variations'] as $vData) {
                ProductVariation::where('id', $vData['id'])
                    ->where('product_id', $product->id)
                    ->update([
                        'type'  => $vData['type'],
                        'name'  => $vData['name'],
                        'sku'   => $vData['sku'] ?? null,
                        'price' => !empty($vData['price']) ? $vData['price'] : $product->price,
                        'stock' => $vData['stock'] ?? 0,
                    ]);
            }
        }

        // Add New Variations
        if (!empty($validated['new_variations'])) {
            foreach ($validated['new_variations'] as $nv) {
                if (!empty($nv['name'])) {
                    ProductVariation::create([
                        'product_id' => $product->id,
                        'type'       => $nv['type'] ?? 'Size',
                        'name'       => $nv['name'],
                        'sku'        => $nv['sku'] ?? null,
                        'price'      => !empty($nv['price']) ? $nv['price'] : $product->price,
                        'stock'      => $nv['stock'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('seller.products.index')
            ->with('success', 'Product "' . $product->name . '" has been updated.');
    }

    /**
     * Delete the specified product.
     */
    public function destroy(Product $product)
    {
        $seller = Auth::user()->seller;

        if ($product->seller_id !== $seller->id) {
            abort(403, 'Unauthorized.');
        }

        // Delete images
        if ($product->featured_image) {
            Storage::disk('public')->delete($product->featured_image);
        }
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }

        $name = $product->name;
        $product->delete();

        return redirect()->route('seller.products.index')
            ->with('success', 'Product "' . $name . '" has been deleted.');
    }

    /**
     * Toggle product active status.
     */
    public function toggleStatus(Product $product)
    {
        $seller = Auth::user()->seller;

        if ($product->seller_id !== $seller->id) {
            abort(403, 'Unauthorized.');
        }

        $product->is_active = !$product->is_active;
        $product->save();

        $statusText = $product->is_active ? 'activated' : 'deactivated';

        return back()->with('success', "Product is now {$statusText}.");
    }

    /**
     * Delete single gallery image.
     */
    public function deleteImage(Product $product, ProductImage $image)
    {
        $seller = Auth::user()->seller;

        if ($product->seller_id !== $seller->id || $image->product_id !== $product->id) {
            abort(403, 'Unauthorized.');
        }

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image removed from gallery.');
    }

    /**
     * Delete a variation.
     */
    public function deleteVariation(Product $product, ProductVariation $variation)
    {
        $seller = Auth::user()->seller;

        if ($product->seller_id !== $seller->id || $variation->product_id !== $product->id) {
            abort(403, 'Unauthorized.');
        }

        $variation->delete();

        return back()->with('success', 'Product variation removed.');
    }
}
