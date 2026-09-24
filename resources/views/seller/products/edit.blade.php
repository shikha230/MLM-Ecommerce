@extends('seller.layouts.app')

@section('title', 'Edit Product')

@section('content')

<div style="max-width:900px;margin:0 auto;">
    <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px;">
        <a href="{{ route('seller.products.index') }}" style="width:40px;height:40px;border-radius:12px;background:#fff;border:2px solid #e5e7eb;display:flex;align-items:center;justify-content:center;font-size:18px;text-decoration:none;color:#374151;">←</a>
        <div>
            <h2 style="font-size:22px;font-weight:800;color:#111827;margin:0 0 3px;">✏️ Edit Product</h2>
            <p style="font-size:14px;color:#6b7280;margin:0;">{{ $product->name }}</p>
        </div>
    </div>

    @if(session('success'))
        <div style="background:#ecfdf5;border:1px solid #6ee7b7;border-radius:12px;padding:14px 18px;margin-bottom:20px;font-size:14px;color:#065f46;">✅ {{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('seller.products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <!-- Basic Info -->
        <div style="background:#fff;border-radius:20px;padding:28px;margin-bottom:20px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 20px;padding-bottom:12px;border-bottom:2px solid #f3f4f6;">📝 Basic Information</h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div style="grid-column:span 2;" class="fg">
                    <label class="fl">Product Name <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="fi" required>
                </div>
                <div class="fg">
                    <label class="fl">Category</label>
                    <select name="category_id" class="fi">
                        <option value="">— Select Category —</option>
                        @foreach($categories ?? [] as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="fg">
                    <label class="fl">SKU / Model Number</label>
                    <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="fi">
                </div>
                <div style="grid-column:span 2;" class="fg">
                    <label class="fl">Short Description</label>
                    <textarea name="short_description" class="fi" rows="2">{{ old('short_description', $product->short_description) }}</textarea>
                </div>
                <div style="grid-column:span 2;" class="fg">
                    <label class="fl">Full Description</label>
                    <textarea name="description" class="fi" rows="4">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Pricing & Inventory -->
        <div style="background:#fff;border-radius:20px;padding:28px;margin-bottom:20px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 20px;padding-bottom:12px;border-bottom:2px solid #f3f4f6;">💰 Pricing & Inventory</h3>
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;">
                <div class="fg">
                    <label class="fl">Selling Price (₹) <span style="color:#ef4444;">*</span></label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" class="fi" step="0.01" min="0" required>
                </div>
                <div class="fg">
                    <label class="fl">Compare At Price (₹)</label>
                    <input type="number" name="compare_at_price" value="{{ old('compare_at_price', $product->compare_at_price) }}" class="fi" step="0.01" min="0">
                </div>
                <div class="fg">
                    <label class="fl">Cost Price (₹)</label>
                    <input type="number" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}" class="fi" step="0.01" min="0">
                </div>
                <div class="fg">
                    <label class="fl">Stock Quantity <span style="color:#ef4444;">*</span></label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="fi" min="0" required>
                </div>
                <div class="fg">
                    <label class="fl">Status</label>
                    <select name="is_active" class="fi">
                        <option value="1" {{ old('is_active', $product->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>✅ Active</option>
                        <option value="0" {{ old('is_active', $product->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>⏸ Inactive</option>
                    </select>
                </div>
                <div class="fg">
                    <label class="fl">Featured</label>
                    <select name="is_featured" class="fi">
                        <option value="0" {{ old('is_featured', $product->is_featured ? '1' : '0') == '0' ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('is_featured', $product->is_featured ? '1' : '0') == '1' ? 'selected' : '' }}>⭐ Yes</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Images -->
        <div style="background:#fff;border-radius:20px;padding:28px;margin-bottom:20px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 20px;padding-bottom:12px;border-bottom:2px solid #f3f4f6;">📸 Product Images</h3>

            <!-- Current Featured Image -->
            @if($product->featured_image)
                <div style="margin-bottom:24px;">
                    <label class="fl" style="margin-bottom:10px;display:block;">Current Featured Image</label>
                    <div style="display:flex;align-items:center;gap:16px;">
                        <img src="{{ Storage::url($product->featured_image) }}" style="width:100px;height:100px;object-fit:cover;border-radius:12px;border:2px solid #e5e7eb;">
                        <div>
                            <p style="font-size:13px;color:#6b7280;margin:0 0 8px;">Upload a new image to replace this one</p>
                            <label style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:#eef2ff;color:#4f46e5;border-radius:9px;font-size:13px;font-weight:600;cursor:pointer;">
                                🔄 Replace Image
                                <input type="file" name="featured_image" accept="image/*" style="display:none;" onchange="previewNew(this)">
                            </label>
                            <div id="new-feat-preview" style="display:none;margin-top:10px;">
                                <p style="font-size:12px;color:#059669;font-weight:600;margin:0 0 6px;">✅ New image selected:</p>
                                <img id="new-feat-img" style="width:80px;height:80px;object-fit:cover;border-radius:10px;border:2px solid #6ee7b7;">
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="fg" style="margin-bottom:20px;">
                    <label class="fl">Upload Featured Image</label>
                    <div style="border:2px dashed #c7d2fe;border-radius:14px;padding:28px;text-align:center;background:#f9f9ff;cursor:pointer;" onclick="document.getElementById('featured-image-upload').click()">
                        <div id="new-feat-preview-ph" style="font-size:36px;margin-bottom:8px;">🖼️</div>
                        <p style="font-size:14px;font-weight:600;color:#4f46e5;margin:0;">Click to upload</p>
                        <input type="file" id="featured-image-upload" name="featured_image" accept="image/*" style="display:none;" onchange="previewNew(this)">
                    </div>
                </div>
            @endif

            <!-- Existing Gallery -->
            @if($product->images && $product->images->count() > 0)
                <div style="margin-bottom:20px;">
                    <label class="fl" style="margin-bottom:10px;display:block;">Gallery Images</label>
                    <div style="display:flex;gap:10px;flex-wrap:wrap;">
                        @foreach($product->images as $img)
                            <div style="position:relative;">
                                <img src="{{ Storage::url($img->image_path) }}" style="width:80px;height:80px;object-fit:cover;border-radius:10px;border:2px solid #e5e7eb;">
                                <form method="POST" action="{{ route('seller.products.images.destroy', ['product' => $product->id, 'image' => $img->id]) }}" style="position:absolute;top:-6px;right:-6px;" onsubmit="return confirm('Delete this image?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="width:20px;height:20px;border-radius:50%;background:#ef4444;color:#fff;border:none;font-size:11px;cursor:pointer;display:flex;align-items:center;justify-content:center;line-height:1;">✕</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Add more gallery images -->
            <div class="fg">
                <label class="fl">Add More Gallery Images</label>
                <div style="border:2px dashed #e5e7eb;border-radius:14px;padding:20px;text-align:center;background:#fafafa;cursor:pointer;" onclick="document.getElementById('gallery-images-edit').click()">
                    <div id="gallery-preview-edit" style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;margin-bottom:8px;"></div>
                    <p style="font-size:13px;color:#6b7280;margin:0;">📸 Click to add gallery images</p>
                    <input type="file" id="gallery-images-edit" name="gallery_images[]" accept="image/*" multiple style="display:none;" onchange="previewGallery(this)">
                </div>
            </div>
        </div>

        <!-- Existing Variations -->
        @if($product->variations && $product->variations->count() > 0)
        <div style="background:#fff;border-radius:20px;padding:28px;margin-bottom:20px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 16px;padding-bottom:12px;border-bottom:2px solid #f3f4f6;">🎨 Existing Variations</h3>
            <table style="width:100%;border-collapse:collapse;">
                <thead><tr style="background:#f9fafb;">
                    <th style="padding:10px 14px;text-align:left;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;">Type</th>
                    <th style="padding:10px 14px;text-align:left;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;">Value</th>
                    <th style="padding:10px 14px;text-align:right;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;">Stock</th>
                    <th style="padding:10px 14px;text-align:right;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;">Price</th>
                    <th style="padding:10px 14px;text-align:center;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;">Action</th>
                </tr></thead>
                <tbody>
                    @foreach($product->variations as $variation)
                        <tr style="border-bottom:1px solid #f3f4f6;">
                            <td style="padding:10px 14px;font-size:13px;color:#374151;text-transform:capitalize;">{{ $variation->type }}</td>
                            <td style="padding:10px 14px;font-size:13px;font-weight:600;color:#111827;">{{ $variation->name }}</td>
                            <td style="padding:10px 14px;font-size:13px;color:#374151;text-align:right;">{{ $variation->stock }}</td>
                            <td style="padding:10px 14px;font-size:13px;color:#374151;text-align:right;">₹{{ number_format($variation->price ?? 0, 2) }}</td>
                            <td style="padding:10px 14px;text-align:center;">
                                <form method="POST" action="{{ route('seller.products.variations.destroy', ['product' => $product->id, 'variation' => $variation->id]) }}" onsubmit="return confirm('Delete this variation?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="padding:5px 12px;background:#fef2f2;color:#ef4444;border:none;border-radius:8px;font-size:12px;cursor:pointer;font-family:inherit;">✕ Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- Add New Variations -->
        <div style="background:#fff;border-radius:20px;padding:28px;margin-bottom:28px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;padding-bottom:12px;border-bottom:2px solid #f3f4f6;">
                <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0;">➕ Add New Variations</h3>
                <button type="button" onclick="addVariation()" style="padding:8px 16px;background:#eef2ff;color:#4f46e5;border:none;border-radius:10px;font-size:13px;font-weight:600;cursor:pointer;font-family:inherit;">+ Add</button>
            </div>
            <div id="variations-container"><p style="font-size:13px;color:#9ca3af;text-align:center;padding:16px 0;margin:0;" id="no-var-text">Click Add to add new variations.</p></div>
        </div>

        <!-- Submit -->
        <div style="display:flex;gap:12px;justify-content:flex-end;">
            <a href="{{ route('seller.products.index') }}" style="padding:14px 28px;background:#f3f4f6;color:#374151;border-radius:12px;font-size:14px;font-weight:600;text-decoration:none;">Cancel</a>
            <button type="submit" style="padding:14px 36px;background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;border:none;border-radius:12px;font-size:14px;font-weight:700;cursor:pointer;font-family:inherit;box-shadow:0 4px 14px rgba(79,70,229,0.3);">
                💾 Save Changes
            </button>
        </div>
    </form>
</div>

<style>
.fg { display:flex; flex-direction:column; gap:7px; }
.fl { font-size:13px; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:0.5px; }
.fi { width:100%; padding:12px 16px; border:2px solid #e5e7eb; border-radius:12px; font-size:14px; color:#111827; outline:none; font-family:inherit; background:#fafafa; box-sizing:border-box; transition:all 0.2s; }
.fi:focus { border-color:#4f46e5; box-shadow:0 0 0 4px rgba(79,70,229,0.1); background:#fff; }
.variation-row { background:#f9fafb; border:1px solid #e5e7eb; border-radius:14px; padding:18px; margin-bottom:12px; position:relative; }
</style>

<script>
let varCount = 0;
function addVariation() {
    document.getElementById('no-var-text')?.remove();
    varCount++;
    const c = document.getElementById('variations-container');
    const div = document.createElement('div');
    div.className = 'variation-row';
    div.id = 'var-' + varCount;
    div.innerHTML = `
        <button type="button" onclick="document.getElementById('var-${varCount}').remove()" style="position:absolute;top:10px;right:12px;background:#fef2f2;color:#ef4444;border:none;border-radius:8px;padding:4px 10px;font-size:12px;cursor:pointer;font-family:inherit;">✕</button>
        <div style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:14px;">
            <div class="fg"><label class="fl">Type</label>
                <select name="new_variations[${varCount}][type]" class="fi"><option value="Size">Size</option><option value="Color">Color</option><option value="Material">Material</option><option value="Storage">Storage</option><option value="Other">Other</option></select>
            </div>
            <div class="fg"><label class="fl">Value / Name *</label><input type="text" name="new_variations[${varCount}][name]" class="fi" placeholder="Red, XL, 128GB..." required></div>
            <div class="fg"><label class="fl">Stock</label><input type="number" name="new_variations[${varCount}][stock]" class="fi" value="0" min="0"></div>
            <div class="fg"><label class="fl">Price (₹)</label><input type="number" name="new_variations[${varCount}][price]" class="fi" placeholder="Base price" step="0.01" min="0"></div>
        </div>`;
    c.appendChild(div);
}
function previewNew(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('new-feat-img');
            const prev = document.getElementById('new-feat-preview');
            if (img) { img.src = e.target.result; }
            if (prev) { prev.style.display = 'block'; }
        };
        reader.readAsDataURL(file);
    }
}
function previewGallery(input) {
    const c = document.getElementById('gallery-preview-edit');
    c.innerHTML = '';
    Array.from(input.files).slice(0,5).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.cssText = 'width:70px;height:70px;object-fit:cover;border-radius:10px;border:2px solid #e5e7eb;';
            c.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}
</script>

@endsection
