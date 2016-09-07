<?php

namespace MicheleCurletta\LaravelOpcacheClear;

use Illuminate\Support\ServiceProvider;

class OpcacheClearServiceProvider extends ServiceProvider
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
        $this->app->make('MicheleCurletta\LaravelOpcacheClear\OpcacheClearController');

        $this->app->bind('command.opcache:clear', OpcacheClearCommand::class);

        $this->commands([
            'command.opcache:clear',
        ]);
    }
}
