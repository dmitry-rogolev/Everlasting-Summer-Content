<?php

namespace App\View\Components;

use Illuminate\View\Component as BaseComponent;

abstract class Component extends BaseComponent
{
    protected string $theme;

    protected string $class;

    protected string $style;

    /**
     * Конструктор
     *
     * @param ?string $theme Тема шаблона
     * @param ?string $class Дополнительные классы блока
     * @param ?string $style Дополнительные стили блока
     */
    protected function __construct(?string $theme = null, ?string $class = null, ?string $style = null)
    {
        $this->theme = $theme ?? session("theme", config("view.theme_default"));
        $this->class = $class ?? "";
        $this->style = $style ?? "";
    }
}
