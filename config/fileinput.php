<?php
return [
    'default_language' => 'zh',
    'route' => [
        'group' => [
            'middleware' => [],
            'namespace' => 'App\Http\Controllers',
        ],
        'action' => '\App\Http\Controllers\FileinputController@upload',
        'name' => 'fileinput.name',
    ],
];