<?php

namespace Luerdog\LaravelFileinput;

use Illuminate\Support\ServiceProvider;

class LaravelFileinputServiceProvider extends ServiceProvider
{
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
        ], 'laravel-fileinput');

        //定义多语言
        //根据fileinput配置文件 取得 local
        $locale = config('fileinput.locale');
        $file = "/vendor/laravel-fileinput/js/locales/$locale.js";
        $filePath = public_path() . $file;

        if (!\File::exists($filePath)) {
            //Default is zh-cn
            $file = "/vendor/laravel-fileinput/js/locales/zh.js";
        }
        \View::share('LaravelFileinputLangFile', $file);
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
}
