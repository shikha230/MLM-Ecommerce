@extends('seller.layouts.app')

@section('title', 'Orders')

@section('content')

<!-- Header -->
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
    <div>
        <h2 style="font-size:22px;font-weight:800;color:#111827;margin:0 0 4px;">📋 Order Management</h2>
        <p style="font-size:14px;color:#6b7280;margin:0;">Manage and fulfil your store orders</p>
    </div>
    <div style="display:flex;gap:8px;flex-wrap:wrap;">
        @php
            $statuses = ['all'=>'All','pending'=>'Pending','processing'=>'Processing','shipped'=>'Shipped','delivered'=>'Delivered','cancelled'=>'Cancelled'];
            $colors = ['pending'=>['#d97706','#fffbeb'],'processing'=>['#2563eb','#eff6ff'],'shipped'=>['#7c3aed','#f5f3ff'],'delivered'=>['#059669','#ecfdf5'],'cancelled'=>['#ef4444','#fef2f2'],'all'=>['#4f46e5','#eef2ff']];
            $currentStatus = request('status','all');
        @endphp
        @foreach($statuses as $st => $label)
            @php $active = $currentStatus === $st || ($st === 'all' && !request('status')); @endphp
            <a href="{{ route('seller.orders.index', $st !== 'all' ? ['status'=>$st] : []) }}"
                style="padding:8px 16px;border-radius:50px;font-size:13px;font-weight:600;text-decoration:none;
                       color:{{ $active ? ($colors[$st][0]??'#4f46e5') : '#6b7280' }};
                       background:{{ $active ? ($colors[$st][1]??'#eef2ff') : '#f3f4f6' }};
                       border:1px solid {{ $active ? ($colors[$st][0]??'#4f46e5') : 'transparent' }};">
                {{ $label }}
                @if(isset($counts[$st])) <span style="font-size:11px;margin-left:4px;">({{ $counts[$st] }})</span> @endif
            </a>
        @endforeach
    </div>
</div>

@if(session('success'))
    <div style="background:#ecfdf5;border:1px solid #6ee7b7;border-radius:12px;padding:14px 18px;margin-bottom:20px;font-size:14px;color:#065f46;">✅ {{ session('success') }}</div>
@endif

<!-- Stats Row -->
<div style="display:grid;grid-template-columns:repeat(5,1fr);gap:14px;margin-bottom:24px;">
    @foreach([
        ['Pending','📥',$counts['pending']??0,'#d97706','#fffbeb'],
        ['Processing','⚙️',$counts['processing']??0,'#2563eb','#eff6ff'],
        ['Shipped','🚚',$counts['shipped']??0,'#7c3aed','#f5f3ff'],
        ['Delivered','✅',$counts['delivered']??0,'#059669','#ecfdf5'],
        ['Cancelled','❌',$counts['cancelled']??0,'#ef4444','#fef2f2'],
    ] as $s)
        <div style="background:#fff;border-radius:14px;padding:16px;text-align:center;box-shadow:0 2px 8px rgba(0,0,0,0.05);border:1px solid #f3f4f6;">
            <div style="font-size:24px;margin-bottom:6px;">{{ $s[1] }}</div>
            <p style="font-size:22px;font-weight:800;color:{{ $s[3] }};margin:0 0 2px;">{{ $s[2] }}</p>
            <p style="font-size:12px;color:#9ca3af;font-weight:500;margin:0;">{{ $s[0] }}</p>
        </div>
    @endforeach
</div>

<!-- Search -->
<div style="background:#fff;border-radius:14px;padding:16px 20px;margin-bottom:20px;box-shadow:0 2px 8px rgba(0,0,0,0.05);border:1px solid #f3f4f6;">
    <form method="GET" style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
        @if(request('status'))<input type="hidden" name="status" value="{{ request('status') }}">@endif
        <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Search by order number or product name..."
            style="flex:1;min-width:240px;padding:10px 16px;border:2px solid #e5e7eb;border-radius:10px;font-size:14px;outline:none;font-family:inherit;"
            onfocus="this.style.borderColor='#4f46e5'" onblur="this.style.borderColor='#e5e7eb'">
        <button type="submit" style="padding:10px 22px;background:#4f46e5;color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;font-family:inherit;">Search</button>
        @if(request('search'))
            <a href="{{ route('seller.orders.index',['status'=>request('status')]) }}" style="padding:10px 18px;background:#f3f4f6;color:#374151;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;">Clear</a>
        @endif
    </form>
