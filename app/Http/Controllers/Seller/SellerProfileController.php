<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SellerProfileController extends Controller
{
    /**
     * Show seller store and profile settings.
     */
    public function show()
    {
        $seller = Auth::user()->seller;
        return view('seller.profile.index', compact('seller'));
    }

    /**
     * Update seller profile and settings.
     */
    public function update(Request $request)
    {
        $seller = Auth::user()->seller;

        $validated = $request->validate([
            'store_name'          => 'required|string|max:255|unique:sellers,store_name,' . $seller->id,
            'store_phone'         => 'nullable|string|max:20',
            'store_email'         => 'nullable|email|max:255',
            'store_description'   => 'nullable|string|max:1000',
            'address'             => 'nullable|string|max:255',
            'city'                => 'nullable|string|max:100',
            'state'               => 'nullable|string|max:100',
            'pincode'             => 'nullable|string|max:20',
            'gst_number'          => 'nullable|string|max:50',
            'pan_number'          => 'nullable|string|max:50',

            // Bank details
            'bank_name'           => 'nullable|string|max:100',
            'bank_account_holder' => 'nullable|string|max:150',
            'bank_account_number' => 'nullable|string|max:50',
            'bank_ifsc'           => 'nullable|string|max:20',

            // Media
            'store_logo'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'store_banner'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        if ($request->hasFile('store_logo')) {
            if ($seller->store_logo) {
                Storage::disk('public')->delete($seller->store_logo);
            }
            $validated['store_logo'] = $request->file('store_logo')->store('sellers/logos', 'public');
        }

        if ($request->hasFile('store_banner')) {
            if ($seller->store_banner) {
                Storage::disk('public')->delete($seller->store_banner);
            }
            $validated['store_banner'] = $request->file('store_banner')->store('sellers/banners', 'public');
        }

        $seller->update($validated);

        return back()->with('success', 'Store profile and payout details have been updated successfully!');
    }
}
