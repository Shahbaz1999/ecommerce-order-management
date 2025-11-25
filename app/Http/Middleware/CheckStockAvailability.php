<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckStockAvailability
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        foreach ($user->cart as $item) {
            if ($item->quantity > $item->product->stock) {
                return response()->json([
                    'message' => 'Insufficient stock for: ' . $item->product->name
                ], 422);
            }
        }

        return $next($request);
    }
}