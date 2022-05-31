<?php

namespace App\View\Components\Element;

use App\View\Components\Component;

class Flex extends Component
{
    protected string $flex;

    /**
     * Create a new component instance.
     * 
     * @param ?string $flex Классы для флекс-боксов
     * @param ?string $theme Тема шаблона
     *
     * @return void
     */
    public function __construct(?string $flex = null, ?string $theme = null)
    {
        parent::__construct($theme);

        $this->flex = $flex ?? "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.flex', 
        [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "flex" => $this->flex, 
        ]);
    }
}
