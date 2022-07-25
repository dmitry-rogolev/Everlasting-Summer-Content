<?php

use Illuminate\Support\Str;
use App\Models\Comment;
use App\Models\Content;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Support\Collection;

/**
 * Глобальные помощники
 * 
 * 
 */

if (!function_exists("id"))
{
    /**
     * Возвращает случайный строковый идентификатор с префиксом и указанной длинной 
     * состоящий из латинских букв и цифр.
     *
     * @param string|null $prefix Префикс
     * @param integer|null $length Длинна идентификатора без учета префикса
     * @return string Случайный строковый идентификатор с префиксом и указанной длинной 
     * состоящий из латинских букв и цифр
     */
    function id(?string $prefix = null, ?int $length = null) : string
    {
        return ($prefix ?? config("view.id_prefix")) . Str::random($length ?? config("view.id_length"));
    }
}

if (!function_exists("pathOfContent"))
{
    function pathOfContent(Content $content) : string
    {
        $path = new Collection();

        $current = $content->folder;

        while ($current->title)
        {
            $path->push($current->title);

            $current = $current->folder()->first();
        }

        return $path->reverse()->implode("/");
    }
}

if (!function_exists("pathOfFolder"))
{
    function pathOfFolder(Folder $folder) : string
    {
        $path = new Collection();

        $current = $folder;

        while ($current->title)
        {
            $path->push($current->title);

            $current = $current->folder()->first();
        }

        return $path->reverse()->implode("/");
    }
}
