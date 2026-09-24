@extends('seller.layouts.app')

@section('title', 'Add New Product')

@section('content')

<div style="max-width:900px;margin:0 auto;">
    <!-- Header -->
    <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px;">
        <a href="{{ route('seller.products.index') }}" style="width:40px;height:40px;border-radius:12px;background:#fff;border:2px solid #e5e7eb;display:flex;align-items:center;justify-content:center;font-size:18px;text-decoration:none;color:#374151;">←</a>
        <div>
            <h2 style="font-size:22px;font-weight:800;color:#111827;margin:0 0 3px;">➕ Add New Product</h2>
            <p style="font-size:14px;color:#6b7280;margin:0;">Fill in product details to list in your store</p>
        </div>
    </div>

    <form method="POST" action="{{ route('seller.products.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Basic Info -->
        <div style="background:#fff;border-radius:20px;padding:28px;margin-bottom:20px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 20px;padding-bottom:12px;border-bottom:2px solid #f3f4f6;">📝 Basic Information</h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div style="grid-column:span 2;" class="fg">
                    <label class="fl">Product Name <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="fi" placeholder="e.g. Premium Wireless Headphones" required>
                </div>
                <div class="fg">
                    <label class="fl">Category</label>
                    <select name="category_id" class="fi">
                        <option value="">— Select Category —</option>
                        @foreach($categories ?? [] as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="fg">
                    <label class="fl">SKU / Model Number</label>
                    <input type="text" name="sku" value="{{ old('sku') }}" class="fi" placeholder="e.g. WH-1000XM5 (auto-generated if empty)">
                </div>
                <div style="grid-column:span 2;" class="fg">
                    <label class="fl">Short Description</label>
                    <textarea name="short_description" class="fi" rows="2" placeholder="Brief description shown in product cards...">{{ old('short_description') }}</textarea>
                </div>
                <div style="grid-column:span 2;" class="fg">
                    <label class="fl">Full Description</label>
                    <textarea name="description" class="fi" rows="4" placeholder="Detailed product description, features, specifications...">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Pricing & Inventory -->
        <div style="background:#fff;border-radius:20px;padding:28px;margin-bottom:20px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 20px;padding-bottom:12px;border-bottom:2px solid #f3f4f6;">💰 Pricing & Inventory</h3>
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;">
                <div class="fg">
                    <label class="fl">Selling Price (₹) <span style="color:#ef4444;">*</span></label>
                    <input type="number" name="price" value="{{ old('price') }}" class="fi" placeholder="999.00" step="0.01" min="0" required>
                </div>
                <div class="fg">
                    <label class="fl">Compare At Price (₹)</label>
                    <input type="number" name="compare_at_price" value="{{ old('compare_at_price') }}" class="fi" placeholder="1499.00" step="0.01" min="0">
                    <small style="font-size:11px;color:#9ca3af;margin-top:2px;">Original / MRP (shown as strikethrough)</small>
                </div>
                <div class="fg">
                    <label class="fl">Cost Price (₹)</label>
                    <input type="number" name="cost_price" value="{{ old('cost_price') }}" class="fi" placeholder="500.00" step="0.01" min="0">
                    <small style="font-size:11px;color:#9ca3af;margin-top:2px;">Your purchase cost (private)</small>
                </div>
                <div class="fg">
                    <label class="fl">Stock Quantity <span style="color:#ef4444;">*</span></label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" class="fi" placeholder="100" min="0" required>
                </div>
                <div class="fg">
                    <label class="fl">Product Status</label>
                    <select name="is_active" class="fi">
                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>✅ Active (Visible)</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>⏸ Inactive (Hidden)</option>
                    </select>
                </div>
                <div class="fg">
                    <label class="fl">Featured Product</label>
                    <select name="is_featured" class="fi">
                        <option value="0" {{ old('is_featured', '0') == '0' ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('is_featured') == '1' ? 'selected' : '' }}>⭐ Yes - Feature this product</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Images -->
        <div style="background:#fff;border-radius:20px;padding:28px;margin-bottom:20px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 20px;padding-bottom:12px;border-bottom:2px solid #f3f4f6;">📸 Product Images</h3>

            <!-- Featured Image -->
            <div class="fg" style="margin-bottom:20px;">
                <label class="fl">Featured / Main Image</label>
                <div id="featured-drop-zone"
                    style="border:2px dashed #c7d2fe;border-radius:14px;padding:36px;text-align:center;background:#f9f9ff;cursor:pointer;transition:all 0.2s;"
                    onclick="document.getElementById('featured-image').click()"
                    ondragover="event.preventDefault();this.style.borderColor='#4f46e5';this.style.background='#eef2ff'"
                    ondragleave="this.style.borderColor='#c7d2fe';this.style.background='#f9f9ff'"
                    ondrop="event.preventDefault();this.style.borderColor='#c7d2fe';this.style.background='#f9f9ff';handleImgDrop(event,'featured-image','feat-preview','feat-preview-img','feat-placeholder')">
                    <div id="feat-preview" style="display:none;margin-bottom:12px;">
                        <img id="feat-preview-img" style="max-height:150px;border-radius:10px;object-fit:contain;">
                    </div>
                    <div id="feat-placeholder">
                        <div style="font-size:36px;margin-bottom:8px;">🖼️</div>
                        <p style="font-size:14px;font-weight:600;color:#4f46e5;margin:0 0 4px;">Click or drag & drop to upload</p>
                        <p style="font-size:12px;color:#9ca3af;margin:0;">PNG, JPG, WEBP up to 3MB</p>
                    </div>
                    <input type="file" id="featured-image" name="featured_image" accept="image/*" style="display:none;"
                        onchange="previewImage(this,'feat-preview','feat-preview-img','feat-placeholder')">
                </div>
            </div>

            <!-- Gallery Images -->
            <div class="fg">
                <label class="fl">Gallery Images (Up to 5)</label>
                <div style="border:2px dashed #e5e7eb;border-radius:14px;padding:24px;text-align:center;background:#fafafa;cursor:pointer;" onclick="document.getElementById('gallery-images').click()">
                    <div id="gallery-preview" style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;margin-bottom:12px;"></div>
                    <p style="font-size:14px;color:#6b7280;margin:0 0 4px;">📸 Click to add gallery images</p>
                    <p style="font-size:12px;color:#9ca3af;margin:0;">Multiple images for product gallery</p>
                    <input type="file" id="gallery-images" name="gallery_images[]" accept="image/*" multiple style="display:none;" onchange="previewGallery(this)">
                </div>
            </div>
        </div>

        <!-- Variations -->
        <div style="background:#fff;border-radius:20px;padding:28px;margin-bottom:28px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;padding-bottom:12px;border-bottom:2px solid #f3f4f6;">
                <div>
                    <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 3px;">🎨 Product Variations <span style="font-size:13px;font-weight:400;color:#9ca3af;">(optional)</span></h3>
                    <p style="font-size:13px;color:#6b7280;margin:0;">Size, Color, Material, Storage etc.</p>
                </div>
                <button type="button" onclick="addVariation()"
                    style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:#eef2ff;color:#4f46e5;border:none;border-radius:10px;font-size:13px;font-weight:600;cursor:pointer;font-family:inherit;">
                    ➕ Add Variation
                </button>
            </div>
            <div id="variations-container">
                <p style="font-size:13px;color:#9ca3af;text-align:center;padding:20px 0;margin:0;" id="no-variation-text">No variations added. Click "Add Variation" to start.</p>
            </div>
        </div>

        <!-- Submit -->
        <div style="display:flex;gap:12px;justify-content:flex-end;">
            <a href="{{ route('seller.products.index') }}" style="padding:14px 28px;background:#f3f4f6;color:#374151;border-radius:12px;font-size:14px;font-weight:600;text-decoration:none;">Cancel</a>
            <button type="submit" style="padding:14px 36px;background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;border:none;border-radius:12px;font-size:14px;font-weight:700;cursor:pointer;font-family:inherit;box-shadow:0 4px 14px rgba(79,70,229,0.3);">
                📦 Publish Product
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
    document.getElementById('no-variation-text')?.remove();
    varCount++;
    const container = document.getElementById('variations-container');
    const div = document.createElement('div');
    div.className = 'variation-row';
    div.id = 'var-' + varCount;
    div.innerHTML = `
        <button type="button" onclick="document.getElementById('var-${varCount}').remove()" style="position:absolute;top:10px;right:12px;background:#fef2f2;color:#ef4444;border:none;border-radius:8px;padding:4px 10px;font-size:12px;cursor:pointer;font-family:inherit;">✕ Remove</button>
        <div style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:14px;">
            <div class="fg">
                <label class="fl">Type</label>
                <select name="variations[${varCount}][type]" class="fi">
                    <option value="Size">Size</option>
                    <option value="Color">Color</option>
                    <option value="Material">Material</option>
                    <option value="Storage">Storage</option>
                    <option value="Weight">Weight</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="fg"><label class="fl">Value / Name *</label><input type="text" name="variations[${varCount}][name]" class="fi" placeholder="Red, XL, 128GB..." required></div>
            <div class="fg"><label class="fl">Stock</label><input type="number" name="variations[${varCount}][stock]" class="fi" value="0" min="0"></div>
            <div class="fg"><label class="fl">Variant Price (₹)</label><input type="number" name="variations[${varCount}][price]" class="fi" placeholder="Leave blank for base price" step="0.01" min="0"></div>
        </div>
    `;
    container.appendChild(div);
}

function previewImage(input, previewId, imgId, placeholderId) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById(imgId).src = e.target.result;
            document.getElementById(previewId).style.display = 'block';
            const ph = document.getElementById(placeholderId);
            if (ph) ph.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
}

function previewGallery(input) {
    const container = document.getElementById('gallery-preview');
    container.innerHTML = '';
    Array.from(input.files).slice(0,5).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.cssText = 'width:80px;height:80px;object-fit:cover;border-radius:10px;border:2px solid #e5e7eb;';
            container.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}

function handleImgDrop(event, inputId, previewId, imgId, placeholderId) {
    const files = event.dataTransfer.files;
    if (files.length) {
        const input = document.getElementById(inputId);
        const dt = new DataTransfer();
        dt.items.add(files[0]);
        input.files = dt.files;
        previewImage(input, previewId, imgId, placeholderId);
    }
}
</script>

@endsection
