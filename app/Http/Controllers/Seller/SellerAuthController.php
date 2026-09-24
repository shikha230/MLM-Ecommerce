<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SellerAuthController extends Controller
{
    /**
     * Show the seller registration form.
     */
    public function showRegister()
    {
        if (Auth::check() && Auth::user()->role === 'seller') {
            return redirect()->route('seller.dashboard');
        }

        return redirect()->route('register', ['type' => 'seller']);
    }

    /**
     * Handle seller registration request.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            // Owner Account Info
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|max:255|unique:users,email',
            'phone'                 => 'required|string|max:20',
            'password'              => 'required|string|min:8|confirmed',
            
            // Store & Business Info
            'store_name'            => 'required|string|max:255|unique:sellers,store_name',
            'store_phone'           => 'nullable|string|max:20',
            'store_email'           => 'nullable|email|max:255',
            'store_description'     => 'nullable|string|max:1000',
            'address'               => 'nullable|string|max:255',
            'city'                  => 'nullable|string|max:100',
            'state'                 => 'nullable|string|max:100',
            'pincode'               => 'nullable|string|max:20',
            'gst_number'            => 'nullable|string|max:50',
            'pan_number'            => 'nullable|string|max:50',

            // Bank Details
            'bank_name'             => 'nullable|string|max:100',
            'bank_account_holder'   => 'nullable|string|max:150',
            'bank_account_number'   => 'nullable|string|max:50',
            'bank_ifsc'             => 'nullable|string|max:20',
        ]);

        DB::beginTransaction();
        try {
            // 1. Create User with role 'seller'
            $user = User::create([
                'name'          => $validated['name'],
                'email'         => $validated['email'],
                'phone'         => $validated['phone'],
                'password'      => Hash::make($validated['password']),
                'role'          => 'seller',
                'referral_code' => 'SELLER_' . strtoupper(Str::random(6)),
            ]);

            // 2. Create Seller Profile
            $storeSlug = Str::slug($validated['store_name']);
            if (Seller::where('store_slug', $storeSlug)->exists()) {
                $storeSlug .= '-' . Str::random(4);
            }

            $seller = Seller::create([
                'user_id'             => $user->id,
                'store_name'          => $validated['store_name'],
                'store_slug'          => $storeSlug,
                'store_phone'         => $validated['store_phone'] ?? $validated['phone'],
                'store_email'         => $validated['store_email'] ?? $validated['email'],
                'store_description'   => $validated['store_description'] ?? null,
                'address'             => $validated['address'] ?? null,
                'city'                => $validated['city'] ?? null,
                'state'               => $validated['state'] ?? null,
                'pincode'             => $validated['pincode'] ?? null,
                'gst_number'          => $validated['gst_number'] ?? null,
                'pan_number'          => $validated['pan_number'] ?? null,
                'bank_name'           => $validated['bank_name'] ?? null,
                'bank_account_holder' => $validated['bank_account_holder'] ?? $validated['name'],
                'bank_account_number' => $validated['bank_account_number'] ?? null,
                'bank_ifsc'           => $validated['bank_ifsc'] ?? null,
                'status'              => 'approved',
                'rating'              => 5.00,
            ]);

            DB::commit();

            return redirect()->route('login')
                ->with('success', 'Seller registration successful! Your store "' . $seller->store_name . '" has been created. Please sign in to access your Seller Central dashboard.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }

    /**
     * Show the seller login form.
     */
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->role === 'seller') {
            return redirect()->route('seller.dashboard');
        }

        return view('seller.auth.login');
    }

    /**
     * Handle seller login attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            if ($user->role !== 'seller' && $user->role !== 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'This account is registered as a customer, not a seller. Please sign in to the customer portal or register as a seller.',
                ])->onlyInput('email');
            }

            $seller = $user->seller;
            if ($seller && $seller->status === 'suspended') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your seller account has been suspended. Please contact support.',
                ]);
            }

            $request->session()->regenerate();

            return redirect()->intended(route('seller.dashboard'))
                ->with('success', 'Welcome back, ' . ($seller?->store_name ?? $user->name) . '!');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }

    /**
     * Logout seller.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('seller.login')
            ->with('success', 'You have been successfully logged out of Seller Central.');
    }
}
