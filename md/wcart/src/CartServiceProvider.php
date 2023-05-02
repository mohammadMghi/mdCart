<?php

namespace Md\Wcart;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;


class CartServiceProvider extends ServiceProvider{
     public function register(): void
    {
        //
        $this->app->bind('cart', 'Md\Wcart\Cart');
        $config = __DIR__ . '/../config/cart.php';
        $this->mergeConfigFrom($config, 'cart');

        $this->publishes([__DIR__ . '/../config/cart.php' => config_path('cart.php')], 'config');

        if ( ! class_exists('CreateShoppingcartTable')) {
            // Publish the migration
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__.'/../database/migrations/0000_00_00_000000_create_shoppingcart_table.php' => database_path('migrations/'.$timestamp.'_create_shoppingcart_table.php'),
            ], 'migrations');
        }
 
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}