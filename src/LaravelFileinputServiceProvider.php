<?php

namespace Luerdog\LaravelFileinput;

use Illuminate\Support\ServiceProvider;

class LaravelFileinputServiceProvider extends ServiceProvider
{
    //延时加载
    protected $defer = true;

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
        $this->app->singleton('fileinput', function () {
            return new LaravelFileinput();
        });
    }

    public function provides()
    {
        return ['fileinput'];
    }
}
