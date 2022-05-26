<?php

namespace App\View\Components;

use Illuminate\View\Component as BaseComponent;

abstract class Component extends BaseComponent
{
    protected string $theme;

    protected function __construct()
    {
        $this->theme = session("theme", config("view.theme_default"));
    }
}
