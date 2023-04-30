<?php

namespace Md\Wcart;
use Illuminate\Session\SessionManager;
use Illuminate\Support\ServiceProvider;


class CartServiceProvider extends ServiceProvider{
     public function register(): void
    {
        //
        $this->app->bind('cart', 'Md\Wcart\Cart');
        $config = __DIR__ . '/../config/cart.php';
        $this->mergeConfigFrom($config, 'cart');

        $this->publishes([__DIR__ . '/../config/cart.php' => config_path('cart.php')], 'config');
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}