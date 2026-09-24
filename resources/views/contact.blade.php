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
        .faq-item.open .faq-icon { transform: rotate(180deg); }
        .faq-icon { transition: transform 0.25s ease; }

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
               style="font-size:22px; font-weight:800; text-decoration:none; display:inline-flex; align-items:center; gap:8px;">
                <svg style="width:26px; height:26px; color:#4f46e5; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <span style="background:linear-gradient(135deg,#4f46e5,#7c3aed); -webkit-background-clip:text; -webkit-text-fill-color:transparent;">ShopSphere</span>
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
                    <a href="{{ auth()->user()->role === 'seller' ? route('seller.dashboard') : url('/dashboard') }}"
                       style="text-decoration:none; background:{{ auth()->user()->role === 'seller' ? 'linear-gradient(135deg,#f59e0b,#4f46e5)' : 'linear-gradient(135deg,#4f46e5,#7c3aed)' }}; color:#fff;
                              font-size:14px; font-weight:600; padding:9px 18px; border-radius:50px; display:inline-flex; align-items:center; gap:8px;">
                        <span>{{ auth()->user()->role === 'seller' ? '🏪' : '👤' }}</span>
                        <span>{{ auth()->user()->role === 'seller' ? 'Seller Central' : Str::limit(auth()->user()->name, 12) }}</span>
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
            <svg style="width:15px; height:15px; margin-right:4px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            We respond within 24 hours
        </div>
        <h1 style="color:#ffffff; font-size:clamp(36px,5vw,58px); font-weight:800; margin:0 0 16px; line-height:1.15; letter-spacing:-1px;">
            Get in Touch With Us
        </h1>
        <p style="color:rgba(255,255,255,0.85); font-size:18px; margin:0; line-height:1.6;">
            Product inquiries, orders, payments, or any questions — we're here to help you.
        </p>
    </div>

</section>


{{-- ============================== MAIN CONTENT ============================== --}}
<section style="max-width:1200px; margin:0 auto; padding:60px 24px;">

    {{-- ===== ALERTS ===== --}}
    @if(session('success'))
        <div class="alert-success">
            <svg style="width:24px; height:24px; color:#10b981; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <strong style="display:block; font-size:16px; margin-bottom:4px;">Inquiry Submitted!</strong>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <div style="display:flex; align-items:center; gap:8px; margin-bottom:8px;">
                <svg style="width:20px; height:20px; color:#ef4444; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <strong>Please fix the following errors:</strong>
            </div>
            <ul style="margin:0; padding-left:24px;">
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
                We're Here for You!
            </h2>
            <p style="color:#6b7280; font-size:15px; line-height:1.7; margin:0 0 32px;">
                Have any questions or need assistance? Feel free to reach out. Our support team is here to assist you 24/7.
            </p>

            {{-- Info Cards --}}
            <div style="display:flex; flex-direction:column; gap:16px; margin-bottom:40px;">

                <div class="info-card">
                    <div class="info-icon" style="background:linear-gradient(135deg,#eff6ff,#dbeafe); color:#3b82f6;">
                        <svg style="width:22px; height:22px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <div style="font-size:12px; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px;">Email</div>
                        <a href="mailto:support@shopsphere.com"
                           style="font-size:15px; font-weight:600; color:#4f46e5; text-decoration:none;">
                            support@shopsphere.com
                        </a>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon" style="background:linear-gradient(135deg,#ecfdf5,#d1fae5); color:#059669;">
                        <svg style="width:22px; height:22px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <div style="font-size:12px; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px;">Phone</div>
                        <a href="tel:+919876543210"
                           style="font-size:15px; font-weight:600; color:#059669; text-decoration:none;">
                            +91 98765 43210
                        </a>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon" style="background:linear-gradient(135deg,#fdf4ff,#f3e8ff); color:#7c3aed;">
                        <svg style="width:22px; height:22px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <div style="font-size:12px; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px;">Address</div>
                        <span style="font-size:15px; font-weight:600; color:#7c3aed;">
                            ShopSphere Business Center, India
                        </span>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon" style="background:linear-gradient(135deg,#fff7ed,#fed7aa); color:#ea580c;">
                        <svg style="width:22px; height:22px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
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
                    <a href="#" style="width:44px; height:44px; background:#4f46e5; border-radius:12px; display:flex; align-items:center; justify-content:center; text-decoration:none; color:#ffffff; transition:transform 0.2s;" title="Facebook" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <svg style="width:20px; height:20px;" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                        </svg>
                    </a>
                    <a href="#" style="width:44px; height:44px; background:linear-gradient(135deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); border-radius:12px; display:flex; align-items:center; justify-content:center; text-decoration:none; color:#ffffff; transition:transform 0.2s;" title="Instagram" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <svg style="width:20px; height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke-width="2"/>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" stroke-width="2"/>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke-width="2"/>
                        </svg>
                    </a>
                    <a href="#" style="width:44px; height:44px; background:#111827; border-radius:12px; display:flex; align-items:center; justify-content:center; text-decoration:none; color:#ffffff; transition:transform 0.2s;" title="Twitter" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <svg style="width:18px; height:18px;" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
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
                <h2 style="font-size:26px; font-weight:800; color:#111827; margin:0 0 8px; display:flex; align-items:center; gap:10px;">
                    <span>Send an Inquiry</span>
                    <svg style="width:24px; height:24px; color:#4f46e5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </h2>
                <p style="font-size:14px; color:#9ca3af; margin:0;">
                    We usually respond within <strong style="color:#4f46e5;">24 hours</strong>.
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
                        <label for="name" class="form-label" style="display:flex; align-items:center; gap:6px;">
                            <svg style="width:16px; height:16px; color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Full Name <span style="color:#ef4444;">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            placeholder="Enter your full name"
                            class="form-input"
                        >
                    </div>

                    <div>
                        <label for="email" class="form-label" style="display:flex; align-items:center; gap:6px;">
                            <svg style="width:16px; height:16px; color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
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
                        <label for="phone" class="form-label" style="display:flex; align-items:center; gap:6px;">
                            <svg style="width:16px; height:16px; color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Phone Number
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
                        <label for="subject" class="form-label" style="display:flex; align-items:center; gap:6px;">
                            <svg style="width:16px; height:16px; color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Subject <span style="color:#ef4444;">*</span>
                        </label>
                        <select id="subject" name="subject" required class="form-input">
                            <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Select a topic</option>
                            <option value="Product Inquiry"     {{ old('subject') == 'Product Inquiry' ? 'selected' : '' }}>Product Inquiry</option>
                            <option value="Order Status"        {{ old('subject') == 'Order Status' ? 'selected' : '' }}>Order Status</option>
                            <option value="Payment Issue"       {{ old('subject') == 'Payment Issue' ? 'selected' : '' }}>Payment Issue</option>
                            <option value="Return & Refund"     {{ old('subject') == 'Return & Refund' ? 'selected' : '' }}>Return & Refund</option>
                            <option value="MLM / Referral"      {{ old('subject') == 'MLM / Referral' ? 'selected' : '' }}>MLM / Referral</option>
                            <option value="Account Support"     {{ old('subject') == 'Account Support' ? 'selected' : '' }}>Account Support</option>
                            <option value="Other"               {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                </div>

                {{-- Message --}}
                <div>
                    <label for="message" class="form-label" style="display:flex; align-items:center; gap:6px;">
                        <svg style="width:16px; height:16px; color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        Message <span style="color:#ef4444;">*</span>
                    </label>
                    <textarea
                        id="message"
                        name="message"
                        rows="6"
                        required
                        placeholder="Type your message or inquiry here..."
                        class="form-input"
                        style="resize:vertical;"
                    >{{ old('message') }}</textarea>
                    <div style="text-align:right; font-size:12px; color:#9ca3af; margin-top:6px;" id="charCount">0 / 5000 characters</div>
                </div>

                {{-- Submit --}}
                <button type="submit" id="submitBtn" class="btn-submit" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                    <span id="btnText" style="display:inline-flex; align-items:center; gap:8px;">
                        <span>Send Inquiry</span>
                        <svg style="width:18px; height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </span>
                    <span class="spinner" id="spinner"></span>
                </button>

                <p style="text-align:center; font-size:13px; color:#9ca3af; margin:0; display:flex; align-items:center; justify-content:center; gap:6px;">
                    <svg style="width:15px; height:15px; color:#10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span>Your information is safe. We never share your data.</span>
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
                Frequently Asked Questions
            </h2>
            <p style="color:#6b7280; font-size:16px; margin:0;">
                Quick answers to common questions about ShopSphere
            </p>
        </div>

        <div style="display:flex; flex-direction:column; gap:12px;" id="faqContainer">

            <div class="faq-item" onclick="toggleFaq(this)">
                <button class="faq-btn">
                    <span>How do I return an order?</span>
                    <svg class="faq-icon" style="width:20px; height:20px; color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer">
                    Log in to your account and go to the "My Orders" section to initiate a return request. Return pickup is scheduled within 2–3 business days.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFaq(this)">
                <button class="faq-btn">
                    <span>My payment failed — what should I do?</span>
                    <svg class="faq-icon" style="width:20px; height:20px; color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer">
                    If an amount was deducted for a failed payment, it will be automatically refunded to your original payment method within 5–7 business days. If you still need help, please submit an inquiry above.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFaq(this)">
                <button class="faq-btn">
                    <span>When is MLM referral commission credited?</span>
                    <svg class="faq-icon" style="width:20px; height:20px; color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer">
                    Referral commissions are credited to your dashboard wallet within 24 hours of a confirmed qualifying purchase. You can withdraw once your balance reaches the minimum threshold of ₹500.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFaq(this)">
                <button class="faq-btn">
                    <span>How long does it take to receive a response?</span>
                    <svg class="faq-icon" style="width:20px; height:20px; color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer">
                    We typically reply within <strong>24 hours</strong>. For urgent queries, please call us directly at +91 98765 43210.
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
                <div style="font-size:20px; font-weight:800; color:#ffffff; margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                    <svg style="width:24px; height:24px; color:#6366f1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span>ShopSphere</span>
                </div>
                <p style="font-size:14px; line-height:1.7; margin:0;">
                    Your trusted online shopping destination. Premium products, best prices.
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
                    <p style="margin:0 0 8px; display:flex; align-items:center; gap:8px;">
                        <svg style="width:16px; height:16px; color:#818cf8; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        support@shopsphere.com
                    </p>
                    <p style="margin:0 0 8px; display:flex; align-items:center; gap:8px;">
                        <svg style="width:16px; height:16px; color:#34d399; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        +91 98765 43210
                    </p>
                    <p style="margin:0; display:flex; align-items:center; gap:8px;">
                        <svg style="width:16px; height:16px; color:#fb923c; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Mon–Sat: 9 AM – 7 PM IST
                    </p>
                </div>
            </div>

        </div>

        <div style="border-top:1px solid #374151; padding-top:24px; text-align:center; font-size:13px; display:flex; align-items:center; justify-content:center; gap:6px;">
            <span>© {{ date('Y') }} ShopSphere. All rights reserved.</span>
            <span>&nbsp;|&nbsp; Crafted with care in India</span>
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