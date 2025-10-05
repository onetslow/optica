<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use App\Models\Product;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Paginator::defaultView('pagination::bootstrap-4');

        Gate::define('destroy-item', function (User $user, Product $products) {
            return $user->is_admin || $products->price < 1000;
        });

        Gate::define('create-category', function (User $user) {
            return true;
        });
    }
}
