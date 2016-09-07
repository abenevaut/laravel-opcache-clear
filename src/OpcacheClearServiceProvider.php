<?php

namespace MicheleCurletta\LaravelOPCacheClear;

use Illuminate\Support\ServiceProvider;

class OPCacheClearServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';
        $this->app->make('MicheleCurletta\LaravelOPCacheClear\OPCacheClearController');

        $this->app->bind('command.opcache:clear', OPCacheClearCommand::class);

        $this->commands([
            'command.opcache:clear',
        ]);
    }
}
