<?php

namespace Yormy\CoreToolsLaravel;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class CoreToolsLaravelServiceProvider extends ServiceProvider
{
    const CONFIG_FILE = __DIR__.'/../config/core-tools-laravel.php';

    public function boot(Router $router): void
    {
        $this->publish();
    }

    public function register(): void
    {
        $this->mergeConfigFrom(static::CONFIG_FILE, 'core-tools-laravel');
    }

    private function publish(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                self::CONFIG_FILE => config_path('core-tools-laravel.php'),
            ], 'config');
        }
    }
}
