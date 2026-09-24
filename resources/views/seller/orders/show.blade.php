@extends('seller.layouts.app')

@section('title', 'Order Item #' . $orderItem->id)

@section('content')

<!-- Header -->
<div style="display:flex;align-items:center;gap:14px;margin-bottom:28px;flex-wrap:wrap;">
    <a href="{{ route('seller.orders.index') }}" style="width:40px;height:40px;border-radius:12px;background:#fff;border:2px solid #e5e7eb;display:flex;align-items:center;justify-content:center;font-size:18px;text-decoration:none;color:#374151;">←</a>
    <div style="flex:1;">
        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
            <h2 style="font-size:22px;font-weight:800;color:#111827;margin:0;">Order #{{ $orderItem->order?->order_number ?? 'ORD-'.$orderItem->order_id }}</h2>
            @php $sc=['pending'=>['#d97706','#fffbeb'],'processing'=>['#2563eb','#eff6ff'],'shipped'=>['#7c3aed','#f5f3ff'],'delivered'=>['#059669','#ecfdf5'],'cancelled'=>['#ef4444','#fef2f2']];$c=$sc[$orderItem->status??'pending']??['#9ca3af','#f3f4f6']; @endphp
            <span style="font-size:13px;font-weight:700;color:{{ $c[0] }};background:{{ $c[1] }};padding:5px 14px;border-radius:50px;text-transform:capitalize;">● {{ $orderItem->status ?? 'pending' }}</span>
        </div>
        <p style="font-size:14px;color:#6b7280;margin:4px 0 0;">Placed on {{ $orderItem->created_at->format('d F Y, h:i A') }}</p>
    </div>
</div>

@if(session('success'))
    <div style="background:#ecfdf5;border:1px solid #6ee7b7;border-radius:12px;padding:14px 18px;margin-bottom:20px;font-size:14px;color:#065f46;">✅ {{ session('success') }}</div>
@endif

