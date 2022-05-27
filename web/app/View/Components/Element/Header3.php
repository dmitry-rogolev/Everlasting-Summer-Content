<?php

namespace App\View\Components\Element;

use App\View\Components\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Header3 extends Component
{
    protected string $name;

    protected Collection $inversionThemes;

    /**
     * Create a new component instance.
     * 
     * @param ?string $name Заголовок
     * @param ?string $inversionThemes Название коллекции инвертированных тем в кеше
     * @param ?string $theme Тема шаблона
     * @param ?string $id Идентификатор
     * @param ?string $class Дополнительные классы блока
     * @param ?string $style Дополнительные стили блока
     *
     * @return void
     */
    public function __construct(
        ?string $name = null, 
        ?string $inversionThemes = null, 
        ?string $theme = null, 
        ?string $id = null, 
        ?string $class = null, 
        ?string $style = null
    )
    {
        parent::__construct($theme, $id, $class, $style);

        $this->name = $name ?? "";

        $this->inversionThemes = 
        (
            $inversionThemes && 
            Cache::has($inversionThemes) && 
            (
                Cache::get($inversionThemes) instanceof Collection || 
                is_array(Cache::get($inversionThemes))
            )
        )
        ? 
        (
            is_array(Cache::get($inversionThemes)) 
            ? 
            new Collection(Cache::get($inversionThemes)) 
            : 
            Cache::get($inversionThemes)
        )
        : 
        new Collection([
            "light" => "dark", 
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
        return view('components.element.header3', 
        [
            "theme" => $this->theme, 
            "id" => $this->id, 
            "class" => $this->class, 
            "style" => $this->style, 
            "name" => $this->name, 
            "inversion_themes" => $this->inversionThemes, 
        ]);
    }
}
