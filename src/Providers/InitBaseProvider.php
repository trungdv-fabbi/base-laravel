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
            __DIR__ . '/../Config/base.php', 'base'
        );
        // register commands
        $this->commands($this->commands);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
