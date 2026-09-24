<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerOrderController extends Controller
{
    /**
     * Display a listing of orders containing items belonging to the seller.
     */
    public function index(Request $request)
    {
        $seller = Auth::user()->seller;

        $query = OrderItem::with(['order.user', 'product', 'variation'])
            ->where('seller_id', $seller->id);

        // Status Filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search by Order Number or Product Name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('order', function ($oq) use ($search) {
                    $oq->where('order_number', 'like', "%{$search}%")
                       ->orWhere('shipping_name', 'like', "%{$search}%");
                })->orWhere('product_name', 'like', "%{$search}%");
            });
        }

        $orderItems = $query->latest()->paginate(12)->withQueryString();

        // Counts for status tabs
        $counts = [
            'all'        => OrderItem::where('seller_id', $seller->id)->count(),
            'pending'    => OrderItem::where('seller_id', $seller->id)->where('status', 'pending')->count(),
            'processing' => OrderItem::where('seller_id', $seller->id)->where('status', 'processing')->count(),
            'shipped'    => OrderItem::where('seller_id', $seller->id)->where('status', 'shipped')->count(),
            'delivered'  => OrderItem::where('seller_id', $seller->id)->where('status', 'delivered')->count(),
            'cancelled'  => OrderItem::where('seller_id', $seller->id)->where('status', 'cancelled')->count(),
        ];

        return view('seller.orders.index', compact('orderItems', 'counts', 'seller'));
    }

    /**
     * Display details of a specific seller order item.
     */
    public function show($id)
    {
        $seller = Auth::user()->seller;

        $orderItem = OrderItem::with(['order.user', 'product.images', 'variation'])
            ->where('seller_id', $seller->id)
            ->where('id', $id)
            ->firstOrFail();

        return view('seller.orders.show', compact('orderItem', 'seller'));
    }

    /**
     * Update the fulfillment status of a seller order item.
     */
    public function updateStatus(Request $request, $id)
    {
        $seller = Auth::user()->seller;

        $orderItem = OrderItem::where('seller_id', $seller->id)
            ->where('id', $id)
            ->firstOrFail();

        $validated = $request->validate([
            'status'           => 'required|in:pending,processing,shipped,delivered,cancelled',
            'tracking_number'  => 'nullable|string|max:100',
            'shipping_carrier' => 'nullable|string|max:100',
        ]);

        $orderItem->update([
            'status'           => $validated['status'],
            'tracking_number'  => $validated['tracking_number'] ?? $orderItem->tracking_number,
            'shipping_carrier' => $validated['shipping_carrier'] ?? $orderItem->shipping_carrier,
        ]);

        // If all items in the parent order are shipped/delivered, update parent order status
        $parentOrder = $orderItem->order;
        $totalItemsCount = $parentOrder->items()->count();
        $deliveredCount = $parentOrder->items()->where('status', 'delivered')->count();
        $shippedCount = $parentOrder->items()->where('status', 'shipped')->count();

        if ($deliveredCount === $totalItemsCount) {
            $parentOrder->update(['order_status' => 'delivered']);
        } elseif ($shippedCount + $deliveredCount === $totalItemsCount) {
            $parentOrder->update(['order_status' => 'shipped']);
        } elseif ($validated['status'] === 'processing') {
            $parentOrder->update(['order_status' => 'processing']);
        }

        return back()->with('success', 'Order item fulfillment status updated to ' . ucfirst($validated['status']) . '!');
    }
}
