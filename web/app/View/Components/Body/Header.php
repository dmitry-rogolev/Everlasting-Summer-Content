<?php

namespace App\View\Components\Body;

use App\View\Components\Component;

class Header extends Component
{
    protected string $class;

    /**
     * Create a new component instance.
     * 
     * @param ?string $theme Тема шаблона
     * @param ?string $class Классы для блока
     *
     * @return void
     */
    public function __construct(?string $theme = null, ?string $class = null)
    {
        parent::__construct($theme);

        $this->class = $class ?? "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.body.header', 
        [
            "theme" => $this->theme, 
            "class" => $this->class, 
        ]);
    }
}
