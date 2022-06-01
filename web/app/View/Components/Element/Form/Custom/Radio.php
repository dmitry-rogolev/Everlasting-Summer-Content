<?php

namespace App\View\Components\Element\Form\Custom;

use App\View\Components\Component;
use Illuminate\Support\Str;

class Radio extends Component
{
    protected string $id;

    protected string $class;

    protected string $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $label = null, ?string $class = null)
    {
        parent::__construct();

        $this->id = Str::random(10);
        $this->class = $class ?? "";
        $this->label = $label ?? "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.form.custom.radio', 
        [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "id" => $this->id, 
            "class" => $this->class, 
            "label" => $this->label,
        ]);
    }
}
