<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        return $request->user()->orders()->with('items.product')->latest()->get();
    }

    public function store(Request $request)
    {
        $order = $this->orderService->createFromCart($request->user()); // ← correct method name

        return response()->json($order, 201); // ← return 201
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:confirmed,shipped,delivered,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return $order;
    }
}