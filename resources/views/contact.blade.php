<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - ShopSphere</title>
    <meta name="description" content="Contact ShopSphere support team for product queries, orders, payments and more. We're here to help you 24/7.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; }

        /* ---- Gradient Hero ---- */
        .hero-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #ec4899 100%);
        }

        /* ---- Contact Info Card ---- */
        .info-card {
            display: flex;
            align-items: center;
            gap: 18px;
            background: #ffffff;
            border-radius: 16px;
            padding: 22px 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.07);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            border: 1px solid #f0f0ff;
        }
        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 32px rgba(79,70,229,0.15);
        }
        .info-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        /* ---- Form ---- */
        .form-input {
            width: 100%;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            color: #111827;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            outline: none;
            background: #fafafa;
        }
        .form-input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79,70,229,0.1);
            background: #ffffff;
        }
        .form-input::placeholder { color: #9ca3af; }
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        /* ---- Submit Button ---- */
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: #ffffff;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: 700;
            padding: 16px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s;
            letter-spacing: 0.3px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(79,70,229,0.4);
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
            font-weight: 500;
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
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            overflow: hidden;
            transition: box-shadow 0.2s;
        }
        .faq-item:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.07); }
        .faq-btn {
            width: 100%; background: #ffffff; border: none;
            padding: 18px 22px;
            text-align: left; font-family: 'Inter', sans-serif;
            font-size: 15px; font-weight: 600; color: #111827;
            cursor: pointer; display: flex; justify-content: space-between; align-items: center;
            transition: background 0.15s;
        }
        .faq-btn:hover { background: #f9fafb; }
        .faq-answer {
            display: none; padding: 0 22px 18px;
            font-size: 14px; color: #4b5563; line-height: 1.7;
            background: #ffffff;
        }
        .faq-item.open .faq-answer { display: block; }
        .faq-item.open .faq-icon { transform: rotate(45deg); }
        .faq-icon { font-size: 22px; transition: transform 0.25s; }

        /* ---- Floating label badge ---- */
        .badge-new {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,0.2);
            color: #ffffff;
            font-size: 13px; font-weight: 600;
            padding: 6px 14px;
            border-radius: 50px;
            border: 1px solid rgba(255,255,255,0.35);
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

<body style="background:#f5f5ff; color:#1f2937;">


{{-- ============================== NAVBAR ============================== --}}
<nav style="background:#ffffff; box-shadow: 0 2px 16px rgba(0,0,0,0.06); position: sticky; top:0; z-index:50;">
    <div style="max-width:1200px; margin:0 auto; padding:0 24px;">
        <div style="display:flex; align-items:center; justify-content:space-between; height:68px;">

            {{-- Logo --}}
            <a href="{{ route('home') }}"
               style="font-size:22px; font-weight:800; text-decoration:none;
                      background:linear-gradient(135deg,#4f46e5,#7c3aed);
                      -webkit-background-clip:text; -webkit-text-fill-color:transparent;">
                🛍️ ShopSphere
            </a>

            {{-- Desktop Nav --}}
            <div style="display:flex; align-items:center; gap:28px;">
                <a href="{{ route('home') }}"    style="text-decoration:none; color:#4b5563; font-size:14px; font-weight:500; transition:color 0.2s;" onmouseover="this.style.color='#4f46e5'" onmouseout="this.style.color='#4b5563'">Home</a>
                <a href="{{ route('about') }}"   style="text-decoration:none; color:#4b5563; font-size:14px; font-weight:500; transition:color 0.2s;" onmouseover="this.style.color='#4f46e5'" onmouseout="this.style.color='#4b5563'">About</a>
                <a href="{{ route('contact') }}" style="text-decoration:none; color:#4f46e5;  font-size:14px; font-weight:700; border-bottom:2px solid #4f46e5; padding-bottom:2px;">Contact</a>
                @guest
                    <a href="{{ route('login') }}"
                       style="text-decoration:none; background:linear-gradient(135deg,#4f46e5,#7c3aed); color:#fff;
                              font-size:14px; font-weight:600; padding:9px 20px; border-radius:50px;">
                        Account / Login
                    </a>
                @else
                    <a href="{{ url('/dashboard') }}"
                       style="text-decoration:none; background:linear-gradient(135deg,#4f46e5,#7c3aed); color:#fff;
                              font-size:14px; font-weight:600; padding:9px 18px; border-radius:50px; display:inline-flex; align-items:center; gap:8px;">
                        <span>👤 {{ Str::limit(auth()->user()->name, 12) }}</span>
                    </a>
                @endguest
            </div>

        </div>
    </div>
</nav>


{{-- ============================== HERO ============================== --}}
<section class="hero-gradient" style="padding:80px 24px; text-align:center; position:relative; overflow:hidden;">

    {{-- Decorative blobs --}}
    <div style="position:absolute; top:-60px; left:-80px; width:300px; height:300px;
                background:rgba(255,255,255,0.06); border-radius:50%;"></div>
    <div style="position:absolute; bottom:-80px; right:-60px; width:400px; height:400px;
                background:rgba(255,255,255,0.04); border-radius:50%;"></div>

    <div style="position:relative; z-index:1; max-width:700px; margin:0 auto;">
        <div class="badge-new">
            ✨ &nbsp;We respond within 24 hours
        </div>
        <h1 style="color:#ffffff; font-size:clamp(36px,5vw,58px); font-weight:800; margin:0 0 16px; line-height:1.15; letter-spacing:-1px;">
            Get in Touch With Us
        </h1>
        <p style="color:rgba(255,255,255,0.82); font-size:18px; margin:0; line-height:1.6;">
            Product queries, orders, payments ya kuch bhi — hum yahin hain aapke liye. 💬
        </p>
    </div>

</section>


{{-- ============================== MAIN CONTENT ============================== --}}
<section style="max-width:1200px; margin:0 auto; padding:60px 24px;">

    {{-- ===== ALERTS ===== --}}
    @if(session('success'))
        <div class="alert-success">
            <span style="font-size:24px; flex-shrink:0;">✅</span>
            <div>
                <strong style="display:block; font-size:16px; margin-bottom:4px;">Inquiry Submit Ho Gayi!</strong>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <strong style="display:block; margin-bottom:8px;">⚠️ Kuch errors hain:</strong>
            <ul style="margin:0; padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li style="margin-bottom:4px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="contact-grid">


        {{-- ================== LEFT SIDE – INFO ================== --}}
        <div>

            <h2 style="font-size:28px; font-weight:800; color:#111827; margin:0 0 10px;">
                Hum yahin hain! 👋
            </h2>
            <p style="color:#6b7280; font-size:15px; line-height:1.7; margin:0 0 32px;">
                Koi bhi sawaal ho toh jhijhak mat. Hamari team din mein 24 ghante uplabdh hai aapki madad ke liye.
            </p>

            {{-- Info Cards --}}
            <div style="display:flex; flex-direction:column; gap:16px; margin-bottom:40px;">

                <div class="info-card">
                    <div class="info-icon" style="background:linear-gradient(135deg,#eff6ff,#dbeafe);">📧</div>
                    <div>
                        <div style="font-size:12px; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px;">Email</div>
                        <a href="mailto:support@shopsphere.com"
                           style="font-size:15px; font-weight:600; color:#4f46e5; text-decoration:none;">
                            support@shopsphere.com
                        </a>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon" style="background:linear-gradient(135deg,#ecfdf5,#d1fae5);">📞</div>
                    <div>
                        <div style="font-size:12px; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px;">Phone</div>
                        <a href="tel:+919876543210"
                           style="font-size:15px; font-weight:600; color:#059669; text-decoration:none;">
                            +91 98765 43210
                        </a>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon" style="background:linear-gradient(135deg,#fdf4ff,#f3e8ff);">📍</div>
                    <div>
                        <div style="font-size:12px; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px;">Address</div>
                        <span style="font-size:15px; font-weight:600; color:#7c3aed;">
                            ShopSphere Business Center, India
                        </span>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon" style="background:linear-gradient(135deg,#fff7ed,#fed7aa);">🕐</div>
                    <div>
                        <div style="font-size:12px; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px;">Business Hours</div>
                        <span style="font-size:15px; font-weight:600; color:#ea580c;">
                            Mon–Sat: 9 AM – 7 PM IST
                        </span>
                    </div>
                </div>

            </div>

            {{-- Social Links --}}
            <div>
                <p style="font-size:13px; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; margin:0 0 14px;">Follow Us</p>
                <div style="display:flex; gap:12px;">
                    <a href="#" style="width:44px; height:44px; background:#4f46e5; border-radius:12px; display:flex; align-items:center; justify-content:center; text-decoration:none; font-size:20px; transition:transform 0.2s;" title="Facebook" onmouseover="this.style.transform='scale(1.12)'" onmouseout="this.style.transform='scale(1)'">🌐</a>
                    <a href="#" style="width:44px; height:44px; background:#ec4899; border-radius:12px; display:flex; align-items:center; justify-content:center; text-decoration:none; font-size:20px; transition:transform 0.2s;" title="Instagram" onmouseover="this.style.transform='scale(1.12)'" onmouseout="this.style.transform='scale(1)'">📸</a>
                    <a href="#" style="width:44px; height:44px; background:#1d9bf0; border-radius:12px; display:flex; align-items:center; justify-content:center; text-decoration:none; font-size:20px; transition:transform 0.2s;" title="Twitter" onmouseover="this.style.transform='scale(1.12)'" onmouseout="this.style.transform='scale(1)'">🐦</a>
                </div>
            </div>

        </div>


        {{-- ================== RIGHT SIDE – FORM ================== --}}
        <div class="form-card" style="
            background:#ffffff;
            border-radius:24px;
            padding:48px;
            box-shadow: 0 8px 48px rgba(79,70,229,0.1), 0 2px 8px rgba(0,0,0,0.05);
            border: 1px solid #f0f0ff;
        ">

            <div style="margin-bottom:32px;">
                <h2 style="font-size:26px; font-weight:800; color:#111827; margin:0 0 8px;">
                    Inquiry Bhejein 📩
                </h2>
                <p style="font-size:14px; color:#9ca3af; margin:0;">
                    Hum <strong style="color:#4f46e5;">24 ghante</strong> ke andar reply karenge.
                </p>
            </div>

            <form id="contactForm"
                  action="{{ route('contact.submit') }}"
                  method="POST"
                  style="display:flex; flex-direction:column; gap:22px;">

                @csrf

                {{-- Row: Name + Email --}}
                <div class="form-row-2">

                    <div>
                        <label for="name" class="form-label">
                            👤 Full Name <span style="color:#ef4444;">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            placeholder="Apna naam likhein"
                            class="form-input"
                        >
                    </div>

                    <div>
                        <label for="email" class="form-label">
                            📧 Email Address <span style="color:#ef4444;">*</span>
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="aapka@email.com"
                            class="form-input"
                        >
                    </div>

                </div>

                {{-- Row: Phone + Subject --}}
                <div class="form-row-2">

                    <div>
                        <label for="phone" class="form-label">
                            📞 Phone Number
                            <span style="color:#9ca3af; font-weight:400;">(optional)</span>
                        </label>
                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="+91 XXXXX XXXXX"
                            class="form-input"
                        >
                    </div>

                    <div>
                        <label for="subject" class="form-label">
                            📌 Subject <span style="color:#ef4444;">*</span>
                        </label>
                        <select id="subject" name="subject" required class="form-input">
                            <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Topic choose karein</option>
                            <option value="Product Inquiry"     {{ old('subject') == 'Product Inquiry' ? 'selected' : '' }}>🛍️ Product Inquiry</option>
                            <option value="Order Status"        {{ old('subject') == 'Order Status' ? 'selected' : '' }}>📦 Order Status</option>
                            <option value="Payment Issue"       {{ old('subject') == 'Payment Issue' ? 'selected' : '' }}>💳 Payment Issue</option>
                            <option value="Return & Refund"     {{ old('subject') == 'Return & Refund' ? 'selected' : '' }}>↩️ Return & Refund</option>
                            <option value="MLM / Referral"      {{ old('subject') == 'MLM / Referral' ? 'selected' : '' }}>🤝 MLM / Referral</option>
                            <option value="Account Support"     {{ old('subject') == 'Account Support' ? 'selected' : '' }}>👤 Account Support</option>
                            <option value="Other"               {{ old('subject') == 'Other' ? 'selected' : '' }}>💬 Other</option>
                        </select>
                    </div>

                </div>

                {{-- Message --}}
                <div>
                    <label for="message" class="form-label">
                        💬 Message <span style="color:#ef4444;">*</span>
                    </label>
                    <textarea
                        id="message"
                        name="message"
                        rows="6"
                        required
                        placeholder="Apni query ya message yahan likhein..."
                        class="form-input"
                        style="resize:vertical;"
                    >{{ old('message') }}</textarea>
                    <div style="text-align:right; font-size:12px; color:#9ca3af; margin-top:6px;" id="charCount">0 / 5000 characters</div>
                </div>

                {{-- Submit --}}
                <button type="submit" id="submitBtn" class="btn-submit">
                    <span id="btnText">Send Inquiry 🚀</span>
                    <span class="spinner" id="spinner" style="display:inline-block; vertical-align:middle; margin-left:8px;"></span>
                </button>

                <p style="text-align:center; font-size:13px; color:#9ca3af; margin:0;">
                    🔒 Aapka data safe hai. Hum kabhi share nahi karte.
                </p>

            </form>

        </div>

    </div>
</section>


{{-- ============================== FAQ ============================== --}}
<section style="background:#ffffff; padding:70px 24px;">
    <div style="max-width:800px; margin:0 auto;">

        <div style="text-align:center; margin-bottom:48px;">
            <h2 style="font-size:32px; font-weight:800; color:#111827; margin:0 0 12px;">
                Aksar Pooche Jane Wale Sawaal ❓
            </h2>
            <p style="color:#6b7280; font-size:16px; margin:0;">
                Frequently Asked Questions
            </p>
        </div>

        <div style="display:flex; flex-direction:column; gap:12px;" id="faqContainer">

            <div class="faq-item" onclick="toggleFaq(this)">
                <button class="faq-btn">
                    Order return kaise karein?
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    Aap apne account mein login karke "My Orders" section mein jaakar return request raise kar sakte hain. Return pickup 2–3 business days mein ho jaata hai.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFaq(this)">
                <button class="faq-btn">
                    Payment fail ho gayi — kya karein?
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    Agar payment fail hui hai toh paisa 5–7 business days mein automatically refund ho jaata hai. Agar nahi aaya toh humse contact karein is form ke through.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFaq(this)">
                <button class="faq-btn">
                    MLM referral commission kab milta hai?
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    Har successful referral ke baad commission aapke dashboard wallet mein 24 ghante mein credit ho jaata hai. Withdrawal minimum ₹500 se kar sakte hain.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFaq(this)">
                <button class="faq-btn">
                    Reply aane mein kitna time lagta hai?
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    Hum <strong>24 ghante</strong> ke andar reply karte hain. Urgent mamlon ke liye seedha phone karein: +91 98765 43210.
                </div>
            </div>

        </div>

    </div>
</section>


{{-- ============================== FOOTER ============================== --}}
<footer style="background:#111827; color:#9ca3af; padding:48px 24px 24px;">
    <div style="max-width:1200px; margin:0 auto;">

        <div class="footer-grid">

            <div>
                <div style="font-size:20px; font-weight:800; color:#ffffff; margin-bottom:12px;">🛍️ ShopSphere</div>
                <p style="font-size:14px; line-height:1.7; margin:0;">
                    Aapka trusted online shopping platform. Premium products, best prices.
                </p>
            </div>

            <div>
                <h3 style="font-size:14px; font-weight:700; color:#ffffff; text-transform:uppercase; letter-spacing:0.5px; margin:0 0 16px;">Quick Links</h3>
                <div style="display:flex; flex-direction:column; gap:10px;">
                    <a href="{{ route('home') }}"    style="text-decoration:none; color:#9ca3af; font-size:14px; transition:color 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#9ca3af'">Home</a>
                    <a href="{{ route('about') }}"   style="text-decoration:none; color:#9ca3af; font-size:14px; transition:color 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#9ca3af'">About Us</a>
                    <a href="{{ route('contact') }}" style="text-decoration:none; color:#9ca3af; font-size:14px; transition:color 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#9ca3af'">Contact</a>
                    <a href="{{ route('login') }}"   style="text-decoration:none; color:#9ca3af; font-size:14px; transition:color 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#9ca3af'">Login</a>
                </div>
            </div>

            <div>
                <h3 style="font-size:14px; font-weight:700; color:#ffffff; text-transform:uppercase; letter-spacing:0.5px; margin:0 0 16px;">Support</h3>
                <div style="font-size:14px; line-height:1.8;">
                    <p style="margin:0 0 6px;">📧 support@shopsphere.com</p>
                    <p style="margin:0 0 6px;">📞 +91 98765 43210</p>
                    <p style="margin:0;">🕐 Mon–Sat: 9 AM – 7 PM IST</p>
                </div>
            </div>

        </div>

        <div style="border-top:1px solid #374151; padding-top:24px; text-align:center; font-size:13px;">
            © {{ date('Y') }} ShopSphere. All rights reserved. &nbsp;|&nbsp; Made with ❤️ in India
        </div>

    </div>
</footer>


{{-- ============================== SCRIPTS ============================== --}}
<script>
    // FAQ Toggle
    function toggleFaq(el) {
        const isOpen = el.classList.contains('open');
        document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
        if (!isOpen) el.classList.add('open');
    }

    // Character Counter
    const msgArea  = document.getElementById('message');
    const charCount = document.getElementById('charCount');
    if (msgArea) {
        msgArea.addEventListener('input', () => {
            const len = msgArea.value.length;
            charCount.textContent = len + ' / 5000 characters';
            charCount.style.color = len > 4800 ? '#ef4444' : '#9ca3af';
        });
    }

    // Submit loading state
    const form = document.getElementById('contactForm');
    const btn  = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const spinner = document.getElementById('spinner');

    if (form) {
        form.addEventListener('submit', () => {
            btn.disabled = true;
            btnText.textContent = 'Sending...';
            spinner.style.display = 'inline-block';
        });
    }

    // Auto-dismiss success after 6s
    const successAlert = document.querySelector('.alert-success');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.transition = 'opacity 0.5s, transform 0.5s';
            successAlert.style.opacity = '0';
            successAlert.style.transform = 'translateY(-8px)';
            setTimeout(() => successAlert.remove(), 500);
        }, 6000);
    }
</script>

</body>
</html>