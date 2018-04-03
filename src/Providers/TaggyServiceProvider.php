<?php

namespace Daulat\Taggy\Providers;

use Daulat\Taggy\Traits\Spam\Service\AkismetSpamService;
use Daulat\Taggy\Traits\Spam\Service\SpamServiceInterface;
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
        $this->app->singleton(SpamServiceInterface::class,function($app){
            return new AkismetSpamService(new \GuzzleHttp\Client);
        });
    }
}
