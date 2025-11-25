<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_order_from_cart()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['price' => 100, 'stock' => 10]);

        Cart::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2
        ]);

        $service = app(OrderService::class);
        $order = $service->createFromCart($user); // ← FIXED: correct method name

        $this->assertEquals(200, $order->total_amount);
        $this->assertEquals(8, $product->fresh()->stock);
        $this->assertDatabaseCount('carts', 0);
        $this->assertDatabaseCount('orders', 1);
        $this->assertDatabaseCount('order_items', 1);
    }
}