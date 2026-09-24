@extends('seller.layouts.app')

@section('title', 'Seller Dashboard')

@section('content')

<!-- Stats Row -->
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:28px;">
    @php
        $stats = [
            ['icon'=>'💰','label'=>'Total Revenue','value'=>'₹'.number_format($totalSales ?? 0, 2),'color'=>'#4f46e5','bg'=>'#eef2ff'],
            ['icon'=>'📦','label'=>'Total Orders','value'=>$totalOrdersCount ?? 0,'color'=>'#059669','bg'=>'#ecfdf5'],
            ['icon'=>'🛍️','label'=>'Active Products','value'=>$activeProducts ?? 0,'color'=>'#d97706','bg'=>'#fffbeb'],
            ['icon'=>'💵','label'=>'Net Earnings','value'=>'₹'.number_format($totalEarnings ?? 0, 2),'color'=>'#7c3aed','bg'=>'#f5f3ff'],
        ];
    @endphp
    @foreach($stats as $s)
        <div style="background:#fff;border-radius:18px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;transition:box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 8px 30px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='0 2px 12px rgba(0,0,0,0.06)'">
            <div style="width:48px;height:48px;border-radius:14px;background:{{ $s['bg'] }};display:flex;align-items:center;justify-content:center;font-size:22px;margin-bottom:16px;">{{ $s['icon'] }}</div>
            <p style="font-size:12px;font-weight:600;color:#9ca3af;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 6px;">{{ $s['label'] }}</p>
            <p style="font-size:24px;font-weight:800;color:{{ $s['color'] }};margin:0;">{{ $s['value'] }}</p>
        </div>
    @endforeach
</div>

<!-- Main Grid -->
<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;margin-bottom:24px;">

    <!-- Recent Order Items -->
    <div style="background:#fff;border-radius:18px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
            <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0;">📋 Recent Orders</h3>
            <a href="{{ route('seller.orders.index') }}" style="font-size:13px;color:#4f46e5;font-weight:600;text-decoration:none;">View All →</a>
        </div>

        @forelse($recentOrderItems ?? [] as $item)
            @php
                $sc=['pending'=>['#fbbf24','#fffbeb'],'processing'=>['#60a5fa','#eff6ff'],'shipped'=>['#a78bfa','#f5f3ff'],'delivered'=>['#34d399','#ecfdf5'],'cancelled'=>['#f87171','#fef2f2']];
                $c=$sc[$item->status??'pending']??['#9ca3af','#f3f4f6'];
            @endphp
            <div style="display:flex;align-items:center;gap:14px;padding:14px 0;border-bottom:1px solid #f3f4f6;">
                <div style="width:44px;height:44px;border-radius:12px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">📦</div>
                <div style="flex:1;min-width:0;">
                    <p style="font-size:14px;font-weight:600;color:#111827;margin:0 0 3px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $item->product_name ?? $item->product?->name ?? 'Product' }}</p>
                    <p style="font-size:12px;color:#6b7280;margin:0;">{{ $item->order?->user?->name ?? 'Customer' }} • {{ $item->created_at->diffForHumans() }}</p>
                </div>
                <div style="text-align:right;">
                    <p style="font-size:14px;font-weight:700;color:#111827;margin:0 0 4px;">₹{{ number_format($item->subtotal ?? 0, 2) }}</p>
                    <span style="font-size:11px;font-weight:600;color:{{ $c[0] }};background:{{ $c[1] }};padding:3px 10px;border-radius:50px;text-transform:capitalize;">{{ $item->status ?? 'pending' }}</span>
                </div>
            </div>
        @empty
            <div style="text-align:center;padding:40px 20px;">
                <div style="font-size:48px;margin-bottom:12px;">📭</div>
                <p style="font-size:14px;color:#6b7280;margin:0;">No orders yet. Start selling to see orders here.</p>
            </div>
        @endforelse
    </div>

    <!-- Quick Actions + Low Stock -->
    <div style="display:flex;flex-direction:column;gap:20px;">

        <!-- Quick Actions -->
        <div style="background:linear-gradient(135deg,#4f46e5,#7c3aed);border-radius:18px;padding:24px;">
            <h3 style="font-size:15px;font-weight:700;color:#fff;margin:0 0 16px;">⚡ Quick Actions</h3>
            <div style="display:flex;flex-direction:column;gap:10px;">
                <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:10px;background:rgba(255,255,255,0.22);border-radius:12px;padding:12px 16px;text-decoration:none;backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,0.3);transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.35)'" onmouseout="this.style.background='rgba(255,255,255,0.22)'">
                    <span style="font-size:18px;">🌐</span>
                    <span style="color:#fff;font-size:14px;font-weight:700;">Go to Website / Storefront</span>
                    <span style="color:rgba(255,255,255,0.9);margin-left:auto;font-size:13px;font-weight:600;">&rarr;</span>
                </a>
                <a href="{{ route('seller.products.create') }}" style="display:flex;align-items:center;gap:10px;background:rgba(255,255,255,0.15);border-radius:12px;padding:12px 16px;text-decoration:none;backdrop-filter:blur(8px);" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                    <span>➕</span><span style="color:#fff;font-size:14px;font-weight:600;">Add New Product</span>
                </a>
                <a href="{{ route('seller.orders.index') }}" style="display:flex;align-items:center;gap:10px;background:rgba(255,255,255,0.15);border-radius:12px;padding:12px 16px;text-decoration:none;backdrop-filter:blur(8px);" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                    <span>📋</span><span style="color:#fff;font-size:14px;font-weight:600;">Manage Orders</span>
                </a>
                <a href="{{ route('seller.profile') }}" style="display:flex;align-items:center;gap:10px;background:rgba(255,255,255,0.15);border-radius:12px;padding:12px 16px;text-decoration:none;backdrop-filter:blur(8px);" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                    <span>⚙️</span><span style="color:#fff;font-size:14px;font-weight:600;">Store Settings</span>
                </a>
                <a href="{{ route('seller.earnings') }}" style="display:flex;align-items:center;gap:10px;background:rgba(255,255,255,0.15);border-radius:12px;padding:12px 16px;text-decoration:none;backdrop-filter:blur(8px);" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                    <span>💰</span><span style="color:#fff;font-size:14px;font-weight:600;">View Earnings</span>
                </a>
            </div>
        </div>

        <!-- Alerts -->
        <div style="background:#fff;border-radius:18px;padding:22px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
            <h3 style="font-size:15px;font-weight:700;color:#111827;margin:0 0 14px;">🔔 Alerts</h3>
            <div style="display:flex;flex-direction:column;gap:10px;">
                @if(($pendingFulfillmentCount ?? 0) > 0)
                    <div style="display:flex;align-items:center;gap:10px;background:#fffbeb;border-radius:12px;padding:12px;">
                        <span style="font-size:18px;">⏳</span>
                        <span style="font-size:13px;font-weight:600;color:#92400e;">{{ $pendingFulfillmentCount }} orders awaiting fulfillment</span>
                    </div>
                @endif
                @if(($lowStockCount ?? 0) > 0)
                    <div style="display:flex;align-items:center;gap:10px;background:#fef2f2;border-radius:12px;padding:12px;">
                        <span style="font-size:18px;">⚠️</span>
                        <span style="font-size:13px;font-weight:600;color:#991b1b;">{{ $lowStockCount }} products low on stock</span>
                    </div>
                @endif
                @if(($pendingFulfillmentCount ?? 0) == 0 && ($lowStockCount ?? 0) == 0)
                    <div style="text-align:center;padding:12px;font-size:13px;color:#059669;">✅ All good! No alerts.</div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Bottom Row -->
