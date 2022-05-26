<?php

namespace App\View\Components;

use Illuminate\View\Component as BaseComponent;

abstract class Component extends BaseComponent
{
    protected string $theme;

    /**
     * Конструктор
     *
     * @param ?string $theme Тема шаблона
     */
    protected function __construct(?string $theme = null)
    {
        $this->theme = $theme ?? session("theme", config("view.theme_default"));
    }
}
