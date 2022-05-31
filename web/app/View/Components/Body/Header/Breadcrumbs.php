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
     * @param ?string $theme Тема шаблона
     *
     * @return void
     */
    public function __construct(?string $theme = null)
    {
        parent::__construct($theme);

        $this->breadcrumbs = Cache::pull("breadcrumbs");
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
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "breadcrumbs" => $this->breadcrumbs, 
        ]);
    }
}
