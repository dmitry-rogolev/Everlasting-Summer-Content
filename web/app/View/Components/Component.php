<?php

namespace App\View\Components;

use Illuminate\View\Component as BaseComponent;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

abstract class Component extends BaseComponent
{
    protected string $theme;

    protected Collection $themes;

    protected Collection $inversionThemes;

    /**
     * Конструктор
     *
     * @param ?string $theme Тема шаблона
     */
    protected function __construct(?string $theme = null)
    {
        $this->theme = $theme ?? session("theme", config("view.theme_default"));
        $this->themes = Cache::get("themes", config("view.themes"));
        $this->inversionThemes = Cache::get("inversion_themes", config("view.inversion_themes"));
    }
}
