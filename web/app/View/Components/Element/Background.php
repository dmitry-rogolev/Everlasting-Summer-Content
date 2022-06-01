<?php

namespace App\View\Components\Element;

use App\View\Components\Component;

class Background extends Component
{
    protected string $class;

    protected string $style;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $class = null, ?string $style = null)
    {
        parent::__construct();

        $this->class = $class ?? "";
        $this->style = $style ?? "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.background', 
        [
            "theme" => $this->theme,
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "class" => $this->class, 
            "style" => $this->style, 
        ]);
    }
}
