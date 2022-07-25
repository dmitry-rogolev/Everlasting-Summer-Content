<?php

use Illuminate\Support\Collection;

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => [
        resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),


    #########################################
    #       КОНФИГУРАЦИЯ HEAD ШАБЛОНА       #
    #########################################

    // Заголовок страницы
    "title" => env("HEAD_TITLE", "Everlasting Summer Content"), 

    // Кодировка страницы
    "charset" => env("HEAD_CHARSET", "utf-8"), 

    // viewport
    "viewport" => env("HEAD_VIEWPORT", "width=device-width, initial-scale=1.0, shrink-to-fit=no"), 

    // Ключевые слова страницы
    "keywords" => env("HEAD_KEYWORDS"), 

    // Описание страницы
    "description" => env("HEAD_DESCRIPTION", ""), 

    // автор страницы
    "author" => env("HEAD_AUTHOR", ""), 

    // Индексирование страницы
    "robots" => env("HEAD_ROBOTS", "all"), 

    // имя фавикона
    "favicon" => env("HEAD_FAVICON", "favicon.ico"), 

    // Корневая папка для CSS (относительно public/)
    "css_directory" => env("HEAD_CSS_DIRECTORY", "css"), 

    // Имя CSS всего приложения
    "css_app" => env("HEAD_CSS_DIRECTORY", "css") . "/" . env("HEAD_CSS_APP", "app") . ".css", 

    // Корневая папка для JS (относительно public/)
    "js_directory" => env("HEAD_JS_DIRECTORY", "js"), 
    
    // Имя JS всего приложения
    "js_app" => env("HEAD_JS_DIRECTORY", "js") . "/" . env("HEAD_JS_APP", "app") . ".js", 

    "bs_css" => env("HEAD_BS_CSS", "https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"), 

    "bs_js" => env("HEAD_BS_JS", "https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"), 

    "jquery" => env("HEAD_JQUERY", "https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"), 

    #############################################
    #   КОНФИГУРАЦИЯ ИДЕНТИФИКАТОРОВ ШАБЛОНА    #
    #############################################

    // Префикс идентификатора
    "id_prefix" => env("ID_PREFIX", "id_"), 

    // Длина идентификатора без префикса
    "id_length" => env("ID_LENGTH", 40), 


    #############################################
    #          КОНФИГУРАЦИЯ СОРТИРОВКИ          #
    #############################################

    "sort" => [

        "default" => env("SORT_DEFAULT", "asc"), 

        "all" => [ "asc", "desc" ], 

    ], 
];
