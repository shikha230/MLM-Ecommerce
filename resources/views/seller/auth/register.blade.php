<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a Seller - ShopSphere</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; background: #f0f4ff; }
        .form-group { display:flex; flex-direction:column; gap:7px; }
        .form-label { font-size:13px; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:0.5px; }
        .form-input {
            width:100%; padding:12px 16px; border:2px solid #e5e7eb; border-radius:12px;
            font-size:15px; color:#111827; outline:none; font-family:inherit;
            background:#fafafa; box-sizing:border-box; transition:all 0.2s;
        }
        .form-input:focus { border-color:#4f46e5; box-shadow:0 0 0 4px rgba(79,70,229,0.1); background:#fff; }
        .section-title { font-size:16px; font-weight:700; color:#111827; margin:0 0 20px; padding-bottom:10px; border-bottom:2px solid #e5e7eb; }
        .step-tab { display:inline-flex; align-items:center; gap:8px; padding:10px 20px; border-radius:50px; font-size:14px; font-weight:600; cursor:pointer; border:none; transition:all 0.2s; }
        .step-tab.active { background:linear-gradient(135deg,#4f46e5,#7c3aed); color:#fff; box-shadow:0 4px 14px rgba(79,70,229,0.3); }
        .step-tab.done { background:#ecfdf5; color:#059669; border:2px solid #6ee7b7; }
        .step-tab.inactive { background:#f3f4f6; color:#9ca3af; }
        .step-pane { display:none; }
        .step-pane.active { display:block; }
    </style>
</head>
<body>

<!-- Top Nav -->
<nav style="background:#fff;border-bottom:1px solid #e5e7eb;padding:0 24px;">
    <div style="max-width:1200px;margin:0 auto;height:64px;display:flex;align-items:center;justify-content:space-between;">
        <a href="{{ route('home') }}" style="font-size:22px;font-weight:800;text-decoration:none;background:linear-gradient(135deg,#4f46e5,#7c3aed);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
            🛍️ ShopSphere
        </a>
        <p style="font-size:14px;color:#6b7280;margin:0;">Already a seller? <a href="{{ route('seller.login') }}" style="color:#4f46e5;font-weight:600;text-decoration:none;">Sign in →</a></p>
    </div>
</nav>

<!-- Hero Banner -->
<div style="background:linear-gradient(135deg,#4f46e5,#7c3aed);padding:48px 24px;text-align:center;">
    <h1 style="color:#fff;font-size:36px;font-weight:800;margin:0 0 12px;">Start Selling on ShopSphere 🚀</h1>
    <p style="color:rgba(255,255,255,0.8);font-size:16px;margin:0;">Join thousands of sellers. Setup your store in under 5 minutes.</p>
</div>

<div style="max-width:900px;margin:40px auto;padding:0 24px 60px;">

    @if(session('error'))
        <div style="background:#fef2f2;border:1px solid #fca5a5;border-radius:12px;padding:14px 18px;margin-bottom:24px;font-size:14px;color:#991b1b;">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background:#fef2f2;border:1px solid #fca5a5;border-radius:12px;padding:16px 20px;margin-bottom:24px;">
            <strong style="display:block;font-size:14px;color:#991b1b;margin-bottom:8px;">⚠️ Please fix the following errors:</strong>
            <ul style="margin:0;padding-left:20px;font-size:13px;color:#b91c1c;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Step Tabs -->
    <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:32px;">
        <button class="step-tab active" id="tab-btn-1" onclick="goToStep(1)">
            <span style="width:22px;height:22px;border-radius:50%;background:rgba(255,255,255,0.25);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;">1</span>
            Account Info
        </button>
        <button class="step-tab inactive" id="tab-btn-2" onclick="goToStep(2)">
            <span style="width:22px;height:22px;border-radius:50%;background:#e5e7eb;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;color:#9ca3af;">2</span>
            Store Details
        </button>
        <button class="step-tab inactive" id="tab-btn-3" onclick="goToStep(3)">
            <span style="width:22px;height:22px;border-radius:50%;background:#e5e7eb;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;color:#9ca3af;">3</span>
            Bank & Payout
        </button>
    </div>

    <div style="background:#fff;border-radius:24px;padding:40px;box-shadow:0 8px 40px rgba(79,70,229,0.08);border:1px solid #f0f0ff;">
        <form method="POST" action="{{ route('seller.register.store') }}">
            @csrf

            <!-- STEP 1: Account Info -->
            <div id="step-1" class="step-pane active">
                <div class="section-title">👤 Owner Account Information</div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                    <div class="form-group">
                        <label class="form-label">Full Name <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="Your full legal name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address <span style="color:#ef4444;">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="you@example.com" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-input" placeholder="+91 9876543210" required>
                    </div>
                    <div class="form-group"></div>
                    <div class="form-group">
                        <label class="form-label">Password <span style="color:#ef4444;">*</span></label>
                        <input type="password" name="password" class="form-input" placeholder="Minimum 8 characters" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password <span style="color:#ef4444;">*</span></label>
                        <input type="password" name="password_confirmation" class="form-input" placeholder="Re-enter password" required>
                    </div>
                </div>
                <div style="text-align:right;margin-top:28px;">
                    <button type="button" onclick="goToStep(2)"
                        style="background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;font-size:14px;font-weight:700;padding:13px 32px;border:none;border-radius:12px;cursor:pointer;font-family:inherit;">
                        Next: Store Details →
                    </button>
                </div>
            </div>

            <!-- STEP 2: Store Details -->
            <div id="step-2" class="step-pane">
                <div class="section-title">🏪 Store & Business Information</div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                    <div class="form-group">
                        <label class="form-label">Store Name <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="store_name" value="{{ old('store_name') }}" class="form-input" placeholder="My Awesome Store" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Store Phone</label>
                        <input type="text" name="store_phone" value="{{ old('store_phone') }}" class="form-input" placeholder="Store contact number">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Store Email</label>
                        <input type="email" name="store_email" value="{{ old('store_email') }}" class="form-input" placeholder="store@yourdomain.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label">GST Number</label>
                        <input type="text" name="gst_number" value="{{ old('gst_number') }}" class="form-input" placeholder="22AAAAA0000A1Z5">
                    </div>
                    <div class="form-group">
                        <label class="form-label">PAN Number</label>
                        <input type="text" name="pan_number" value="{{ old('pan_number') }}" class="form-input" placeholder="AAAAA0000A">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pincode</label>
                        <input type="text" name="pincode" value="{{ old('pincode') }}" class="form-input" placeholder="400001">
                    </div>
                    <div class="form-group" style="grid-column:span 2;">
                        <label class="form-label">Store Address</label>
                        <input type="text" name="address" value="{{ old('address') }}" class="form-input" placeholder="Full warehouse / store address">
                    </div>
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" name="city" value="{{ old('city') }}" class="form-input" placeholder="Mumbai">
                    </div>
                    <div class="form-group">
                        <label class="form-label">State</label>
                        <input type="text" name="state" value="{{ old('state') }}" class="form-input" placeholder="Maharashtra">
                    </div>
                    <div class="form-group" style="grid-column:span 2;">
                        <label class="form-label">Store Description</label>
                        <textarea name="store_description" class="form-input" rows="3" placeholder="Brief description of your store and what you sell...">{{ old('store_description') }}</textarea>
                    </div>
                </div>
                <div style="display:flex;gap:12px;justify-content:space-between;margin-top:28px;">
                    <button type="button" onclick="goToStep(1)" style="background:#f3f4f6;color:#374151;font-size:14px;font-weight:600;padding:13px 28px;border:none;border-radius:12px;cursor:pointer;font-family:inherit;">← Back</button>
                    <button type="button" onclick="goToStep(3)" style="background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;font-size:14px;font-weight:700;padding:13px 32px;border:none;border-radius:12px;cursor:pointer;font-family:inherit;">Next: Bank Details →</button>
                </div>
            </div>

            <!-- STEP 3: Bank & Payout -->
            <div id="step-3" class="step-pane">
                <div class="section-title">🏦 Bank & Payout Information</div>
                <p style="font-size:14px;color:#6b7280;margin:-8px 0 24px;">Add bank details for receiving your sales earnings. You can update this anytime from your store profile.</p>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                    <div class="form-group">
                        <label class="form-label">Bank Name</label>
                        <input type="text" name="bank_name" value="{{ old('bank_name') }}" class="form-input" placeholder="HDFC Bank, SBI, ICICI...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Account Holder Name</label>
                        <input type="text" name="bank_account_holder" value="{{ old('bank_account_holder') }}" class="form-input" placeholder="As per bank records">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Account Number</label>
                        <input type="text" name="bank_account_number" value="{{ old('bank_account_number') }}" class="form-input" placeholder="XXXXXXXXXXXXXXXXXX">
                    </div>
                    <div class="form-group">
                        <label class="form-label">IFSC Code</label>
                        <input type="text" name="bank_ifsc" value="{{ old('bank_ifsc') }}" class="form-input" placeholder="HDFC0001234">
                    </div>
                </div>

                <!-- Agreement -->
                <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:14px;padding:20px;margin-top:28px;">
                    <label style="display:flex;align-items:flex-start;gap:12px;cursor:pointer;font-size:13px;color:#374151;line-height:1.6;">
                        <input type="checkbox" id="agree" style="margin-top:3px;accent-color:#4f46e5;width:16px;height:16px;flex-shrink:0;" required>
                        <span>I agree to ShopSphere's <strong style="color:#4f46e5;">Seller Terms & Conditions</strong>, <strong style="color:#4f46e5;">Privacy Policy</strong>, and confirm that I am legally authorized to sell the listed products in India.</span>
                    </label>
                </div>

                <div style="display:flex;gap:12px;justify-content:space-between;margin-top:24px;">
                    <button type="button" onclick="goToStep(2)" style="background:#f3f4f6;color:#374151;font-size:14px;font-weight:600;padding:13px 28px;border:none;border-radius:12px;cursor:pointer;font-family:inherit;">← Back</button>
                    <button type="submit" style="background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;font-size:15px;font-weight:700;padding:14px 36px;border:none;border-radius:12px;cursor:pointer;font-family:inherit;">
                        🚀 Create My Seller Account
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
function goToStep(step) {
    document.querySelectorAll('.step-pane').forEach(p => p.classList.remove('active'));
    document.getElementById('step-' + step).classList.add('active');

    for (let i = 1; i <= 3; i++) {
        const btn = document.getElementById('tab-btn-' + i);
        if (i < step) {
            btn.className = 'step-tab done';
        } else if (i === step) {
            btn.className = 'step-tab active';
        } else {
            btn.className = 'step-tab inactive';
        }
    }
    window.scrollTo(0, 0);
}
</script>

</body>
</html>
