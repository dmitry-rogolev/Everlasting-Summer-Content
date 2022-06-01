<?php

namespace App\View\Components\Element;

use App\View\Components\Component;
use Illuminate\Support\Str;

class Dropdown extends Component
{
    protected string $name;

    protected string $id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name = "", string $theme = "")
    {
        parent::__construct($theme);

        $this->name = $name;
        $this->id = Str::random(10);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.dropdown', 
        [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "name" => $this->name, 
            "id" => $this->id, 
        ]);
    }
}