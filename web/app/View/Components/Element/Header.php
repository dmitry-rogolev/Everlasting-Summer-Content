<?php

namespace App\View\Components\Element;

use App\View\Components\Component;
use Illuminate\Support\Collection;

class Header extends Component
{
    protected string $name;

    protected Collection $inversionThemes;

    /**
     * Create a new component instance.
     * 
     * @param ?string $name Заголовок
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

        $this->inversionThemes = new Collection([
            "lisht" => "dark", 
            "dark" => "light", 
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.header', 
        [
            "theme" => $this->theme, 
            "class" => $this->class, 
            "style" => $this->style, 
            "name" => $this->name, 
            "inversion_themes" => $this->inversionThemes, 
        ]);
    }
}
