<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Login - ShopSphere Seller Central</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body style="background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%); min-height: 100vh; display:flex; align-items:center; justify-content:center; padding: 24px;">

<div style="width:100%; max-width:1050px; display:grid; grid-template-columns:1fr 1fr; gap:0; border-radius:24px; overflow:hidden; box-shadow:0 32px 80px rgba(0,0,0,0.5);">

    <!-- Left Panel: Brand -->
    <div style="background:linear-gradient(140deg,#4f46e5 0%,#7c3aed 60%,#ec4899 100%); padding:56px 48px; display:flex; flex-direction:column; justify-content:space-between; position:relative; overflow:hidden;">
        <div style="position:absolute;top:-40px;right:-40px;width:220px;height:220px;background:rgba(255,255,255,0.07);border-radius:50%;"></div>
        <div style="position:absolute;bottom:-60px;left:-30px;width:300px;height:300px;background:rgba(255,255,255,0.04);border-radius:50%;"></div>
        
        <div style="position:relative;z-index:1;">
            <a href="{{ route('home') }}" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;margin-bottom:48px;">
                <div style="width:44px;height:44px;background:rgba(255,255,255,0.2);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:22px;backdrop-filter:blur(8px);">🛍️</div>
                <span style="color:#fff;font-size:20px;font-weight:800;">ShopSphere</span>
            </a>
            <h1 style="color:#fff;font-size:36px;font-weight:800;line-height:1.2;margin:0 0 16px;">Welcome back to<br>Seller Central 👋</h1>
            <p style="color:rgba(255,255,255,0.78);font-size:16px;line-height:1.6;margin:0;">Access your store dashboard, manage products, and track your earnings in one powerful portal.</p>
        </div>
        <div style="position:relative;z-index:1;">
            <div style="display:flex;flex-direction:column;gap:16px;">
                @foreach([['📦','Manage your full product catalog with ease'],['💰','Track real-time sales and commission earnings'],['🚀','Fulfill orders and manage delivery tracking']] as $f)
                    <div style="display:flex;align-items:center;gap:12px;">
                        <span style="font-size:18px;">{{ $f[0] }}</span>
                        <span style="color:rgba(255,255,255,0.75);font-size:14px;">{{ $f[1] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Right Panel: Login Form -->
    <div style="background:#ffffff;padding:56px 48px;display:flex;flex-direction:column;justify-content:center;">
        <div style="margin-bottom:36px;">
            <h2 style="font-size:26px;font-weight:800;color:#111827;margin:0 0 8px;">Sign in to your store</h2>
            <p style="color:#6b7280;font-size:14px;margin:0;">Don't have a seller account? <a href="{{ route('seller.register') }}" style="color:#4f46e5;font-weight:600;text-decoration:none;">Register here →</a></p>
        </div>

        @if(session('success'))
            <div style="background:#ecfdf5;border:1px solid #6ee7b7;border-radius:12px;padding:14px 18px;margin-bottom:20px;font-size:14px;color:#065f46;font-weight:500;">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background:#fef2f2;border:1px solid #fca5a5;border-radius:12px;padding:14px 18px;margin-bottom:20px;font-size:14px;color:#991b1b;font-weight:500;">
                ⚠️ {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('seller.login.store') }}" style="display:flex;flex-direction:column;gap:20px;">
            @csrf

            <div>
                <label for="email" style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:7px;text-transform:uppercase;letter-spacing:0.5px;">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="seller@yourstore.com"
                    style="width:100%;padding:13px 16px;border:2px solid {{ $errors->has('email') ? '#ef4444' : '#e5e7eb' }};border-radius:12px;font-size:15px;color:#111827;outline:none;font-family:inherit;background:#fafafa;box-sizing:border-box;"
                    onfocus="this.style.borderColor='#4f46e5';this.style.boxShadow='0 0 0 4px rgba(79,70,229,0.1)'"
                    onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'">
            </div>

            <div>
                <label for="password" style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:7px;text-transform:uppercase;letter-spacing:0.5px;">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password"
                    style="width:100%;padding:13px 16px;border:2px solid #e5e7eb;border-radius:12px;font-size:15px;color:#111827;outline:none;font-family:inherit;background:#fafafa;box-sizing:border-box;"
                    onfocus="this.style.borderColor='#4f46e5';this.style.boxShadow='0 0 0 4px rgba(79,70,229,0.1)'"
                    onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'">
            </div>

            <div style="display:flex;align-items:center;justify-content:space-between;">
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:14px;color:#4b5563;">
                    <input type="checkbox" name="remember" style="accent-color:#4f46e5;width:16px;height:16px;">
                    Remember me for 30 days
                </label>
                <a href="{{ route('password.request') }}" style="font-size:14px;color:#4f46e5;font-weight:600;text-decoration:none;">Forgot password?</a>
            </div>

            <button type="submit"
                style="width:100%;background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;font-size:15px;font-weight:700;padding:15px;border:none;border-radius:12px;cursor:pointer;font-family:inherit;transition:all 0.2s;letter-spacing:0.3px;margin-top:4px;"
                onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(79,70,229,0.4)'"
                onmouseout="this.style.transform='none';this.style.boxShadow='none'">
                Sign In to Seller Central →
            </button>

            <div style="text-align:center;font-size:13px;color:#9ca3af;padding-top:8px;">
                <p style="margin:0;">Want to sell on ShopSphere?</p>
                <a href="{{ route('seller.register') }}" style="color:#7c3aed;font-weight:600;text-decoration:none;">Create your seller account for free →</a>
            </div>
        </form>
    </div>

</div>

</body>
</html>
