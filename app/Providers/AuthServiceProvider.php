<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::define('admin-only', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('customer-only', function (User $user) {
            return $user->role === 'customer';
        });
    }
}