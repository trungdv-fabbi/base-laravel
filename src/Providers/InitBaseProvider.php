<?php

namespace TrungDV\BaseLaravel\Providers;

use Illuminate\Support\ServiceProvider;

class InitBaseProvider extends ServiceProvider
{
    public array $commands = [
        \TrungDV\BaseLaravel\Console\Commands\MakeBase::class,
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register Helper as singleton
        $this->app->bind('base-laravel', function() {
            return new \TrungDV\BaseLaravel\Helper();
        });

        // merge config
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/base-laravel.php', 'base-laravel'
        );

        // register commands
        $this->commands($this->commands);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // publish config
        $this->publishes([
            __DIR__.'/../Config/base-laravel.php' => config_path('base-laravel.php'),
        ], 'base-laravel-config');
        //
    }
}
