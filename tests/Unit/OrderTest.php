<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_place_order(): void
    {
        $customer = User::factory()->create();
        $product = Product::factory()->create(['stock' => 10]);
        Cart::factory()->create(['user_id' => $customer->id, 'product_id' => $product->id, 'quantity' => 2]);

        $this->actingAs($customer)->postJson('/api/orders')->assertStatus(201);

        $this->assertDatabaseHas('orders', ['user_id' => $customer->id]);
        $this->assertEquals(8, $product->fresh()->stock);
    }

    // Add stock insufficient test (422)
}