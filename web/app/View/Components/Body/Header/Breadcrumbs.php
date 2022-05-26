<?php

namespace App\View\Components\Body\Header;

use App\View\Components\Component;
use Illuminate\Support\Collection;

class Breadcrumbs extends Component
{
    protected Collection $breadcrumbs;

    /**
     * Create a new component instance.
     * 
     * @param ?string $theme Тема шаблона
     * @param ?string $class Классы блока
     *
     * @return void
     */
    public function __construct(?string $theme = null, ?string $class = null)
    {
        parent::__construct($theme, $class);

        $this->breadcrumbs = new Collection([
            "Главная" => url("/"), 
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.body.header.breadcrumbs', 
        [
            "theme" => $this->theme, 
            "class" => $this->class, 
            "breadcrumbs" => $this->breadcrumbs, 
        ]);
    }
}
