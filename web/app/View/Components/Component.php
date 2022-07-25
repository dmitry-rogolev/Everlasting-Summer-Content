<?php

namespace App\View\Components;

use Illuminate\View\Component as BaseComponent;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

abstract class Component extends BaseComponent
{
    protected string $theme;

    protected Collection $inversionThemes;

    protected Collection $data;

    /**
     * Конструктор
     */
    protected function __construct()
    {
        $this->theme = session("theme", config("theme.default"));
        $this->inversionThemes = Cache::get("inversion_themes");

        $this->data = $this->getDefaultData();
    }

    protected function getDefaultData() : Collection
    {
        return new Collection([
            "theme" => $this->theme, 
            "inversion_themes" => $this->inversionThemes, 
        ]);
    }
}
