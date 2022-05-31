<?php

namespace App\View\Components\Element;

use App\View\Components\Component;

class Section extends Component
{
    /**
     * Create a new component instance.
     * 
     * @param ?string $theme Тема шаблона
     *
     * @return void
     */
    public function __construct(?string $theme = null)
    {
        parent::__construct($theme);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.section', 
        [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
        ]);
    }
}
