<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellerDashboardController extends Controller
{
    /**
     * Display seller dashboard overview with key metrics.
     */
    public function index()
    {
        $seller = Auth::user()->seller;

        if (!$seller) {
            return redirect()->route('seller.register')->with('warning', 'Please complete your store setup.');
        }

        // Summary Metrics
        $totalProducts = Product::where('seller_id', $seller->id)->count();
        $activeProducts = Product::where('seller_id', $seller->id)->where('is_active', true)->count();
        $lowStockCount = Product::where('seller_id', $seller->id)->where('stock', '<=', 5)->count();

        // Orders & Financials
        $sellerOrderItems = OrderItem::where('seller_id', $seller->id);
        $totalSales = (clone $sellerOrderItems)->sum('subtotal');
        $totalEarnings = (clone $sellerOrderItems)->sum('seller_earning');
        $totalOrdersCount = (clone $sellerOrderItems)->distinct('order_id')->count('order_id');
        $pendingFulfillmentCount = (clone $sellerOrderItems)->whereIn('status', ['pending', 'processing'])->count();

        // Recent 6 Order Items
        $recentOrderItems = OrderItem::with(['order.user', 'product'])
            ->where('seller_id', $seller->id)
            ->latest()
            ->take(6)
            ->get();

        // Top Selling Products
        $topProducts = Product::where('seller_id', $seller->id)
            ->withCount(['orderItems as total_sold' => function ($query) {
                $query->select(DB::raw('COALESCE(SUM(quantity), 0)'));
            }])
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        return view('seller.dashboard', compact(
            'seller',
            'totalProducts',
            'activeProducts',
            'lowStockCount',
            'totalSales',
            'totalEarnings',
            'totalOrdersCount',
            'pendingFulfillmentCount',
            'recentOrderItems',
            'topProducts'
        ));
    }
}