</div>

<!-- Order Items Table -->
<div style="background:#fff;border-radius:18px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:#f9fafb;border-bottom:2px solid #e5e7eb;">
                <th style="padding:14px 20px;text-align:left;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Order / Item</th>
                <th style="padding:14px 20px;text-align:left;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Customer</th>
                <th style="padding:14px 20px;text-align:center;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Qty</th>
                <th style="padding:14px 20px;text-align:right;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Amount</th>
                <th style="padding:14px 20px;text-align:center;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Status</th>
                <th style="padding:14px 20px;text-align:left;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Date</th>
                <th style="padding:14px 20px;text-align:center;font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orderItems as $item)
                @php
                    $sc=['pending'=>['#d97706','#fffbeb'],'processing'=>['#2563eb','#eff6ff'],'shipped'=>['#7c3aed','#f5f3ff'],'delivered'=>['#059669','#ecfdf5'],'cancelled'=>['#ef4444','#fef2f2']];
                    $c=$sc[$item->status??'pending']??['#9ca3af','#f3f4f6'];
                @endphp
                <tr style="border-bottom:1px solid #f3f4f6;transition:background 0.15s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">
                    <td style="padding:14px 20px;">
                        <p style="font-size:14px;font-weight:700;color:#111827;margin:0;">#{{ $item->order?->order_number ?? 'ORD-'.$item->order_id }}</p>
                        <p style="font-size:12px;color:#6b7280;margin:0;max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $item->product_name ?? $item->product?->name ?? '—' }}</p>
                    </td>
                    <td style="padding:14px 20px;">
                        <p style="font-size:14px;font-weight:600;color:#111827;margin:0;">{{ $item->order?->user?->name ?? '—' }}</p>
                        <p style="font-size:12px;color:#6b7280;margin:0;">{{ $item->order?->user?->email ?? '' }}</p>
                    </td>
                    <td style="padding:14px 20px;text-align:center;font-size:14px;font-weight:600;color:#374151;">{{ $item->quantity }}</td>
                    <td style="padding:14px 20px;text-align:right;font-size:14px;font-weight:700;color:#111827;">₹{{ number_format($item->subtotal ?? 0, 2) }}</td>
                    <td style="padding:14px 20px;text-align:center;">
                        <span style="font-size:12px;font-weight:600;color:{{ $c[0] }};background:{{ $c[1] }};padding:4px 12px;border-radius:50px;text-transform:capitalize;">{{ $item->status ?? 'pending' }}</span>
                    </td>
                    <td style="padding:14px 20px;font-size:13px;color:#6b7280;">{{ $item->created_at->format('d M Y') }}<br><span style="font-size:11px;">{{ $item->created_at->format('h:i A') }}</span></td>
                    <td style="padding:14px 20px;text-align:center;">
                        <a href="{{ route('seller.orders.show', $item->id) }}" style="display:inline-flex;align-items:center;gap:5px;padding:7px 16px;background:#eef2ff;color:#4f46e5;border-radius:9px;font-size:13px;font-weight:600;text-decoration:none;">👁 View</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" style="padding:60px;text-align:center;">
                    <div style="font-size:56px;margin-bottom:16px;">📭</div>
                    <p style="font-size:16px;font-weight:700;color:#111827;margin:0 0 6px;">No orders found</p>
                    <p style="font-size:14px;color:#6b7280;margin:0;">Orders will appear here once customers start purchasing.</p>
                </td></tr>
            @endforelse
        </tbody>
    </table>

    @if($orderItems->hasPages())
        <div style="padding:20px 24px;border-top:1px solid #f3f4f6;">{{ $orderItems->withQueryString()->links() }}</div>
    @endif
</div>

@endsection
