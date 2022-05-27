<?php

namespace App\View\Components\Element;

use App\View\Components\Component;

class Div extends Component
{
    /**
     * Create a new component instance.
     * 
     * @param ?string $theme Тема шаблона
     * @param ?string $id Идентификатор
     * @param ?string $class Дополнительные классы блока
     * @param ?string $style Дополнительные стили блока
     *
     * @return void
     */
    public function __construct(?string $theme = null, ?string $id = null, ?string $class = null, ?string $style = null)
    {
        parent::__construct($theme, $id, $class, $style);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.div', 
        [
            "theme" => $this->theme, 
            "id" => $this->id, 
            "class" => $this->class, 
            "style" => $this->style, 
        ]);
    }
}
