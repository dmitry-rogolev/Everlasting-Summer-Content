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
     *
     * @return void
     */
    public function __construct(?string $theme = null, ?string $header = null, ?string $referer = null)
    {
        parent::__construct($theme);

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
            "header" => $this->header, 
            "referer" => $this->referer, 
        ]);
    }
}
