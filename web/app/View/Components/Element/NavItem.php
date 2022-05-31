<?php

namespace App\View\Components\Element;

use App\View\Components\Component;

class NavItem extends Component
{
    protected string $name;

    protected string $url;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name = "", string $url = "", string $theme = "")
    {
        parent::__construct($theme);

        $this->name = $name;
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.nav-item', 
        [
            "name" => $this->name, 
            "url" => $this->url, 
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
        ]);
    }
}
