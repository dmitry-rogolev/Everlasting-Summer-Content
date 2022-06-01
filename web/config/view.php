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
    #       КОНФИГУРАЦИЯ ТЕМЫ ШАБЛОНА       #
    #########################################

    // Имя темы по умолчанию
    "theme_default" => env("THEME_DEFAULT", "light"), 

    // Корневая папка для тем (относительно папки public/)
    "theme_directory" => env("THEME_DIRECTORY", "css/theme"), 


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

    // Ссылка на шрифт
    "font" => env("HEAD_FONT", "https://fonts.googleapis.com/css?family=Ubuntu"), 

    // Корневая папка для CSS (относительно public/)
    "css_directory" => env("HEAD_CSS_DIRECTORY", "css"), 

    // Имя CSS всего приложения
    "css_app" => env("HEAD_CSS_DIRECTORY", "css") . "/" . env("HEAD_CSS_APP", "app") . ".css", 

    // Ссылка на Bootstrap CSS
    "css_bs" => env("HEAD_CSS_BS", "https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"), 

    // Integrity Bootstrap CSS
    "css_bs_integrity" => env("HEAD_BS_CSS_INTEGRITY", "sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn"),

    // Ссылка на jQuery
    "jq" => env("HEAD_JQ", "https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"), 

    // Integrity jQuery
    "jq_integrity" => env("HEAD_JQ_INTEGRITY", "sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"), 

    // Ссылка на Bootstrap JS
    "js_bs" => env("HEAD_JS_BS", "https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"), 
    
    // Integrity Bootstrap JS
    "js_bs_integrity" => env("HEAD_JS_BS_INTEGRITY", "sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"),
    
];
