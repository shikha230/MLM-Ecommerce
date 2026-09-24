<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSeller
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('seller.login')->with('error', 'Please log in to access the Seller Portal.');
        }

        $user = auth()->user();

        if ($user->role !== 'seller' && $user->role !== 'admin') {
            return redirect()->route('seller.register')->with('warning', 'You need a registered seller account to access this area.');
        }

        // Check if seller profile exists; if not, create default profile or prompt
        $seller = $user->seller;
        if (!$seller && $user->role === 'seller') {
            return redirect()->route('seller.register')->with('warning', 'Please complete your seller registration.');
        }

        if ($seller && $seller->status === 'suspended') {
            auth()->logout();
            return redirect()->route('seller.login')->with('error', 'Your seller account has been suspended. Please contact support.');
        }

        return $next($request);
    }
}
