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

    protected Collection $themes;

    protected bool $login;

    /**
     * Create a new component instance.
     * 
     * @param ?string $name Название меню
     * @param ?string $url Ссылка названия меню
     * @param ?string $links Название коллекции ссылок в кеше
     * @param ?string $themes Название коллекции тем в кеше
     * @param ?string $login Показ ссылок авторизации (true, false)
     * @param ?string $theme Тема шаблона
     * @param ?string $id Идентификатор
     * @param ?string $class Классы блока
     * @param ?string $style Дополнительные стили блока
     *
     * @return void
     */
    public function __construct(
        ?string $name = null, 
        ?string $url = null, 
        ?string $links = null, 
        ?string $themes = null, 
        ?string $login = null, 
        ?string $theme = null, 
        ?string $id = null, 
        ?string $class = null, 
        ?string $style = null
    )
    {
        parent::__construct($theme, $id, $class, $style);

        $this->name = $name ? $name : config("app.name");
        $this->url = $url ? $url : url("/");
        $this->login = $login && $login === "true";

        $this->links = 
            (
                $links && 
                Cache::has($links) && 
                (
                    Cache::get($links) instanceof Collection || 
                    is_array(Cache::get($links))
                )
            )
            ? 
            (
                is_array(Cache::get($links)) 
                ? 
                new Collection(Cache::get($links))
                : 
                Cache::get($links)
            )
            : 
            new Collection();

        $this->themes = 
        (
            $themes && 
            Cache::has($themes) && 
            (
                Cache::get($themes) instanceof Collection || 
                is_array(Cache::get($links))
            )
        )
        ?
        (
            is_array(Cache::get($themes)) 
            ? 
            new Collection(Cache::get($themes))
            :
            Cache::get($themes)
        )
        :
        new Collection([
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
            "id" => $this->id, 
            "class" => $this->class, 
            "style" => $this->style, 
            "name" => $this->name, 
            "url" => $this->url, 
            "links" => $this->links, 
            "themes" => $this->themes, 
            "login" => $this->login, 
        ]);
    }
}
