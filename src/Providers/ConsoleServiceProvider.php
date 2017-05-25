<?php

namespace Xcms\Themes\Providers;

use Illuminate\Support\ServiceProvider;
use Xcms\Themes\Console\Commands\MakeThemeCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->commands([
            MakeThemeCommand::class
        ]);
    }
}