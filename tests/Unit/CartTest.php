<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_add_to_cart(): void
    {
        $customer = User::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($customer)->postJson('/api/cart', [
            'product_id' => $product->id,
            'quantity' => 2,
        ])->assertStatus(201);

        $this->assertDatabaseHas('carts', ['user_id' => $customer->id, 'product_id' => $product->id]);
    }

   
}