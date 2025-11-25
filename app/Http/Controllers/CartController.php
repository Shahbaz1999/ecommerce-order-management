<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->cart()->with('product')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'product_id' => $request->product_id
            ],
            ['quantity' => $request->quantity]
        );

        return $cart->load('product');
    }

    public function update(Request $request, Cart $cart)
    {
        $this->authorizeCart($cart);

        $request->validate(['quantity' => 'required|integer|min:1']);

        $cart->update(['quantity' => $request->quantity]);

        return $cart->load('product');
    }

    public function destroy(Cart $cart)
    {
        $this->authorizeCart($cart);
        $cart->delete();

        return response()->json(null, 204);
    }

    protected function authorizeCart($cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}