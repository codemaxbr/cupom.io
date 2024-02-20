<?php
namespace CodemaxBR\Vindi\Providers;

use Illuminate\Support\ServiceProvider;
use CodemaxBR\Vindi\Vindi;

class VindiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Views', 'vindi');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/../config/vindi.php', 'vindi');

        $this->publishes([
            __DIR__ . '/../config/vindi.php' => config_path('vindi.php'),
        ]);
    }

    public function register()
    {
        $this->app->bind('CodemaxBR\Vindi', function(){
            return new Vindi(config()->get('vindi.api_key'), config()->get('vindi.env'));
        });
    }
}