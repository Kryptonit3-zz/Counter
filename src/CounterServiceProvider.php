<?php

namespace Kryptonit3\Counter;

use Illuminate\Support\ServiceProvider;

class CounterServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function register()
    {
        $this->app->bindShared('counter', function() {
            return $this->app->make('Kryptonit3\Counter\Counter');
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/migrations/' => base_path('/database/migrations')
        ], 'migrations');
    }

    public function provides()
    {
        return ['counter'];
    }
}
