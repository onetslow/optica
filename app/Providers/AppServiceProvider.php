<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('pagination::default');

        Gate::define('destroy-product', function (User $user, Product $product) {
            return $user->is_admin || $product->price < 1000;
        });

        Gate::define('view-order', function (User $user, Order $order) {
            return $user->is_admin || $user->id === $order->user_id;
        });

        Gate::define('manage-products', function (User $user) {
            return $user->is_admin;
        });
        
    }
}
