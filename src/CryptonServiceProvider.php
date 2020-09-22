<?php

namespace Tzsk\Crypton;

use Illuminate\Support\ServiceProvider;
use Tzsk\Crypton\Commands\CryptonPublishCommand;

class CryptonServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/crypton.php' => config_path('crypton.php'),
            ], 'crypton-config');

            $this->commands([
                CryptonPublishCommand::class,
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/crypton.php', 'crypton');
    }
}
