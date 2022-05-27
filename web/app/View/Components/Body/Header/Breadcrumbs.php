<?php

namespace App\View\Components\Body\Header;

use App\View\Components\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Breadcrumbs extends Component
{
    protected Collection $breadcrumbs;

    /**
     * Create a new component instance.
     * 
     * @param ?string $breadcrumbs Название коллекции хлебных крошек в кеше
     * @param ?string $theme Тема шаблона
     * @param ?string $id Идентификатор
     * @param ?string $class Классы блока
     * @param ?string $style Дополнительные стили блока
     *
     * @return void
     */
    public function __construct(
        ?string $breadcrumbs = null, 
        ?string $theme = null, 
        ?string $id = null, 
        ?string $class = null, 
        ?string $style = null
    )
    {
        parent::__construct($theme, $id, $class, $style);

        $this->breadcrumbs = 
        (
            $breadcrumbs && 
            Cache::has($breadcrumbs) && 
            (
                Cache::get($breadcrumbs) instanceof Collection || 
                is_array(Cache::get($breadcrumbs))
            )
        )
        ? 
        (
            is_array(Cache::get($breadcrumbs))
            ? 
            new Collection(Cache::get($breadcrumbs)) 
            : 
            Cache::get($breadcrumbs)
        )
        : 
        new Collection([
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
            "id" => $this->id, 
            "class" => $this->class, 
            "style" => $this->style, 
            "breadcrumbs" => $this->breadcrumbs, 
        ]);
    }
}
