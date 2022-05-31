<?php

namespace App\View\Components\Body\Header;

use App\View\Components\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Menu extends Component
{
    protected string $name;

    protected string $url;

    protected Collection $links;

    protected bool $login;

    /**
     * Create a new component instance.
     * 
     * @param ?string $name Название меню
     * @param ?string $url Ссылка названия меню
     * @param ?Collection $links Коллекция ссылок
     * @param ?string $login Показ ссылок авторизации (true, false)
     * @param ?string $theme Тема шаблона
     *
     * @return void
     */
    public function __construct(
        ?string $name = null, 
        ?string $url = null, 
        ?Collection $links = null, 
        ?string $login = null, 
        ?string $theme = null, 
    )
    {
        parent::__construct($theme);

        $this->name = $name ? $name : config("app.name");
        $this->url = $url ? $url : url("/");
        $this->login = $login && $login === "true";
        $this->links = $links ?? new Collection();
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
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "name" => $this->name, 
            "url" => $this->url, 
            "links" => $this->links, 
            "login" => $this->login, 
        ]);
    }
}
