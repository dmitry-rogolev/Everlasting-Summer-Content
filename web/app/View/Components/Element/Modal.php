<?php

namespace App\View\Components\Element;

use App\View\Components\Component;

class Modal extends Component
{
    protected string $class;

    protected string $labelledby;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $class = null, ?string $labelledby = null)
    {
        parent::__construct();

        $this->class = $class ?? "";
        $this->labelledby = $labelledby ?? "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.modal', 
        [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "class" => $this->class, 
            "labelledby" => $this->labelledby, 
        ]);
    }
}
