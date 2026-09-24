@extends('seller.layouts.app')

@section('title', 'Earnings & Payouts')

@section('content')

<!-- Header -->
<div style="margin-bottom:24px;">
    <h2 style="font-size:22px;font-weight:800;color:#111827;margin:0 0 4px;">💰 Earnings & Payouts</h2>
    <p style="font-size:14px;color:#6b7280;margin:0;">Track your revenue, commissions and payout history</p>
</div>

<!-- Stats -->
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:28px;">
    @foreach([
        ['Total Gross Sales','💰','₹'.number_format($grossSales??0,2),'#4f46e5','#eef2ff'],
        ['Net Earnings','📈','₹'.number_format($netEarnings??0,2),'#059669','#ecfdf5'],
        ['Pending Settlement','⏳','₹'.number_format($pendingEarnings??0,2),'#d97706','#fffbeb'],
        ['Settled Earnings','✅','₹'.number_format($settledEarnings??0,2),'#7c3aed','#f5f3ff'],
    ] as $s)
        <div style="background:#fff;border-radius:18px;padding:22px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <div style="width:46px;height:46px;border-radius:14px;background:{{ $s[4] }};display:flex;align-items:center;justify-content:center;font-size:22px;margin-bottom:14px;">{{ $s[1] }}</div>
            <p style="font-size:12px;font-weight:600;color:#9ca3af;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 6px;">{{ $s[0] }}</p>
            <p style="font-size:22px;font-weight:800;color:{{ $s[3] }};margin:0;">{{ $s[2] }}</p>
        </div>
    @endforeach
</div>

