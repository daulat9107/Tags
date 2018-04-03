<?php

namespace Daulat\Taggy\Providers;

use Illuminate\Support\ServiceProvider;

class TaggyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
       $this->loadMigrationsFrom(__DIR__ . '/../../migrations');
       $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
       $this->loadViewsFrom(__DIR__.'/../Views', 'taggy');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