<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;">

    <!-- Left Column -->
    <div style="display:flex;flex-direction:column;gap:20px;">

        <!-- Order Item Details -->
        <div style="background:#fff;border-radius:18px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 18px;">📦 Order Item</h3>
            <div style="display:flex;gap:16px;align-items:flex-start;">
                <div style="width:90px;height:90px;border-radius:14px;overflow:hidden;flex-shrink:0;background:#f3f4f6;">
                    @if($orderItem->product?->featured_image)
                        <img src="{{ Storage::url($orderItem->product->featured_image) }}" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:36px;">📦</div>
                    @endif
                </div>
                <div style="flex:1;">
                    <h4 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 8px;">{{ $orderItem->product_name ?? $orderItem->product?->name ?? '—' }}</h4>
                    @if($orderItem->variation_details ?? $orderItem->variation)
                        <p style="font-size:13px;color:#6b7280;margin:0 0 6px;">
                            Variation: {{ is_string($orderItem->variation_details) ? $orderItem->variation_details : ($orderItem->variation?->name ?? '') }}
                        </p>
                    @endif
                    <div style="display:flex;gap:20px;margin-top:10px;">
                        <div><p style="font-size:11px;color:#9ca3af;text-transform:uppercase;font-weight:600;margin:0 0 3px;">Unit Price</p><p style="font-size:15px;font-weight:700;color:#111827;margin:0;">₹{{ number_format($orderItem->unit_price ?? $orderItem->price ?? 0, 2) }}</p></div>
                        <div><p style="font-size:11px;color:#9ca3af;text-transform:uppercase;font-weight:600;margin:0 0 3px;">Quantity</p><p style="font-size:15px;font-weight:700;color:#111827;margin:0;">{{ $orderItem->quantity }}</p></div>
                        <div><p style="font-size:11px;color:#9ca3af;text-transform:uppercase;font-weight:600;margin:0 0 3px;">Subtotal</p><p style="font-size:15px;font-weight:700;color:#4f46e5;margin:0;">₹{{ number_format($orderItem->subtotal ?? 0, 2) }}</p></div>
                    </div>
                </div>
            </div>

            <!-- Earnings Breakdown -->
            <div style="background:#f9fafb;border-radius:14px;padding:18px;margin-top:20px;">
                <p style="font-size:13px;font-weight:700;color:#374151;margin:0 0 12px;">💰 Earnings Breakdown</p>
                <div style="display:flex;flex-direction:column;gap:8px;font-size:13px;">
                    <div style="display:flex;justify-content:space-between;"><span style="color:#6b7280;">Item Subtotal</span><span style="font-weight:600;">₹{{ number_format($orderItem->subtotal??0,2) }}</span></div>
                    @if($orderItem->commission_amount)
                        <div style="display:flex;justify-content:space-between;"><span style="color:#6b7280;">Platform Commission</span><span style="font-weight:600;color:#ef4444;">−₹{{ number_format($orderItem->commission_amount,2) }}</span></div>
                    @endif
                    <div style="display:flex;justify-content:space-between;padding-top:8px;border-top:1px solid #e5e7eb;"><span style="font-weight:700;color:#111827;">Your Net Earning</span><span style="font-weight:800;color:#059669;font-size:14px;">₹{{ number_format($orderItem->seller_earning??$orderItem->subtotal??0,2) }}</span></div>
                </div>
            </div>
        </div>

        <!-- Update Status -->
        @if(!in_array($orderItem->status, ['delivered','cancelled']))
        <div style="background:#fff;border-radius:18px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 18px;">⚡ Update Fulfillment Status</h3>
            <form method="POST" action="{{ route('seller.orders.update-status', $orderItem->id) }}" style="display:flex;gap:12px;flex-wrap:wrap;align-items:flex-end;">
                @csrf
                <div style="flex:1;min-width:180px;">
                    <label style="font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:6px;">New Status</label>
                    <select name="status" style="width:100%;padding:11px 16px;border:2px solid #e5e7eb;border-radius:11px;font-size:14px;outline:none;font-family:inherit;background:#fafafa;" required>
                        <option value="">— Select Status —</option>
                        @foreach(['processing'=>'⚙️ Processing','shipped'=>'🚚 Shipped','delivered'=>'✅ Delivered','cancelled'=>'❌ Cancelled'] as $v=>$l)
                            @if($orderItem->status !== $v)
                                <option value="{{ $v }}">{{ $l }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div style="flex:1;min-width:180px;">
                    <label style="font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:6px;">Tracking Number</label>
                    <input type="text" name="tracking_number" value="{{ $orderItem->tracking_number ?? '' }}" placeholder="Enter tracking ID"
                        style="width:100%;padding:11px 16px;border:2px solid #e5e7eb;border-radius:11px;font-size:14px;outline:none;font-family:inherit;background:#fafafa;box-sizing:border-box;"
                        onfocus="this.style.borderColor='#4f46e5'" onblur="this.style.borderColor='#e5e7eb'">
                </div>
                <div style="flex:1;min-width:140px;">
                    <label style="font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:6px;">Shipping Carrier</label>
                    <input type="text" name="shipping_carrier" value="{{ $orderItem->shipping_carrier ?? '' }}" placeholder="e.g. Bluedart"
                        style="width:100%;padding:11px 16px;border:2px solid #e5e7eb;border-radius:11px;font-size:14px;outline:none;font-family:inherit;background:#fafafa;box-sizing:border-box;"
                        onfocus="this.style.borderColor='#4f46e5'" onblur="this.style.borderColor='#e5e7eb'">
                </div>
                <button type="submit" style="padding:12px 24px;background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;border:none;border-radius:11px;font-size:14px;font-weight:700;cursor:pointer;font-family:inherit;">Update →</button>
            </form>
        </div>
        @endif
    </div>

    <!-- Right Column -->
    <div style="display:flex;flex-direction:column;gap:20px;">

        <!-- Customer Info -->
        <div style="background:#fff;border-radius:18px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <h3 style="font-size:15px;font-weight:700;color:#111827;margin:0 0 16px;">👤 Customer</h3>
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
                <div style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,#4f46e5,#7c3aed);display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;font-weight:700;flex-shrink:0;">
                    {{ strtoupper(substr($orderItem->order?->user?->name ?? 'C', 0, 1)) }}
                </div>
                <div>
                    <p style="font-size:14px;font-weight:700;color:#111827;margin:0;">{{ $orderItem->order?->user?->name ?? '—' }}</p>
                    <p style="font-size:12px;color:#6b7280;margin:0;">{{ $orderItem->order?->user?->email ?? '' }}</p>
                </div>
            </div>
            <div style="background:#f9fafb;border-radius:12px;padding:12px;font-size:13px;color:#374151;">
                📱 {{ $orderItem->order?->user?->phone ?? 'Phone not provided' }}
            </div>
        </div>

        <!-- Shipping Address -->
        <div style="background:#fff;border-radius:18px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <h3 style="font-size:15px;font-weight:700;color:#111827;margin:0 0 16px;">📍 Shipping Address</h3>
            @php $order = $orderItem->order; @endphp
            <div style="font-size:13px;color:#374151;line-height:1.8;">
                <p style="margin:0;font-weight:600;">{{ $order?->shipping_name ?? $order?->user?->name ?? '—' }}</p>
                <p style="margin:0;">{{ $order?->shipping_address ?? '—' }}</p>
                @if($order?->shipping_city)
                    <p style="margin:0;">{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_pincode }}</p>
                @endif
                @if($order?->shipping_phone)
                    <p style="margin:4px 0 0;color:#6b7280;">📱 {{ $order->shipping_phone }}</p>
                @endif
            </div>
        </div>

        <!-- Tracking -->
        @if($orderItem->tracking_number)
        <div style="background:#fff;border-radius:18px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <h3 style="font-size:15px;font-weight:700;color:#111827;margin:0 0 14px;">🚚 Tracking</h3>
            <div style="font-size:13px;">
                <p style="color:#6b7280;margin:0 0 4px;font-size:11px;text-transform:uppercase;font-weight:600;">Tracking Number</p>
                <p style="font-size:15px;font-weight:700;color:#4f46e5;margin:0 0 10px;">{{ $orderItem->tracking_number }}</p>
                @if($orderItem->shipping_carrier)
                    <p style="color:#6b7280;margin:0 0 4px;font-size:11px;text-transform:uppercase;font-weight:600;">Carrier</p>
                    <p style="font-weight:600;color:#111827;margin:0;">{{ $orderItem->shipping_carrier }}</p>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
