<?php

namespace App\View\Components\Element;

use App\View\Components\Component;

class DropdownItem extends Component
{
    protected string $url;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $url = "", string $theme = "")
    {
        parent::__construct($theme);

        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.dropdown-item', 
        [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "url" => $this->url, 
        ]);
    }
}
