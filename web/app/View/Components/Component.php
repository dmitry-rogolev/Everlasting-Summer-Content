<?php

namespace App\View\Components;

use App\Models\Theme;
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
     */
    protected function __construct()
    {
        $this->theme = session("theme", config("view.theme_default"));
        $this->themes = Cache::get("themes");
        $this->inversionThemes = Cache::get("inversion_themes");
    }
}
