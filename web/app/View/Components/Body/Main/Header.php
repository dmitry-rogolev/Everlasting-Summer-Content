<?php

namespace App\View\Components\Body\Main;

use App\View\Components\Component;

class Header extends Component
{
    protected string $header;

    protected string $referer;

    /**
     * Create a new component instance.
     * 
     * @param ?string $theme Тема шаблона
     * @param ?string $referer Ссылка на предыдущую страницу
     * @param ?string $header Заголовок страницы
     * @param ?string $class Дополнительные классы блока
     * @param ?string $style Дополнительные стили блока
     *
     * @return void
     */
    public function __construct(?string $header = null, ?string $referer = null, ?string $theme = null, ?string $class = null, ?string $style = null)
    {
        parent::__construct($theme, $class, $style);

        $this->header = $header;
        $this->referer = $referer;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.body.main.header', 
        [
            "theme" => $this->theme, 
            "class" => $this->class, 
            "style" => $this->style, 
            "header" => $this->header, 
            "referer" => $this->referer, 
        ]);
    }
}
