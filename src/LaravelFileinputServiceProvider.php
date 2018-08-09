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
        $viewPath = realpath(__DIR__ . '/../resources/views');
        $this->loadViewsFrom($viewPath, 'Fileinput');

        $this->publishes([
            realpath(__DIR__ . '/../vendor/kartik-v/bootstrap-fileinput/') => public_path('vendor/laravel-fileinput'),
            realpath(__DIR__ . '/../config/') => config_path(),
        ], 'laravel-fileinput');

        //定义多语言
        //根据fileinput配置文件 取得 local
        $locale = config('fileinput.locale');
        $file = "/vendor/laravel-fileinput/js/locales/$locale.js";
        $filePath = public_path() . $file;

        if (!\File::exists($filePath)) {
            //Default is zh
            $file = "/vendor/laravel-fileinput/js/locales/zh.js";
        }
        \View::share('LaravelFileinputLangFile', $file);


        //定义路由
        $router = app('router');
        //need add auth
        $group = config('fileinput.route.group', []);

        $router->group($group, function ($router) {
            $router->any('/laravel-fileinput/server', config('fileinput.route.action'))
                ->name(config('fileinput.route.name'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //绑定单例
        $this->app->singleton('fileinput', function () {
            return new LaravelFileinput();
        });
    }

    public function provides()
    {
        return ['fileinput'];
    }
}
