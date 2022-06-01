<?php

namespace App\View\Components\Element;

use App\View\Components\Component;

class Flex extends Component
{
    protected string $flex;

    protected string $class;

    /**
     * Create a new component instance.
     * 
     * @param ?string $flex Классы для флекс-боксов
     *
     * @return void
     */
    public function __construct(?string $flex = null, ?string $class = null)
    {
        parent::__construct();

        $this->flex = $flex ?? "";
        $this->class = $class ?? "";
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
            "class" => $this->class, 
        ]);
    }
}
