@extends('seller.layouts.app')

@section('title', 'Store Profile')

@section('content')

<div style="max-width:860px;margin:0 auto;">

    <div style="margin-bottom:28px;">
        <h2 style="font-size:22px;font-weight:800;color:#111827;margin:0 0 4px;">⚙️ Store Profile & Settings</h2>
        <p style="font-size:14px;color:#6b7280;margin:0;">Manage your store information, contact details and bank payout settings</p>
    </div>

    @if(session('success'))
        <div style="background:#ecfdf5;border:1px solid #6ee7b7;border-radius:12px;padding:14px 18px;margin-bottom:24px;font-size:14px;color:#065f46;">✅ {{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div style="background:#fef2f2;border:1px solid #fca5a5;border-radius:14px;padding:16px 20px;margin-bottom:24px;">
            <strong style="font-size:14px;color:#991b1b;display:block;margin-bottom:8px;">⚠️ Please fix these errors:</strong>
            <ul style="margin:0;padding-left:20px;font-size:13px;color:#b91c1c;">
                @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('seller.profile.update') }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <!-- Store Info -->
        <div style="background:#fff;border-radius:20px;padding:28px;margin-bottom:20px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 20px;padding-bottom:12px;border-bottom:2px solid #f3f4f6;">🏪 Store Information</h3>

            <!-- Logo -->
            <div class="fg" style="margin-bottom:24px;">
                <label class="fl">Store Logo</label>
                <div style="display:flex;align-items:center;gap:20px;">
                    <div style="width:80px;height:80px;border-radius:20px;overflow:hidden;background:linear-gradient(135deg,#4f46e5,#7c3aed);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        @if($seller?->store_logo)
                            <img src="{{ Storage::url($seller->store_logo) }}" style="width:100%;height:100%;object-fit:cover;">
                        @else
                            <span style="font-size:32px;">🏪</span>
                        @endif
                    </div>
                    <div>
                        <label style="display:inline-flex;align-items:center;gap:8px;padding:10px 18px;background:#eef2ff;color:#4f46e5;border-radius:11px;font-size:14px;font-weight:600;cursor:pointer;">
                            📸 Upload Logo
                            <input type="file" name="store_logo" accept="image/*" style="display:none;" onchange="previewLogo(this)">
                        </label>
                        <p style="font-size:12px;color:#9ca3af;margin:6px 0 0;">PNG, JPG up to 2MB. Recommended 200×200px.</p>
                        <div id="logo-new-preview" style="display:none;margin-top:8px;">
                            <img id="logo-preview-img" style="width:60px;height:60px;border-radius:12px;object-fit:cover;border:2px solid #6ee7b7;">
                        </div>
                    </div>
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div class="fg">
                    <label class="fl">Store Name <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="store_name" value="{{ old('store_name', $seller?->store_name) }}" class="fi" required>
                </div>
                <div class="fg">
                    <label class="fl">Store Phone</label>
                    <input type="text" name="store_phone" value="{{ old('store_phone', $seller?->store_phone) }}" class="fi">
                </div>
                <div class="fg">
                    <label class="fl">Store Email</label>
                    <input type="email" name="store_email" value="{{ old('store_email', $seller?->store_email) }}" class="fi">
                </div>
                <div class="fg">
                    <label class="fl">GST Number</label>
                    <input type="text" name="gst_number" value="{{ old('gst_number', $seller?->gst_number) }}" class="fi">
                </div>
                <div class="fg">
                    <label class="fl">PAN Number</label>
                    <input type="text" name="pan_number" value="{{ old('pan_number', $seller?->pan_number) }}" class="fi">
                </div>
                <div class="fg">
                    <label class="fl">Pincode</label>
                    <input type="text" name="pincode" value="{{ old('pincode', $seller?->pincode) }}" class="fi">
                </div>
                <div class="fg" style="grid-column:span 2;">
                    <label class="fl">Store Address</label>
                    <input type="text" name="address" value="{{ old('address', $seller?->address) }}" class="fi">
                </div>
                <div class="fg">
                    <label class="fl">City</label>
                    <input type="text" name="city" value="{{ old('city', $seller?->city) }}" class="fi">
                </div>
                <div class="fg">
                    <label class="fl">State</label>
                    <input type="text" name="state" value="{{ old('state', $seller?->state) }}" class="fi">
                </div>
                <div class="fg" style="grid-column:span 2;">
                    <label class="fl">Store Description</label>
                    <textarea name="store_description" class="fi" rows="3">{{ old('store_description', $seller?->store_description) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Bank Details -->
        <div style="background:#fff;border-radius:20px;padding:28px;margin-bottom:20px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 8px;padding-bottom:12px;border-bottom:2px solid #f3f4f6;">🏦 Bank & Payout Details</h3>
            <p style="font-size:13px;color:#6b7280;margin:0 0 20px;">Earnings from your sales will be transferred to this account every Monday.</p>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div class="fg">
                    <label class="fl">Bank Name</label>
                    <input type="text" name="bank_name" value="{{ old('bank_name', $seller?->bank_name) }}" class="fi">
                </div>
                <div class="fg">
                    <label class="fl">Account Holder Name</label>
                    <input type="text" name="bank_account_holder" value="{{ old('bank_account_holder', $seller?->bank_account_holder) }}" class="fi">
                </div>
                <div class="fg">
                    <label class="fl">Account Number</label>
                    <input type="text" name="bank_account_number" value="{{ old('bank_account_number', $seller?->bank_account_number) }}" class="fi">
                </div>
                <div class="fg">
                    <label class="fl">IFSC Code</label>
                    <input type="text" name="bank_ifsc" value="{{ old('bank_ifsc', $seller?->bank_ifsc) }}" class="fi">
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div style="display:flex;gap:12px;justify-content:flex-end;margin-bottom:60px;">
            <button type="submit" style="padding:14px 36px;background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;border:none;border-radius:12px;font-size:14px;font-weight:700;cursor:pointer;font-family:inherit;box-shadow:0 4px 14px rgba(79,70,229,0.3);">
                💾 Save Store Settings
            </button>
        </div>
    </form>

    <!-- Owner Account Info (Read-only display) -->
    <div style="background:#fff;border-radius:20px;padding:28px;margin-bottom:20px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
        <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 20px;padding-bottom:12px;border-bottom:2px solid #f3f4f6;">👤 Account Information</h3>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
            @foreach([
                ['Full Name', auth()->user()->name],
                ['Email Address', auth()->user()->email],
                ['Phone Number', auth()->user()->phone ?? '—'],
                ['Account Type', ucfirst(auth()->user()->role ?? 'seller')],
                ['Member Since', auth()->user()->created_at->format('d M Y')],
            ] as $row)
            <div style="background:#f9fafb;border-radius:12px;padding:16px;">
                <p style="font-size:11px;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 6px;">{{ $row[0] }}</p>
                <p style="font-size:14px;font-weight:700;color:#111827;margin:0;">{{ $row[1] }}</p>
            </div>
            @endforeach
        </div>
        <p style="font-size:13px;color:#6b7280;margin:16px 0 0;">To change your name, email or password, please contact support or update it from your user account settings.</p>
    </div>
</div>

<style>
.fg { display:flex; flex-direction:column; gap:7px; }
.fl { font-size:13px; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:0.5px; }
.fi { width:100%; padding:12px 16px; border:2px solid #e5e7eb; border-radius:12px; font-size:14px; color:#111827; outline:none; font-family:inherit; background:#fafafa; box-sizing:border-box; transition:all 0.2s; }
.fi:focus { border-color:#4f46e5; box-shadow:0 0 0 4px rgba(79,70,229,0.1); background:#fff; }
</style>

<script>
function previewLogo(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('logo-preview-img').src = e.target.result;
            document.getElementById('logo-new-preview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
</script>

@endsection
