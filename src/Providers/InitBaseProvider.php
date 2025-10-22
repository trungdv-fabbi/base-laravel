<?php

namespace Trungdv\Initbase\Providers;

use Illuminate\Support\ServiceProvider;

class InitBaseProvider extends ServiceProvider
{
    public array $commands = [
        \Trungdv\Initbase\Console\Commands\MakeBase::class,
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
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
