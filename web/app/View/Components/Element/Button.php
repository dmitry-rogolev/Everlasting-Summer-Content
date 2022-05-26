<?php

namespace App\View\Components\Element;

use App\View\Components\Component;

class Button extends Component
{
    protected string $name;

    /**
     * Create a new component instance.
     * 
     * @param ?string $name Имя кнопки
     * @param ?string $theme Тема шаблона
     * @param ?string $class Дополнительные классы блока
     * @param ?string $style Дополнительные стили блока
     *
     * @return void
     */
    public function __construct(?string $name = null, ?string $theme = null, ?string $class = null, ?string $style = null)
    {
        parent::__construct($theme, $class, $style);

        $this->name = $name ?? "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.button', 
        [
            "theme" => $this->theme, 
            "class" => $this->class, 
            "style" => $this->style, 
            "name" => $this->name, 
        ]);
    }
}
