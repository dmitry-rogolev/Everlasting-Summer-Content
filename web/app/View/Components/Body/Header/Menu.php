<?php

namespace App\View\Components\Body\Header;

use App\Models\Navigation;
use App\View\Components\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Menu extends Component
{
    protected string $name;

    protected string $url;

    protected Collection $navigations;

    protected bool $login;

    protected string $class;

    /**
     * Create a new component instance.
     * 
     * @param ?string $name Название меню
     * @param ?string $url Ссылка названия меню
     * @param ?string $login Показ ссылок авторизации (true, false)
     *
     * @return void
     */
    public function __construct(
        ?string $name = null, 
        ?string $url = null, 
        ?string $login = null, 
        ?string $class = null, 
    )
    {
        parent::__construct();

        $this->name = $name ? $name : config("app.name");
        $this->url = $url ? $url : url("/");
        $this->login = $login && $login === "true";
        $this->class = $class ?? "";

        Navigation::cache();
        $this->navigations = Cache::get("navigations");
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
            "navigations" => $this->navigations, 
            "login" => $this->login, 
            "class" => $this->class, 
        ]);
    }
}
