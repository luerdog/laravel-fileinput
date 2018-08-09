<?php

namespace Luerdog\LaravelFileinput\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelFileinput extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'fileinput';
    }
}