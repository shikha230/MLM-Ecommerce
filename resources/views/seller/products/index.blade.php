@extends('seller.layouts.app')

@section('title', 'Products')

@section('content')

<!-- Top Bar -->
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
    <div>
        <h2 style="font-size:22px;font-weight:800;color:#111827;margin:0 0 4px;">🛍️ Product Catalog</h2>
        <p style="font-size:14px;color:#6b7280;margin:0;">{{ $products->total() }} products in your store</p>
    </div>
    <a href="{{ route('seller.products.create') }}"
        style="display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;text-decoration:none;padding:12px 24px;border-radius:12px;font-size:14px;font-weight:700;box-shadow:0 4px 14px rgba(79,70,229,0.3);">
        ➕ Add New Product
    </a>
</div>

<!-- Filters -->
<div style="background:#fff;border-radius:16px;padding:20px 24px;margin-bottom:20px;box-shadow:0 2px 10px rgba(0,0,0,0.05);border:1px solid #f3f4f6;">
    <form method="GET" action="{{ route('seller.products.index') }}" style="display:flex;gap:12px;flex-wrap:wrap;align-items:flex-end;">
        <div style="flex:1;min-width:200px;">
            <label style="font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:6px;">Search</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Product name or SKU..."
                style="width:100%;padding:10px 14px;border:2px solid #e5e7eb;border-radius:10px;font-size:14px;outline:none;box-sizing:border-box;font-family:inherit;"
                onfocus="this.style.borderColor='#4f46e5'" onblur="this.style.borderColor='#e5e7eb'">
        </div>
        <div>
            <label style="font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:6px;">Status</label>
            <select name="status" style="padding:10px 14px;border:2px solid #e5e7eb;border-radius:10px;font-size:14px;outline:none;font-family:inherit;background:#fff;" onchange="this.form.submit()">
                <option value="">All</option>
                <option value="active" {{ request('status')=='active'?'selected':'' }}>Active</option>
                <option value="inactive" {{ request('status')=='inactive'?'selected':'' }}>Inactive</option>
                <option value="low_stock" {{ request('status')=='low_stock'?'selected':'' }}>Low Stock</option>
            </select>
        </div>
        <div>
            <label style="font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:6px;">Category</label>
            <select name="category_id" style="padding:10px 14px;border:2px solid #e5e7eb;border-radius:10px;font-size:14px;outline:none;font-family:inherit;background:#fff;" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories ?? [] as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" style="padding:10px 22px;background:#4f46e5;color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;font-family:inherit;">🔍 Search</button>
        @if(request()->hasAny(['search','status','category_id']))
            <a href="{{ route('seller.products.index') }}" style="padding:10px 22px;background:#f3f4f6;color:#374151;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;">✕ Clear</a>
        @endif
    </form>
</div>

@if(session('success'))
    <div style="background:#ecfdf5;border:1px solid #6ee7b7;border-radius:12px;padding:14px 18px;margin-bottom:20px;font-size:14px;color:#065f46;font-weight:500;">
        ✅ {{ session('success') }}
    </div>
@endif

<!-- Products Table -->
<div style="background:#fff;border-radius:18px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:#f9fafb;border-bottom:2px solid #e5e7eb;">
                <th style="padding:14px 20px;text-align:left;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Product</th>
                <th style="padding:14px 20px;text-align:left;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Category</th>
                <th style="padding:14px 20px;text-align:right;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Price</th>
                <th style="padding:14px 20px;text-align:right;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Stock</th>
                <th style="padding:14px 20px;text-align:center;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Status</th>
                <th style="padding:14px 20px;text-align:center;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr style="border-bottom:1px solid #f3f4f6;transition:background 0.15s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">
                    <td style="padding:16px 20px;">
                        <div style="display:flex;align-items:center;gap:14px;">
                            <div style="width:52px;height:52px;border-radius:12px;overflow:hidden;flex-shrink:0;background:#f3f4f6;">
                                @if($product->featured_image)
                                    <img src="{{ Storage::url($product->featured_image) }}" style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:22px;">📦</div>
                                @endif
                            </div>
                            <div>
                                <p style="font-size:14px;font-weight:700;color:#111827;margin:0 0 3px;">{{ $product->name }}</p>
                                <p style="font-size:12px;color:#9ca3af;margin:0;">SKU: {{ $product->sku ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </td>
                    <td style="padding:16px 20px;font-size:13px;color:#6b7280;">{{ $product->category->name ?? '—' }}</td>
                    <td style="padding:16px 20px;text-align:right;">
                        <span style="font-size:14px;font-weight:700;color:#111827;">₹{{ number_format($product->price, 2) }}</span>
                        @if($product->compare_at_price && $product->compare_at_price > $product->price)
                            <br><span style="font-size:12px;color:#9ca3af;text-decoration:line-through;">₹{{ number_format($product->compare_at_price, 2) }}</span>
                        @endif
                    </td>
                    <td style="padding:16px 20px;text-align:right;">
                        @php $stockLow = ($product->stock ?? 0) <= 5; @endphp
                        <span style="font-size:14px;font-weight:700;color:{{ $stockLow ? '#ef4444' : '#111827' }};">{{ $product->stock ?? 0 }}</span>
                        @if($stockLow && $product->stock > 0)
                            <br><span style="font-size:11px;color:#ef4444;">Low stock</span>
                        @elseif($product->stock == 0)
                            <br><span style="font-size:11px;color:#ef4444;">Out of stock</span>
                        @endif
                    </td>
                    <td style="padding:16px 20px;text-align:center;">
                        @if($product->is_active)
                            <span style="font-size:12px;font-weight:600;color:#059669;background:#ecfdf5;padding:4px 12px;border-radius:50px;">● Active</span>
                        @else
                            <span style="font-size:12px;font-weight:600;color:#9ca3af;background:#f3f4f6;padding:4px 12px;border-radius:50px;">● Inactive</span>
                        @endif
                    </td>
                    <td style="padding:16px 20px;text-align:center;">
                        <div style="display:flex;gap:8px;justify-content:center;">
                            <a href="{{ route('seller.products.edit', $product->id) }}" style="display:inline-flex;align-items:center;gap:5px;padding:7px 14px;background:#eef2ff;color:#4f46e5;border-radius:9px;font-size:13px;font-weight:600;text-decoration:none;">✏️ Edit</a>
                            <form method="POST" action="{{ route('seller.products.destroy', $product->id) }}" onsubmit="return confirm('Delete \'{{ addslashes($product->name) }}\'? This cannot be undone.')">
                                @csrf @method('DELETE')
                                <button type="submit" style="display:inline-flex;align-items:center;gap:5px;padding:7px 14px;background:#fef2f2;color:#ef4444;border:none;border-radius:9px;font-size:13px;font-weight:600;cursor:pointer;font-family:inherit;">🗑️ Del</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding:60px;text-align:center;">
                        <div style="font-size:56px;margin-bottom:16px;">📦</div>
                        <h3 style="font-size:18px;font-weight:700;color:#111827;margin:0 0 8px;">No products yet</h3>
                        <p style="font-size:14px;color:#6b7280;margin:0 0 20px;">Start building your catalog by adding your first product.</p>
                        <a href="{{ route('seller.products.create') }}" style="display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;text-decoration:none;padding:12px 28px;border-radius:12px;font-size:14px;font-weight:700;">➕ Add First Product</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($products->hasPages())
        <div style="padding:20px 24px;border-top:1px solid #f3f4f6;">
            {{ $products->withQueryString()->links() }}
        </div>
    @endif
</div>

@endsection
