<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_product(): void
    {
        $admin = User::factory()->admin()->create();
        $category = \App\Models\Category::factory()->create();

        $this->actingAs($admin)->postJson('/api/products', [
            'name' => 'Test Product',
            'price' => 100,
            'stock' => 10,
            'category_id' => $category->id,
        ])->assertStatus(201);
    }

    // Add index with filters, update, delete tests
}