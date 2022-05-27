<?php

namespace App\View\Components\Element;

use App\View\Components\Component;

class Flex extends Component
{
    protected string $flex;

    /**
     * Create a new component instance.
     * 
     * @param ?string $flex Классы для флекс-боксов
     * @param ?string $theme Тема шаблона
     * @param ?string $id Идентификатор
     * @param ?string $class Дополнительные классы блока
     * @param ?string $style Дополнительные стили блока
     *
     * @return void
     */
    public function __construct(?string $flex = null, ?string $theme = null, ?string $id = null, ?string $class = null, ?string $style = null)
    {
        parent::__construct($theme, $id, $class, $style);

        $this->flex = $flex ?? "";
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
            "id" => $this->id, 
            "class" => $this->class, 
            "style" => $this->style, 
            "flex" => $this->flex, 
        ]);
    }
}
