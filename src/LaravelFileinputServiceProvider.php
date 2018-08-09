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
        //引入fileinput资源
        $viewPath = realpath(__DIR__ . ' /../resources/views/');
        $this->loadViewsFrom($viewPath, 'Fileinput');

        //发布fileinput资源 / 配置文件 / 视图文件
        $this->publishes([
            __DIR__ . '/../vendor/kartik-v/bootstrap-fileinput/' => public_path('/vendor/laravel-fileinput'),
            __DIR__ . '/../config' => config_path(),
        ], 'laravel-fileinput');

        //fileinput语言
        //根据fileinput配置文件 取得 local
        $locale = config('fileinput.locale');
        $file = '/vendor/laravel-fileinput/js/locales/' . $locale . '.js';
        $filePath = public_path() . $file;
        if (!\File::exists($filePath)) {
            //Default is zh-cn
            $file = '/vendor/laravel-fileinput/js/locales/zh.js';
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

    public function provides()
    {
        return ['fileinput'];
    }
}
