<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account - ShopSphere</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
            margin: 0;
            color: #1e293b;
        }
        .auth-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05), 0 4px 12px -2px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }
        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
            display: block;
        }
        .form-label span.req { color: #ef4444; }
        .form-label span.opt { font-weight: 400; color: #94a3b8; font-size: 12px; }
        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            color: #0f172a;
            background: #fafafa;
            outline: none;
            transition: all 0.2s ease;
            font-family: inherit;
        }
        .form-control:focus {
            border-color: #4f46e5;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
        }
        .form-control::placeholder {
            color: #94a3b8;
            font-size: 13px;
        }
        .btn-primary {
            width: 100%;
            padding: 11px 18px;
            background: #4f46e5;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(79, 70, 229, 0.25);
            font-family: inherit;
        }
        .btn-primary:hover {
            background: #4338ca;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
            transform: translateY(-1px);
        }
        .btn-secondary {
            padding: 9px 18px;
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
        }
        .btn-secondary:hover { background: #e2e8f0; color: #1e293b; }
        .toggle-container {
            display: inline-flex;
            background: #f1f5f9;
            padding: 4px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            gap: 4px;
        }
        .toggle-btn {
            border: none;
            outline: none;
            background: transparent;
            padding: 7px 18px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: inherit;
        }
        .toggle-btn.active {
            background: #ffffff;
            color: #4f46e5;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        }
        .seller-step-tab {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            font-family: inherit;
        }
        .seller-step-tab.active { background: #4f46e5; color: #fff; }
        .seller-step-tab.done { background: #ecfdf5; color: #059669; }
        .seller-step-tab.inactive { background: #f1f5f9; color: #94a3b8; }
        .step-pane { display: none; }
        .step-pane.active { display: block; }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen py-10 px-4">

    @php
        $isSeller = old('account_type') === 'seller' 
            || request('type') === 'seller' 
            || $errors->has('store_name') 
            || $errors->has('gst_number')
            || $errors->has('pan_number')
            || $errors->has('bank_name')
            || (session('error') !== null && str_contains(session('error') ?? '', 'store'));

        // Determine which seller step has errors so JS can auto-jump
        $sellerErrorStep = 1;
        if ($errors->hasAny(['store_name', 'store_phone', 'store_email', 'gst_number', 'pan_number', 'address', 'city', 'state', 'pincode', 'store_description'])) {
            $sellerErrorStep = 2;
        } elseif ($errors->hasAny(['bank_name', 'bank_account_holder', 'bank_account_number', 'bank_ifsc'])) {
            $sellerErrorStep = 3;
        }
        // Step 1 errors (name, email, phone, password) → stay at 1
        if ($errors->hasAny(['name', 'email', 'phone', 'password'])) {
            $sellerErrorStep = 1;
        }
    @endphp

    <div class="w-full transition-all duration-300" style="max-width: {{ $isSeller ? '660px' : '460px' }};" id="formWrapper">

        <!-- Top Header & Brand -->
        <div class="text-center mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-decoration-none group">
                <span class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center text-white text-lg shadow-sm">
                    🛍️
                </span>
                <span class="text-2xl font-extrabold text-indigo-600 tracking-tight">
                    ShopSphere
                </span>
            </a>

            <h1 class="text-2xl font-extrabold text-slate-900 mt-4 mb-1" id="mainTitle">
                Create your account
            </h1>
            <p class="text-slate-500 text-xs sm:text-sm m-0" id="mainSubtitle">
                {{ $isSeller ? 'Open your store and start selling on ShopSphere' : 'Join ShopSphere and start shopping' }}
            </p>

            <!-- Role Segmented Switcher -->
            <div class="mt-4 flex justify-center">
                <div class="toggle-container">
                    <button type="button"
                            id="tabCustomerBtn"
                            onclick="switchRole('customer')"
                            class="toggle-btn {{ !$isSeller ? 'active' : '' }}">
                        <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Customer</span>
                    </button>
                    <button type="button"
                            id="tabSellerBtn"
                            onclick="switchRole('seller')"
                            class="toggle-btn {{ $isSeller ? 'active' : '' }}">
                        <span style="font-size:13px;">🏪</span>
                        <span>Seller / Merchant</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Card -->
        <div class="auth-card p-6 sm:p-8">

            <!-- Flash Error Alerts -->
            @if (session('error'))
                <div class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-xs text-rose-700 flex items-center gap-2">
                    <span>⚠️</span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200">
                    <div class="text-xs font-bold text-rose-800 mb-1 flex items-center gap-1.5">
                        <span>⚠️</span> Please fix the following:
                    </div>
                    <ul class="text-xs text-rose-600 m-0 pl-4 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- ================= CUSTOMER FORM ================= -->
            <div id="customerFormSection" class="{{ $isSeller ? 'hidden' : 'block' }}">
                <form action="{{ route('register.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="account_type" value="customer">

                    <!-- Full Name -->
                    <div class="mb-3.5">
                        <label for="c_name" class="form-label">Full Name <span class="req">*</span></label>
                        <input type="text" id="c_name" name="name" value="{{ old('name') }}" required placeholder="Enter your full name" class="form-control">
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3.5">
                        <label for="c_email" class="form-label">Email Address <span class="req">*</span></label>
                        <input type="email" id="c_email" name="email" value="{{ old('email') }}" required placeholder="name@example.com" class="form-control">
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-3.5">
                        <label for="c_phone" class="form-label">Phone Number <span class="req">*</span></label>
                        <input type="tel" id="c_phone" name="phone" value="{{ old('phone') }}" required placeholder="Enter your phone number" class="form-control">
                    </div>

                    <!-- Referral Code -->
                    <div class="mb-3.5">
                        <label for="c_ref" class="form-label">Referral Code <span class="opt">(Optional)</span></label>
                        <input type="text" id="c_ref" name="referral_code" value="{{ old('referral_code', request('ref')) }}" placeholder="Enter referral code if any" class="form-control uppercase">
                    </div>

                    <!-- Password Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-5">
                        <div>
                            <label for="c_pass" class="form-label">Password <span class="req">*</span></label>
                            <input type="password" id="c_pass" name="password" required placeholder="Minimum 8 chars" class="form-control">
                        </div>
                        <div>
                            <label for="c_pass_conf" class="form-label">Confirm Password <span class="req">*</span></label>
                            <input type="password" id="c_pass_conf" name="password_confirmation" required placeholder="Confirm password" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn-primary">
                        Create Account
                    </button>
                </form>
            </div>

            <!-- ================= SELLER FORM ================= -->
            <div id="sellerFormSection" class="{{ $isSeller ? 'block' : 'hidden' }}">
                <!-- Mini Step Tabs -->
                <div class="flex items-center gap-1.5 mb-5 pb-3 border-b border-slate-100 flex-wrap">
                    <button type="button" class="seller-step-tab active" id="seller-tab-btn-1" onclick="switchSellerStep(1)">
                        <span>1. Owner Account</span>
                    </button>
                    <button type="button" class="seller-step-tab inactive" id="seller-tab-btn-2" onclick="switchSellerStep(2)">
                        <span>2. Store Details</span>
                    </button>
                    <button type="button" class="seller-step-tab inactive" id="seller-tab-btn-3" onclick="switchSellerStep(3)">
                        <span>3. Bank & Payout</span>
                    </button>
                </div>

                <form method="POST" action="{{ route('seller.register.store') }}" id="sellerForm">
                    @csrf
                    <input type="hidden" name="account_type" value="seller">

                    <!-- STEP 1: Owner Info -->
                    <div id="seller-step-pane-1" class="step-pane active">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 mb-4">
                            <div>
                                <label class="form-label">Full Name <span class="req">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Your legal name" class="form-control" required>
                            </div>
                            <div>
                                <label class="form-label">Email Address <span class="req">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="merchant@store.com" class="form-control" required>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="form-label">Phone Number <span class="req">*</span></label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+91 9876543210" class="form-control" required>
                            </div>
                            <div>
                                <label class="form-label">Password <span class="req">*</span></label>
                                <input type="password" name="password" placeholder="Minimum 8 chars" class="form-control" required>
                            </div>
                            <div>
                                <label class="form-label">Confirm Password <span class="req">*</span></label>
                                <input type="password" name="password_confirmation" placeholder="Re-enter password" class="form-control" required>
                            </div>
                        </div>

                        <div class="flex justify-end pt-2">
                            <button type="button" onclick="goToStep2()" class="btn-primary" style="width: auto; padding: 10px 24px;">
                                Next: Store Details &rarr;
                            </button>
                        </div>
                    </div>

                    <!-- STEP 2: Store Details -->
                    <div id="seller-step-pane-2" class="step-pane">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 mb-4">
                            <div class="sm:col-span-2">
                                <label class="form-label">Store Name <span class="req">*</span></label>
                                <input type="text" name="store_name" value="{{ old('store_name') }}" placeholder="e.g. Urban Style Store" class="form-control" required>
                            </div>
                            <div>
                                <label class="form-label">Store Phone <span class="opt">(Optional)</span></label>
                                <input type="text" name="store_phone" value="{{ old('store_phone') }}" placeholder="Contact number" class="form-control">
                            </div>
                            <div>
                                <label class="form-label">Store Email <span class="opt">(Optional)</span></label>
                                <input type="email" name="store_email" value="{{ old('store_email') }}" placeholder="store@domain.com" class="form-control">
                            </div>
                            <div>
                                <label class="form-label">GST Number <span class="opt">(Optional)</span></label>
                                <input type="text" name="gst_number" value="{{ old('gst_number') }}" placeholder="GSTIN" class="form-control uppercase">
                            </div>
                            <div>
                                <label class="form-label">PAN Number <span class="opt">(Optional)</span></label>
                                <input type="text" name="pan_number" value="{{ old('pan_number') }}" placeholder="PAN" class="form-control uppercase">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="form-label">Store Address <span class="opt">(Optional)</span></label>
                                <input type="text" name="address" value="{{ old('address') }}" placeholder="Shop / Warehouse address" class="form-control">
                            </div>
                            <div>
                                <label class="form-label">City <span class="opt">(Optional)</span></label>
                                <input type="text" name="city" value="{{ old('city') }}" placeholder="City" class="form-control">
                            </div>
                            <div>
                                <label class="form-label">State <span class="opt">(Optional)</span></label>
                                <input type="text" name="state" value="{{ old('state') }}" placeholder="State" class="form-control">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="form-label">Pincode <span class="opt">(Optional)</span></label>
                                <input type="text" name="pincode" value="{{ old('pincode') }}" placeholder="Postal Code" class="form-control">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="form-label">Store Description <span class="opt">(Optional)</span></label>
                                <textarea name="store_description" rows="2" placeholder="Brief summary of what you sell..." class="form-control">{{ old('store_description') }}</textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-2">
                            <button type="button" onclick="switchSellerStep(1)" class="btn-secondary">
                                &larr; Back
                            </button>
                            <button type="button" onclick="goToStep3()" class="btn-primary" style="width: auto; padding: 10px 24px;">
                                Next: Bank Details &rarr;
                            </button>
                        </div>
                    </div>

                    <!-- STEP 3: Bank Details -->
                    <div id="seller-step-pane-3" class="step-pane">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 mb-4">
                            <div>
                                <label class="form-label">Bank Name <span class="opt">(Optional)</span></label>
                                <input type="text" name="bank_name" value="{{ old('bank_name') }}" placeholder="HDFC, SBI, ICICI..." class="form-control">
                            </div>
                            <div>
                                <label class="form-label">Account Holder <span class="opt">(Optional)</span></label>
                                <input type="text" name="bank_account_holder" value="{{ old('bank_account_holder') }}" placeholder="Account name" class="form-control">
                            </div>
                            <div>
                                <label class="form-label">Account Number <span class="opt">(Optional)</span></label>
                                <input type="text" name="bank_account_number" value="{{ old('bank_account_number') }}" placeholder="Account number" class="form-control">
                            </div>
                            <div>
                                <label class="form-label">IFSC Code <span class="opt">(Optional)</span></label>
                                <input type="text" name="bank_ifsc" value="{{ old('bank_ifsc') }}" placeholder="IFSC Code" class="form-control uppercase">
                            </div>
                        </div>

                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl mb-4">
                            <label class="flex items-start gap-2.5 cursor-pointer text-xs text-slate-600 m-0">
                                <input type="checkbox" id="seller_agree" required class="mt-0.5 accent-indigo-600">
                                <span>I agree to ShopSphere's <strong class="text-indigo-600">Merchant Terms & Conditions</strong> and confirm my store details.</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-between pt-2">
                            <button type="button" onclick="switchSellerStep(2)" class="btn-secondary">
                                &larr; Back
                            </button>
                            <button type="submit" class="btn-primary" style="width: auto; padding: 10px 28px;">
                                🚀 Create Seller Account
                            </button>
                        </div>
                    </div>

                </form>
            </div>

            <!-- Login Footer Link -->
            <div class="text-center mt-6 pt-5 border-t border-slate-100">
                <p class="text-slate-600 text-xs sm:text-sm m-0">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold ml-1 text-decoration-none">
                        Login here
                    </a>
                </p>
            </div>

        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs text-slate-400 hover:text-indigo-600 transition text-decoration-none">
                <span>&larr;</span>
                <span>Back to Home</span>
            </a>
        </div>

    </div>

    <!-- Switch JS -->
    <script>
        function switchRole(type) {
            const wrapper = document.getElementById('formWrapper');
            const customerBtn = document.getElementById('tabCustomerBtn');
            const sellerBtn = document.getElementById('tabSellerBtn');
            const customerSection = document.getElementById('customerFormSection');
            const sellerSection = document.getElementById('sellerFormSection');
            const mainSubtitle = document.getElementById('mainSubtitle');

            if (type === 'seller') {
                wrapper.style.maxWidth = '660px';
                customerBtn.classList.remove('active');
                sellerBtn.classList.add('active');
                customerSection.classList.add('hidden');
                customerSection.classList.remove('block');
                sellerSection.classList.remove('hidden');
                sellerSection.classList.add('block');
                mainSubtitle.textContent = 'Open your store and start selling on ShopSphere';

                const url = new URL(window.location);
                url.searchParams.set('type', 'seller');
                window.history.replaceState({}, '', url);
            } else {
                wrapper.style.maxWidth = '460px';
                sellerBtn.classList.remove('active');
                customerBtn.classList.add('active');
                sellerSection.classList.add('hidden');
                sellerSection.classList.remove('block');
                customerSection.classList.remove('hidden');
                customerSection.classList.add('block');
                mainSubtitle.textContent = 'Join ShopSphere and start shopping';

                const url = new URL(window.location);
                url.searchParams.delete('type');
                window.history.replaceState({}, '', url);
            }
        }

        function switchSellerStep(step) {
            document.querySelectorAll('#sellerFormSection .step-pane').forEach(p => p.classList.remove('active'));
            const pane = document.getElementById('seller-step-pane-' + step);
            if (pane) pane.classList.add('active');

            for (let i = 1; i <= 3; i++) {
                const btn = document.getElementById('seller-tab-btn-' + i);
                if (!btn) continue;
                if (i < step) {
                    btn.className = 'seller-step-tab done';
                } else if (i === step) {
                    btn.className = 'seller-step-tab active';
                } else {
                    btn.className = 'seller-step-tab inactive';
                }
            }
        }

        // Step 1 → Step 2 validation: ensure required fields are filled
        function goToStep2() {
            const name = document.querySelector('#sellerForm [name="name"]');
            const email = document.querySelector('#sellerForm [name="email"]');
            const phone = document.querySelector('#sellerForm [name="phone"]');
            const password = document.querySelector('#sellerForm [name="password"]');
            const passwordConf = document.querySelector('#sellerForm [name="password_confirmation"]');

            if (!name.value.trim()) { name.focus(); name.style.borderColor = '#ef4444'; return; } else { name.style.borderColor = ''; }
            if (!email.value.trim()) { email.focus(); email.style.borderColor = '#ef4444'; return; } else { email.style.borderColor = ''; }
            if (!phone.value.trim()) { phone.focus(); phone.style.borderColor = '#ef4444'; return; } else { phone.style.borderColor = ''; }
            if (!password.value || password.value.length < 8) {
                password.focus();
                password.style.borderColor = '#ef4444';
                alert('Password kam se kam 8 characters ka hona chahiye.');
                return;
            } else { password.style.borderColor = ''; }
            if (passwordConf.value !== password.value) {
                passwordConf.focus();
                passwordConf.style.borderColor = '#ef4444';
                alert('Password aur Confirm Password match nahi kar rahe.');
                return;
            } else { passwordConf.style.borderColor = ''; }

            switchSellerStep(2);
        }

        // Step 2 → Step 3 validation: ensure store name is filled
        function goToStep3() {
            const storeName = document.querySelector('#sellerForm [name="store_name"]');
            if (!storeName.value.trim()) {
                storeName.focus();
                storeName.style.borderColor = '#ef4444';
                alert('Store Name fill karna zaroori hai.');
                return;
            } else { storeName.style.borderColor = ''; }
            switchSellerStep(3);
        }

        // Auto-jump to the error step on page load (set by PHP)
        document.addEventListener('DOMContentLoaded', function() {
            const errorStep = {{ $sellerErrorStep ?? 1 }};
            const hasSellerErrors = {{ ($isSeller && $errors->any()) ? 'true' : 'false' }};
            if (hasSellerErrors && errorStep > 1) {
                switchSellerStep(errorStep);
            }
        });
    </script>

</body>
</html>