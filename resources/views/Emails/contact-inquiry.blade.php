<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Inquiry - ShopSphere</title>
</head>
<body style="margin:0; padding:0; background-color:#f0f4ff; font-family:'Segoe UI', Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0f4ff; padding:40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px; width:100%;">

                    {{-- ====== HEADER ====== --}}
                    <tr>
                        <td style="
                            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
                            border-radius:16px 16px 0 0;
                            padding:40px 40px 30px;
                            text-align:center;
                        ">
                            <div style="
                                display:inline-block;
                                background:rgba(255,255,255,0.15);
                                border-radius:50%;
                                width:64px;
                                height:64px;
                                line-height:64px;
                                font-size:28px;
                                margin-bottom:16px;
                            ">📬</div>
                            <h1 style="
                                color:#ffffff;
                                margin:0;
                                font-size:26px;
                                font-weight:700;
                                letter-spacing:-0.5px;
                            ">New Contact Inquiry</h1>
                            <p style="
                                color:rgba(255,255,255,0.8);
                                margin:8px 0 0;
                                font-size:14px;
                            ">ShopSphere Support Dashboard</p>
                        </td>
                    </tr>

                    {{-- ====== BODY ====== --}}
                    <tr>
                        <td style="
                            background:#ffffff;
                            padding:40px;
                            border-left:1px solid #e5e7eb;
                            border-right:1px solid #e5e7eb;
                        ">
                            <p style="color:#374151; font-size:15px; margin:0 0 24px; line-height:1.6;">
                                🙋 Ek nayi customer inquiry aayi hai. Neeche details hain:
                            </p>

                            {{-- Detail Table --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">

                                <tr>
                                    <td style="padding:14px 16px; background:#f9fafb; border-radius:8px 8px 0 0; border-bottom:1px solid #e5e7eb;">
                                        <span style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px;">👤 Naam</span><br>
                                        <span style="font-size:16px; color:#111827; font-weight:600; margin-top:4px; display:block;">{{ $inquiry->name }}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:14px 16px; background:#ffffff; border-bottom:1px solid #e5e7eb;">
                                        <span style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px;">📧 Email</span><br>
                                        <a href="mailto:{{ $inquiry->email }}" style="font-size:15px; color:#4f46e5; text-decoration:none; font-weight:500; margin-top:4px; display:block;">{{ $inquiry->email }}</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:14px 16px; background:#f9fafb; border-bottom:1px solid #e5e7eb;">
                                        <span style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px;">📞 Phone</span><br>
                                        <span style="font-size:15px; color:#111827; font-weight:500; margin-top:4px; display:block;">{{ $inquiry->phone ?? '—' }}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:14px 16px; background:#ffffff; border-bottom:1px solid #e5e7eb;">
                                        <span style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px;">📌 Subject</span><br>
                                        <span style="font-size:16px; color:#111827; font-weight:700; margin-top:4px; display:block;">{{ $inquiry->subject }}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:14px 16px; background:#f9fafb; border-radius:0 0 8px 8px;">
                                        <span style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px;">💬 Message</span><br>
                                        <div style="
                                            margin-top:10px;
                                            background:#ffffff;
                                            border:1px solid #e5e7eb;
                                            border-left:4px solid #4f46e5;
                                            border-radius:6px;
                                            padding:16px;
                                            font-size:15px;
                                            color:#374151;
                                            line-height:1.7;
                                        ">{{ $inquiry->message }}</div>
                                    </td>
                                </tr>

                            </table>

                            {{-- Timestamp --}}
                            <div style="
                                margin-top:28px;
                                padding:16px 20px;
                                background:linear-gradient(135deg,#eff6ff,#f0f4ff);
                                border-radius:10px;
                                border:1px solid #dbeafe;
                                text-align:center;
                            ">
                                <span style="font-size:13px; color:#6b7280;">⏰ Submitted on: </span>
                                <strong style="color:#4f46e5; font-size:14px;">{{ $inquiry->created_at->format('d M Y, h:i A') }}</strong>
                            </div>

                            {{-- CTA --}}
                            <div style="margin-top:28px; text-align:center;">
                                <a href="mailto:{{ $inquiry->email }}"
                                   style="
                                       display:inline-block;
                                       background:linear-gradient(135deg,#4f46e5,#7c3aed);
                                       color:#ffffff;
                                       text-decoration:none;
                                       padding:14px 36px;
                                       border-radius:50px;
                                       font-size:15px;
                                       font-weight:600;
                                       letter-spacing:0.3px;
                                ">Reply to Customer ✉️</a>
                            </div>

                        </td>
                    </tr>

                    {{-- ====== FOOTER ====== --}}
                    <tr>
                        <td style="
                            background:#1f2937;
                            border-radius:0 0 16px 16px;
                            padding:24px 40px;
                            text-align:center;
                        ">
                            <p style="color:#9ca3af; font-size:13px; margin:0 0 6px;">
                                <strong style="color:#ffffff;">ShopSphere</strong> &mdash; Admin Notification System
                            </p>
                            <p style="color:#6b7280; font-size:12px; margin:0;">
                                Yeh email automatically generate hui hai. Please reply mat kijiye is email par.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>