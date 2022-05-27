<?php

namespace App\View\Components\Body\Header;

use App\View\Components\Component;
use Illuminate\Support\Collection;

class Menu extends Component
{
    protected string $name;

    protected Collection $links;

    protected Collection $themes;

    /**
     * Create a new component instance.
     * 
     * @param ?string $theme Тема шаблона
     * @param ?string $class Классы блока
     * @param ?string $style Дополнительные стили блока
     *
     * @return void
     */
    public function __construct(?string $theme = null, ?string $class = null, ?string $style = null)
    {
        parent::__construct($theme, $class, $style);

        $this->name = config("app.name");

        $this->links = new Collection();

        $this->themes = new Collection([
            "Светлая" => url()->current() . "/?theme=light", 
            "Темная" => url()->current() . "/?theme=dark", 
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.body.header.menu', 
        [
            "theme" => $this->theme, 
            "class" => $this->class, 
            "style" => $this->style, 
            "name" => $this->name, 
            "links" => $this->links, 
            "themes" => $this->themes, 
        ]);
    }
}
