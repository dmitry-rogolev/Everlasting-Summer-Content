<?php

use Illuminate\Support\Str;
use App\Models\Comment;
use App\Models\User;

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

if (!function_exists("parent"))
{
    function parent()
    {
        $path = Str::of(path())->explode("/");

        if (intval($path->first()))
        {
            $parent = User::find($path->first());
            
            $folders = $path->skip(1);
            $folders->pop();

            foreach ($folders as $folder)
            {
                if (!$parent) return null;
                $parent = $parent->folders()->whereTitle($folder)->first();
            }

            return $parent;
        }

        return null;
    }
}

if (!function_exists("path"))
{
    function path()
    {
        $path = urldecode(request()->path());

        if ($path === "/") return "";

        $path = Str::of($path)->explode("/");

        $comment = false;

        if ($path->last() === "change-comment" || $path->last() === "remove-comment" || $path->last() === "like-comment" || $path->last() === "dislike-comment" || ($path->last() === "comment" && intval($path->reverse()->skip(1)->first())))
            $comment = true;

        if 
        (
            $path->last() === "add-content" || 
            $path->last() === "create-folder" || 
            $path->last() === "rename" || 
            $path->last() === "remove" || 
            $path->last() === "download" || 
            $path->last() === "visibility" || 
            $path->last() === "tags" || 
            $path->last() === "like" || 
            $path->last() === "dislike" || 
            $path->last() === "favorite" || 
            $path->last() === "description" || 
            $path->last() === "comment" || 
            $path->last() === "change-comment" || 
            $path->last() === "remove-comment" || 
            $path->last() === "like-comment" || 
            $path->last() === "dislike-comment"
        )
        $path->pop();

        if ($comment && intval($path->last()) && Comment::find($path->last()))
            $path->pop();

        return $path->implode("/");
    }
}
