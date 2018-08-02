<?php

namespace Luerdog\Fileinput;

use Illuminate\Support\ServiceProvider;

class FileinputServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //载入视图
        $viewPath = realpath(__DIR__ . '/../resources/views');
        $this->loadViewsFrom($viewPath, 'Fileinput');

        //发布视图模版
        $this->publishes([
            realpath(__DIR__ . '/../resources/views') => base_path('resources/views/vendor/Fileinput'),
        ], 'laravel-fileinput-view');

        //定义多语言
        //根据系统配置 取得 local
        $locale = strtolower(config('app.locale'));
        $file = "/laravel-fileinput/js/locales/$locale.js";
        $filePath = public_path() . $file;

        if (!\File::exists($filePath)) {
            //Default is zh-cn
            $file = "/laravel-fileinput/js/locales/zh.js";
        }
        \View::share('FileinputLangFile', $file);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //发布fileinput资源
        $this->publishes([
            realpath(__DIR__ . '/../../../kartik-v/bootstrap-fileinput') => public_path() . '/laravel-fileinput',
        ], 'laravel-fileinput-assets');
    }
}
