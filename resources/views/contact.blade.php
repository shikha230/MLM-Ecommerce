<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Care & Helpdesk - FreshBasket Grocery</title>
    <meta name="description" content="Contact FreshBasket grocery customer support for order tracking, freshness guarantee inquiries, delivery assistance and feedback.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f0fdf4; color: #1e293b; }

        /* ---- Gradient Hero ---- */
        .hero-gradient {
            background: linear-gradient(135deg, #14532d 0%, #166534 35%, #15803d 70%, #16a34a 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-gradient::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* ---- Contact Info Card ---- */
        .info-card {
            display: flex;
            align-items: center;
            gap: 18px;
            background: #ffffff;
            border-radius: 18px;
            padding: 22px 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            border: 1px solid #dcfce7;
        }
        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(22,163,74,0.15);
        }
        .info-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        /* ---- Form ---- */
        .form-input {
            width: 100%;
            border: 1.5px solid #d1fae5;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 15px;
            font-family: inherit;
            color: #0f172a;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            outline: none;
            background: #fdfdfd;
        }
        .form-input:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 4px rgba(22,163,74,0.15);
            background: #ffffff;
        }
        .form-input::placeholder { color: #94a3b8; }
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 8px;
        }

        /* ---- Submit Button ---- */
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #059669, #16a34a, #15803d);
            color: #ffffff;
            font-family: inherit;
            font-size: 16px;
            font-weight: 800;
            padding: 16px;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s;
            letter-spacing: 0.3px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(22,163,74,0.35);
        }
        .btn-submit:active { transform: translateY(0); }
        .btn-submit:disabled { opacity: 0.6; cursor: not-allowed; }

        /* ---- Alert ---- */
        .alert-success {
            display: flex; align-items: flex-start; gap: 14px;
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            border: 1px solid #6ee7b7;
            border-left: 5px solid #10b981;
            border-radius: 14px;
            padding: 18px 22px;
            color: #065f46;
            font-weight: 600;
            margin-bottom: 28px;
            animation: slideIn 0.4s ease;
        }
        .alert-error {
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            border: 1px solid #fca5a5;
            border-left: 5px solid #ef4444;
            border-radius: 14px;
            padding: 18px 22px;
            color: #991b1b;
            margin-bottom: 28px;
            animation: slideIn 0.4s ease;
        }
        @keyframes slideIn {
            from { opacity:0; transform: translateY(-12px); }
            to   { opacity:1; transform: translateY(0); }
        }

        /* ---- Responsive Grid Layout ---- */
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1.4fr;
            gap: 48px;
            align-items: start;
        }

        .form-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            margin-bottom: 40px;
        }

        @media (max-width: 900px) {
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 36px;
            }
            .form-card {
                padding: 28px !important;
            }
        }

        @media (max-width: 640px) {
            .form-row-2 {
                grid-template-columns: 1fr;
            }
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 28px;
            }
        }

        /* ---- FAQs ---- */
        .faq-item {
            border: 1px solid #dcfce7;
            border-radius: 14px;
            overflow: hidden;
            transition: box-shadow 0.2s;
            background: #ffffff;
        }
        .faq-item:hover { box-shadow: 0 4px 16px rgba(22,163,74,0.1); }
        .faq-btn {
            width: 100%; background: #ffffff; border: none;
            padding: 18px 22px;
            text-align: left; font-family: inherit;
            font-size: 15px; font-weight: 700; color: #1e293b;
            cursor: pointer; display: flex; justify-content: space-between; align-items: center;
            transition: background 0.15s;
        }
        .faq-btn:hover { background: #f0fdf4; }
        .faq-answer {
            display: none; padding: 0 22px 18px;
            font-size: 14px; color: #475569; line-height: 1.7;
            background: #ffffff;
        }
        .faq-item.open .faq-answer { display: block; }
        .faq-item.open .faq-icon { transform: rotate(180deg); }
        .faq-icon { transition: transform 0.25s ease; }

        /* ---- Floating label badge ---- */
        .badge-new {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,0.18);
            color: #ffffff;
            font-size: 13px; font-weight: 700;
            padding: 6px 14px;
            border-radius: 50px;
            border: 1px solid rgba(255,255,255,0.3);
            margin-bottom: 20px;
            backdrop-filter: blur(8px);
        }

        /* ---- Spinner ---- */
        .spinner {
            display: none; width: 18px; height: 18px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>

<body>

{{-- ============================== NAVBAR ============================== --}}
<nav style="background:#ffffff; box-shadow: 0 2px 16px rgba(0,0,0,0.04); position: sticky; top:0; z-index:50; border-bottom:1px solid #dcfce7;">
    <div style="max-width:1200px; margin:0 auto; padding:0 24px;">
        <div style="display:flex; align-items:center; justify-content:space-between; height:70px;">

            {{-- Logo --}}
            <a href="{{ route('home') }}"
               style="font-size:22px; font-weight:900; text-decoration:none; display:inline-flex; align-items:center; gap:8px;">
                <div style="width:36px; height:36px; border-radius:10px; background:linear-gradient(135deg,#15803d,#16a34a); color:#fff; display:flex; align-items:center; justify-content:center; font-size:18px;">🛒</div>
                <span style="color:#15803d; letter-spacing:-0.5px;">FreshBasket</span>
            </a>

            {{-- Desktop Nav --}}
            <div style="display:flex; align-items:center; gap:28px;">
                <a href="{{ route('home') }}"    style="text-decoration:none; color:#475569; font-size:14px; font-weight:600; transition:color 0.2s;" onmouseover="this.style.color='#16a34a'" onmouseout="this.style.color='#475569'">Home</a>
                <a href="{{ route('products') }}"style="text-decoration:none; color:#475569; font-size:14px; font-weight:600; transition:color 0.2s;" onmouseover="this.style.color='#16a34a'" onmouseout="this.style.color='#475569'">Products</a>
                <a href="{{ route('about') }}"   style="text-decoration:none; color:#475569; font-size:14px; font-weight:600; transition:color 0.2s;" onmouseover="this.style.color='#16a34a'" onmouseout="this.style.color='#475569'">About Us</a>
                <a href="{{ route('contact') }}" style="text-decoration:none; color:#15803d; font-size:14px; font-weight:800; border-bottom:2px solid #15803d; padding-bottom:2px;">Contact</a>
                @guest
                    <a href="{{ route('login') }}"
                       style="text-decoration:none; background:linear-gradient(135deg,#059669,#16a34a); color:#fff;
                              font-size:13px; font-weight:700; padding:9px 20px; border-radius:50px; shadow:0 2px 8px rgba(22,163,74,0.3);">
                        Sign In
                    </a>
                @else
                    <a href="{{ auth()->user()->role === 'seller' ? route('seller.dashboard') : url('/dashboard') }}"
                       style="text-decoration:none; background:linear-gradient(135deg,#15803d,#16a34a); color:#fff;
                              font-size:13px; font-weight:700; padding:9px 18px; border-radius:50px; display:inline-flex; align-items:center; gap:8px;">
                        <span>{{ auth()->user()->role === 'seller' ? '🏪' : '👤' }}</span>
                        <span>{{ auth()->user()->role === 'seller' ? 'Seller Hub' : Str::limit(auth()->user()->name, 12) }}</span>
                    </a>
                @endguest
            </div>

        </div>
    </div>
</nav>


{{-- ============================== HERO ============================== --}}
<section class="hero-gradient" style="padding:80px 24px; text-align:center;">

    <div style="position:relative; z-index:1; max-width:700px; margin:0 auto;">
        <div class="badge-new">
            <span>🌿</span>
            <span>Customer Freshness Helpline 24/7</span>
        </div>
        <h1 style="color:#ffffff; font-size:clamp(34px,5vw,54px); font-weight:900; margin:0 0 16px; line-height:1.15; letter-spacing:-1px;">
            How Can We Assist Your Kitchen?
        </h1>
        <p style="color:rgba(255,255,255,0.9); font-size:17px; margin:0; line-height:1.6;">
            Have questions regarding vegetable freshness, order tracking, milk delivery, or payments? Our team is always ready to help.
        </p>
    </div>

</section>


{{-- ============================== MAIN CONTENT ============================== --}}
<section style="max-width:1200px; margin:0 auto; padding:60px 24px;">

    {{-- ===== ALERTS ===== --}}
    @if(session('success'))
        <div class="alert-success">
            <span style="font-size:24px;">✅</span>
            <div>
                <strong style="display:block; font-size:16px; margin-bottom:4px;">Inquiry Received!</strong>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <div>
                <strong>Please fix the following details:</strong>
            </div>
            <ul style="margin:6px 0 0; padding-left:24px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="contact-grid">

        {{-- ================== LEFT SIDE – INFO ================== --}}
        <div>

            <h2 style="font-size:28px; font-weight:900; color:#0f172a; margin:0 0 10px;">
                Farm-Fresh Support Team
            </h2>
            <p style="color:#64748b; font-size:15px; line-height:1.7; margin:0 0 32px;">
                We guarantee the freshness of every fruit and vegetable we dispatch. Contact us directly if anything does not meet your expectations.
            </p>

            {{-- Info Cards --}}
            <div style="display:flex; flex-direction:column; gap:16px; margin-bottom:40px;">

                <div class="info-card">
                    <div class="info-icon" style="background:#dcfce7; color:#15803d;">
                        ✉️
                    </div>
                    <div>
                        <div style="font-size:12px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px;">Email Support</div>
                        <a href="mailto:care@freshbasket.in"
                           style="font-size:15px; font-weight:700; color:#15803d; text-decoration:none;">
                            care@freshbasket.in
                        </a>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon" style="background:#ecfdf5; color:#059669;">
                        📞
                    </div>
                    <div>
                        <div style="font-size:12px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px;">Toll-Free Helpline</div>
                        <a href="tel:180012337374"
                           style="font-size:15px; font-weight:700; color:#059669; text-decoration:none;">
                            1800-123-FRESH (37374)
                        </a>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon" style="background:#f0fdf4; color:#16a34a;">
                        📍
                    </div>
                    <div>
                        <div style="font-size:12px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px;">Central Cold-Chain Hub</div>
                        <span style="font-size:15px; font-weight:700; color:#166534;">
                            FreshBasket Agri-Logistics Park, India
                        </span>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon" style="background:#fef3c7; color:#d97706;">
                        ⚡
                    </div>
                    <div>
                        <div style="font-size:12px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px;">Delivery Hours</div>
                        <span style="font-size:15px; font-weight:700; color:#b45309;">
                            Daily: 6:00 AM – 11:00 PM (All 7 Days)
                        </span>
                    </div>
                </div>

            </div>

        </div>


        {{-- ================== RIGHT SIDE – FORM ================== --}}
        <div class="form-card" style="
            background:#ffffff;
            border-radius:24px;
            padding:44px;
            box-shadow: 0 8px 40px rgba(22,163,74,0.08);
            border: 1px solid #dcfce7;
        ">

            <div style="margin-bottom:30px;">
                <h2 style="font-size:24px; font-weight:900; color:#0f172a; margin:0 0 8px; display:flex; align-items:center; gap:10px;">
                    <span>Send a Grocery Support Ticket</span>
                    <span>🌿</span>
                </h2>
                <p style="font-size:14px; color:#64748b; margin:0;">
                    We usually resolve grocery queries in less than <strong style="color:#16a34a;">2 hours</strong>.
                </p>
            </div>

            <form id="contactForm"
                  action="{{ route('contact.submit') }}"
                  method="POST"
                  style="display:flex; flex-direction:column; gap:20px;">

                @csrf

                {{-- Row: Name + Email --}}
                <div class="form-row-2">

                    <div>
                        <label for="name" class="form-label">
                            Full Name <span style="color:#ef4444;">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            placeholder="Your full name"
                            class="form-input"
                        >
                    </div>

                    <div>
                        <label for="email" class="form-label">
                            Email Address <span style="color:#ef4444;">*</span>
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="you@example.com"
                            class="form-input"
                        >
                    </div>

                </div>

                {{-- Row: Phone + Subject --}}
                <div class="form-row-2">

                    <div>
                        <label for="phone" class="form-label">
                            Phone / WhatsApp
                            <span style="color:#94a3b8; font-weight:400;">(for quick resolution)</span>
                        </label>
                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="+91 98765 XXXXX"
                            class="form-input"
                        >
                    </div>

                    <div>
                        <label for="subject" class="form-label">
                            Inquiry Type <span style="color:#ef4444;">*</span>
                        </label>
                        <select id="subject" name="subject" required class="form-input">
                            <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Select an inquiry type</option>
                            <option value="Freshness Issue"       {{ old('subject') == 'Freshness Issue' ? 'selected' : '' }}>Produce Freshness Issue</option>
                            <option value="Order Tracking"         {{ old('subject') == 'Order Tracking' ? 'selected' : '' }}>Order Status / Tracking</option>
                            <option value="Missing Item"           {{ old('subject') == 'Missing Item' ? 'selected' : '' }}>Missing / Incorrect Item</option>
                            <option value="Refund & Return"        {{ old('subject') == 'Refund & Return' ? 'selected' : '' }}>Refund & Instant Replacement</option>
                            <option value="Farmer & Seller Inquiry"{{ old('subject') == 'Farmer & Seller Inquiry' ? 'selected' : '' }}>Farmer / Seller Partnership</option>
                            <option value="Payment Issue"          {{ old('subject') == 'Payment Issue' ? 'selected' : '' }}>Payment or Wallet Query</option>
                            <option value="Other"                  {{ old('subject') == 'Other' ? 'selected' : '' }}>Other Inquiries</option>
                        </select>
                    </div>

                </div>

                {{-- Message --}}
                <div>
                    <label for="message" class="form-label">
                        Message / Order Number <span style="color:#ef4444;">*</span>
                    </label>
                    <textarea
                        id="message"
                        name="message"
                        rows="5"
                        required
                        placeholder="Please describe your inquiry or mention your Order ID..."
                        class="form-input"
                        style="resize:vertical;"
                    >{{ old('message') }}</textarea>
                </div>

                {{-- Submit --}}
                <button type="submit" id="submitBtn" class="btn-submit" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                    <span id="btnText">Submit Ticket & Get Help</span>
                    <span class="spinner" id="spinner"></span>
                </button>

                <p style="text-align:center; font-size:12px; color:#64748b; margin:0;">
                    🔒 100% Privacy Guaranteed. Our team handles your requests promptly.
                </p>

            </form>

        </div>

    </div>
</section>


{{-- ============================== FAQ ============================== --}}
<section style="background:#ffffff; padding:70px 24px; border-top:1px solid #dcfce7;">
    <div style="max-width:800px; margin:0 auto;">

        <div style="text-align:center; margin-bottom:48px;">
            <span style="font-size:12px; font-weight:800; color:#15803d; text-transform:uppercase; letter-spacing:1px;">Help Center</span>
            <h2 style="font-size:30px; font-weight:900; color:#0f172a; margin:4px 0 10px;">
                Frequently Asked Grocery Questions
            </h2>
            <p style="color:#64748b; font-size:15px; margin:0;">
                Quick answers on fresh deliveries, hygiene standards, and refunds
            </p>
        </div>

        <div style="display:flex; flex-direction:column; gap:14px;" id="faqContainer">

            <div class="faq-item" onclick="toggleFaq(this)">
                <button class="faq-btn">
                    <span>What if vegetables or fruits are not fresh on arrival?</span>
                    <span class="faq-icon">▼</span>
                </button>
                <div class="faq-answer">
                    We offer a 100% No-Questions-Asked Freshness Guarantee. Simply notify us via the helpdesk or helpline within 2 hours of delivery and we will initiate an instant replacement or full wallet refund.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFaq(this)">
                <button class="faq-btn">
                    <span>How fast is your grocery delivery?</span>
                    <span class="faq-icon">▼</span>
                </button>
                <div class="faq-answer">
                    We offer two options: <strong>Express 15-30 Minute Delivery</strong> for instant kitchen needs, and <strong>Early Morning Slot (6:00 AM – 8:00 AM)</strong> for fresh milk, artisan bread, and breakfast produce.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFaq(this)">
                <button class="faq-btn">
                    <span>How do you keep dairy and vegetables fresh in transit?</span>
                    <span class="faq-icon">▼</span>
                </button>
                <div class="faq-answer">
                    All dairy items, paneer, and fragile greens are packed in temperature-controlled, reusable food-grade insulated bags with food-safe chill gels maintaining 4°C throughout the transit journey.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFaq(this)">
                <button class="faq-btn">
                    <span>How can local farmers or vendors sell on FreshBasket?</span>
                    <span class="faq-icon">▼</span>
                </button>
                <div class="faq-answer">
                    Registered organic cultivators and authorized grocery suppliers can register via our Seller Portal or contact us directly at care@freshbasket.in. We offer fair farmgate prices and swift payment settlements.
                </div>
            </div>

        </div>

    </div>
</section>


{{-- ============================== FOOTER ============================== --}}
<footer style="background:#0f172a; color:#94a3b8; padding:48px 24px 24px;">
    <div style="max-width:1200px; margin:0 auto;">

        <div class="footer-grid">

            <div>
                <div style="font-size:20px; font-weight:900; color:#ffffff; margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                    <span style="font-size:22px;">🛒</span>
                    <span style="color:#22c55e;">FreshBasket</span>
                </div>
                <p style="font-size:13px; line-height:1.7; margin:0;">
                    Farm-fresh organic fruits, vegetables, dairy, grains and pantry staples delivered with freshness guaranteed.
                </p>
            </div>

            <div>
                <h3 style="font-size:13px; font-weight:800; color:#ffffff; text-transform:uppercase; letter-spacing:0.5px; margin:0 0 16px;">Quick Links</h3>
                <div style="display:flex; flex-direction:column; gap:10px;">
                    <a href="{{ route('home') }}"    style="text-decoration:none; color:#94a3b8; font-size:13px; transition:color 0.2s;" onmouseover="this.style.color='#22c55e'" onmouseout="this.style.color='#94a3b8'">🏠 Home</a>
                    <a href="{{ route('products') }}"style="text-decoration:none; color:#94a3b8; font-size:13px; transition:color 0.2s;" onmouseover="this.style.color='#22c55e'" onmouseout="this.style.color='#94a3b8'">🛒 Fresh Catalogue</a>
                    <a href="{{ route('about') }}"   style="text-decoration:none; color:#94a3b8; font-size:13px; transition:color 0.2s;" onmouseover="this.style.color='#22c55e'" onmouseout="this.style.color='#94a3b8'">🌱 About Our Farms</a>
                    <a href="{{ route('contact') }}" style="text-decoration:none; color:#94a3b8; font-size:13px; transition:color 0.2s;" onmouseover="this.style.color='#22c55e'" onmouseout="this.style.color='#94a3b8'">📞 Helpdesk</a>
                </div>
            </div>

            <div>
                <h3 style="font-size:13px; font-weight:800; color:#ffffff; text-transform:uppercase; letter-spacing:0.5px; margin:0 0 16px;">Customer Support</h3>
                <p style="font-size:13px; margin:0 0 6px;">📞 1800-123-FRESH (37374)</p>
                <p style="font-size:13px; margin:0 0 6px;">✉️ care@freshbasket.in</p>
                <p style="font-size:13px; margin:0;">⏰ 6:00 AM – 11:00 PM (Daily)</p>
            </div>

        </div>

        <div style="border-top:1px solid #1e293b; padding-top:24px; text-align:center; font-size:12px;">
            © {{ date('Y') }} FreshBasket Grocery. All rights reserved.
        </div>

    </div>
</footer>

<script>
    function toggleFaq(el) {
        el.classList.toggle('open');
    }
</script>

</body>
</html>
