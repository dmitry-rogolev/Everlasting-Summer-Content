<?php

namespace App\View\Components\Element;

use App\View\Components\Component;

class NavItem extends Component
{
    protected string $name;

    protected string $url;

    protected string $class;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $name = null, ?string $url = null, ?string $class = null)
    {
        parent::__construct();

        $this->name = $name;
        $this->url = $url;
        $this->class = $class;
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
            "class" => $this->class, 
        ]);
    }
}
