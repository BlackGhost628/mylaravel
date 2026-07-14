<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class CartServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cart = Session::get('cart', []);
            $cartCount = 0;
            
            foreach ($cart as $item) {
                $cartCount += $item['quantity'];
            }
            
            $view->with('cartCount', $cartCount);
        });
    }
}