<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">

    <!-- Top Products -->
    <div style="background:#fff;border-radius:18px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
            <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0;">🏆 Top Products</h3>
            <a href="{{ route('seller.products.index') }}" style="font-size:13px;color:#4f46e5;font-weight:600;text-decoration:none;">View All →</a>
        </div>
        @forelse($topProducts ?? [] as $idx => $product)
            <div style="display:flex;align-items:center;gap:12px;padding:10px 0;{{ !$loop->last ? 'border-bottom:1px solid #f3f4f6;' : '' }}">
                <span style="font-size:16px;font-weight:800;color:#9ca3af;width:24px;text-align:center;">{{ $idx+1 }}</span>
                <div style="width:40px;height:40px;border-radius:10px;background:#f3f4f6;overflow:hidden;flex-shrink:0;">
                    @if($product->featured_image)
                        <img src="{{ Storage::url($product->featured_image) }}" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:18px;">📦</div>
                    @endif
                </div>
                <div style="flex:1;min-width:0;">
                    <p style="font-size:13px;font-weight:600;color:#111827;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $product->name }}</p>
                    <p style="font-size:12px;color:#6b7280;margin:0;">{{ $product->total_sold ?? 0 }} units sold</p>
                </div>
                <span style="font-size:13px;font-weight:700;color:#059669;">₹{{ number_format($product->price,2) }}</span>
            </div>
        @empty
            <div style="text-align:center;padding:24px;font-size:13px;color:#6b7280;">No products added yet.</div>
        @endforelse
    </div>

    <!-- Store Info Summary -->
    <div style="background:#fff;border-radius:18px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #f3f4f6;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
            <h3 style="font-size:16px;font-weight:700;color:#111827;margin:0;">🏪 Your Store</h3>
            <a href="{{ route('seller.profile') }}" style="font-size:13px;color:#4f46e5;font-weight:600;text-decoration:none;">Edit Profile →</a>
        </div>
        <div style="text-align:center;margin-bottom:20px;">
            <div style="width:72px;height:72px;border-radius:50%;background:linear-gradient(135deg,#4f46e5,#7c3aed);display:flex;align-items:center;justify-content:center;font-size:32px;margin:0 auto 10px;">🏪</div>
            <h4 style="font-size:18px;font-weight:800;color:#111827;margin:0 0 4px;">{{ $seller->store_name ?? auth()->user()->name }}</h4>
            <p style="font-size:13px;color:#6b7280;margin:0;">{{ $seller->city ?? '' }}{{ $seller->state ? ', '.$seller->state : '' }}</p>
        </div>
        <div style="display:flex;flex-direction:column;gap:10px;">
            @foreach([
                ['📧','Email',auth()->user()->email],
                ['📱','Phone',auth()->user()->phone ?? '—'],
                ['🏭','GST',$seller->gst_number ?? '—'],
                ['📅','Member Since',auth()->user()->created_at->format('M d, Y')],
            ] as $row)
            <div style="display:flex;align-items:center;gap:10px;font-size:13px;">
                <span style="font-size:15px;">{{ $row[0] }}</span>
                <span style="color:#6b7280;font-weight:500;min-width:80px;">{{ $row[1] }}:</span>
                <span style="color:#111827;font-weight:600;">{{ $row[2] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
