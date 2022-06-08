<?php

return [

    #########################################
    #       КОНФИГУРАЦИЯ ТЕМЫ ШАБЛОНА       #
    #########################################

    // Имя темы по умолчанию
    "default" => env("THEME_DEFAULT", "light"), 

    // Корневая папка для тем (относительно папки public/)
    "directory" => env("THEME_DIRECTORY", "css/theme"), 

    // Расширение темы
    "extension" => env("THEME_EXTENSION", ".theme.png"), 

];