<!-- Payout Info + Performance -->
<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;margin-bottom:24px;">

    <!-- Commission Breakdown Info -->
    <div style="background:#fff;border-radius:18px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
        <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 20px;">📊 How Earnings Work</h3>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            @foreach([
                ['Order Subtotal','Full item price × quantity','#4f46e5','#eef2ff','💳'],
                ['Commission Deducted','MLM & platform referral fee','#ef4444','#fef2f2','📉'],
                ['Net Seller Earning','What you actually receive','#059669','#ecfdf5','💵'],
                ['Settlement Cycle','Every Monday, 7-day cycle','#d97706','#fffbeb','📅'],
            ] as $info)
            <div style="background:{{ $info[3] }};border-radius:14px;padding:18px;">
                <div style="font-size:24px;margin-bottom:10px;">{{ $info[4] }}</div>
                <p style="font-size:13px;font-weight:700;color:{{ $info[2] }};margin:0 0 4px;">{{ $info[0] }}</p>
                <p style="font-size:12px;color:#6b7280;margin:0;">{{ $info[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Payout Account -->
    <div style="display:flex;flex-direction:column;gap:20px;">
        <div style="background:linear-gradient(135deg,#4f46e5,#7c3aed);border-radius:18px;padding:24px;">
            <h3 style="font-size:15px;font-weight:700;color:#fff;margin:0 0 16px;">🏦 Payout Account</h3>
            @php $seller = auth()->user()->seller; @endphp
            @if($seller?->bank_account_number)
                <div style="display:flex;flex-direction:column;gap:8px;font-size:13px;">
                    <div style="display:flex;justify-content:space-between;"><span style="color:rgba(255,255,255,0.7);">Bank</span><span style="color:#fff;font-weight:600;">{{ $seller->bank_name ?? '—' }}</span></div>
                    <div style="display:flex;justify-content:space-between;"><span style="color:rgba(255,255,255,0.7);">Account</span><span style="color:#fff;font-weight:600;">••••{{ substr($seller->bank_account_number,-4) }}</span></div>
                    <div style="display:flex;justify-content:space-between;"><span style="color:rgba(255,255,255,0.7);">IFSC</span><span style="color:#fff;font-weight:600;">{{ $seller->bank_ifsc ?? '—' }}</span></div>
                    <div style="display:flex;justify-content:space-between;"><span style="color:rgba(255,255,255,0.7);">Holder</span><span style="color:#fff;font-weight:600;">{{ $seller->bank_account_holder ?? '—' }}</span></div>
                </div>
                <div style="margin-top:16px;font-size:12px;color:rgba(255,255,255,0.6);">Payouts every Monday · 7-day settlement cycle</div>
            @else
                <p style="color:rgba(255,255,255,0.8);font-size:13px;margin:0 0 14px;">No bank account linked yet.</p>
                <a href="{{ route('seller.profile') }}" style="display:inline-block;padding:10px 20px;background:rgba(255,255,255,0.2);color:#fff;border-radius:10px;font-size:13px;font-weight:600;text-decoration:none;">➕ Add Bank Account</a>
            @endif
        </div>

        <!-- Quick Stats -->
        <div style="background:#fff;border-radius:18px;padding:22px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <h3 style="font-size:15px;font-weight:700;color:#111827;margin:0 0 14px;">📦 Summary</h3>
            <div style="display:flex;flex-direction:column;gap:10px;font-size:13px;">
                <div style="display:flex;justify-content:space-between;padding-bottom:8px;border-bottom:1px solid #f3f4f6;"><span style="color:#6b7280;">Total Transactions</span><span style="font-weight:700;color:#111827;">{{ $earningsHistory->total() ?? 0 }}</span></div>
                <div style="display:flex;justify-content:space-between;padding-bottom:8px;border-bottom:1px solid #f3f4f6;"><span style="color:#6b7280;">Gross Revenue</span><span style="font-weight:700;color:#4f46e5;">₹{{ number_format($grossSales??0,2) }}</span></div>
                <div style="display:flex;justify-content:space-between;"><span style="color:#6b7280;">Total Commissions</span><span style="font-weight:700;color:#ef4444;">₹{{ number_format($totalCommission??0,2) }}</span></div>
            </div>
        </div>
    </div>
</div>

<!-- Transaction History Table -->
<div style="background:#fff;border-radius:18px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
    <div style="padding:20px 24px;border-bottom:1px solid #f3f4f6;">
        <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0;">📋 Transaction History</h3>
    </div>
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:#f9fafb;border-bottom:1px solid #e5e7eb;">
                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Order / Item</th>
                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Date</th>
                <th style="padding:12px 20px;text-align:right;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Subtotal</th>
                <th style="padding:12px 20px;text-align:right;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Commission</th>
                <th style="padding:12px 20px;text-align:right;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Net Earning</th>
                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($earningsHistory as $item)
                @php
                    $sc=['pending'=>['#d97706','#fffbeb'],'processing'=>['#2563eb','#eff6ff'],'shipped'=>['#7c3aed','#f5f3ff'],'delivered'=>['#059669','#ecfdf5'],'cancelled'=>['#ef4444','#fef2f2']];
                    $c=$sc[$item->status??'pending']??['#9ca3af','#f3f4f6'];
                @endphp
                <tr style="border-bottom:1px solid #f3f4f6;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">
                    <td style="padding:14px 20px;">
                        <a href="{{ route('seller.orders.show', $item->id) }}" style="font-size:14px;font-weight:700;color:#4f46e5;text-decoration:none;">#{{ $item->order?->order_number ?? 'ORD-'.$item->order_id }}</a>
                        <p style="font-size:12px;color:#6b7280;margin:2px 0 0;max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $item->product_name ?? '—' }}</p>
                    </td>
                    <td style="padding:14px 20px;font-size:13px;color:#6b7280;">{{ $item->created_at->format('d M Y') }}</td>
                    <td style="padding:14px 20px;text-align:right;font-size:14px;font-weight:700;color:#111827;">₹{{ number_format($item->subtotal??0,2) }}</td>
                    <td style="padding:14px 20px;text-align:right;font-size:13px;font-weight:600;color:#ef4444;">
                        {{ $item->commission_amount ? '−₹'.number_format($item->commission_amount,2) : '—' }}
                    </td>
                    <td style="padding:14px 20px;text-align:right;font-size:14px;font-weight:700;color:#059669;">₹{{ number_format($item->seller_earning??$item->subtotal??0,2) }}</td>
                    <td style="padding:14px 20px;text-align:center;">
                        <span style="font-size:12px;font-weight:600;color:{{ $c[0] }};background:{{ $c[1] }};padding:4px 12px;border-radius:50px;text-transform:capitalize;">{{ $item->status ?? 'pending' }}</span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" style="padding:60px;text-align:center;">
                    <div style="font-size:48px;margin-bottom:14px;">💸</div>
                    <p style="font-size:15px;font-weight:700;color:#111827;margin:0 0 6px;">No transactions yet</p>
                    <p style="font-size:13px;color:#6b7280;margin:0;">Your earnings will appear here as orders come in.</p>
                </td></tr>
            @endforelse
        </tbody>
    </table>
    @if($earningsHistory->hasPages())
        <div style="padding:20px 24px;border-top:1px solid #f3f4f6;">{{ $earningsHistory->withQueryString()->links() }}</div>
    @endif
</div>

@endsection
