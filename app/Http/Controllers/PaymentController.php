<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Mock payment - always success
        $payment = Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total_amount,
            'status' => 'success'
        ]);

        $order->update(['status' => 'confirmed']);

        return response()->json([
            'message' => 'Payment successful',
            'payment' => $payment,
            'order' => $order
        ], 201);
    }
}