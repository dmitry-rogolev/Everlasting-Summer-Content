<?php

namespace App\View\Components\Body\Header;

use App\Models\Lang;
use App\View\Components\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Menu extends Component
{
    protected string $name;

    protected string $url;

    protected bool $login;

    protected string $class;

    protected Collection $langs;

    protected Collection $themes;

    protected string $id;

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
        $this->url = $url ? $url : route("welcome");
        $this->login = $login && $login === "true";
        $this->class = $class ?? "";
        $this->langs = Cache::get("langs");
        $this->themes = Cache::get("themes");

        $this->id = id();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.body.header.menu', $this->data->merge([
            "name" => $this->name, 
            "url" => $this->url, 
            "login" => $this->login, 
            "class" => $this->class, 
            "langs" => $this->langs, 
            "themes" => $this->themes, 
            "id" => $this->id, 
        ])->all());
    }
}
