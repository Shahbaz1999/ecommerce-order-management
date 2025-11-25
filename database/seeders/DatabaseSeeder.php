<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory(2)->admin()->create();
        \App\Models\User::factory(10)->create(); // customers
        \App\Models\Category::factory(5)->create();
        \App\Models\Product::factory(20)->create();
        \App\Models\Cart::factory(10)->create();
        \App\Models\Order::factory(15)->create()->each(function ($order) {
        \App\Models\OrderItem::factory(fake()->numberBetween(1, 5))->create(['order_id' => $order->id]);
        });
    }
}