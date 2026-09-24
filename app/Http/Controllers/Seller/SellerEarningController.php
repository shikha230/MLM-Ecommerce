<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerEarningController extends Controller
{
    /**
     * Display seller sales, commissions, and earnings breakdown.
     */
    public function index(Request $request)
    {
        $seller = Auth::user()->seller;

        $itemsQuery = OrderItem::with('order')
            ->where('seller_id', $seller->id);

        $grossSales = (clone $itemsQuery)->sum('subtotal');
        $totalCommission = (clone $itemsQuery)->sum('commission_amount');
        $netEarnings = (clone $itemsQuery)->sum('seller_earning');

        // Delivered / Settled Earnings
        $settledEarnings = (clone $itemsQuery)->where('status', 'delivered')->sum('seller_earning');
        // Pending Settlement (e.g. Processing, Shipped)
        $pendingEarnings = (clone $itemsQuery)->whereIn('status', ['pending', 'processing', 'shipped'])->sum('seller_earning');

        // Paginated transactions/order items
        $earningsHistory = $itemsQuery->latest()->paginate(15);

        return view('seller.earnings.index', compact(
            'seller',
            'grossSales',
            'totalCommission',
            'netEarnings',
            'settledEarnings',
            'pendingEarnings',
            'earningsHistory'
        ));
    }
}
