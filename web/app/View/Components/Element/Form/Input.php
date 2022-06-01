<?php

namespace App\View\Components\Element\Form;

use App\View\Components\Component;
use Illuminate\Support\Str;

class Input extends Component
{
    protected string $id;

    protected string $aria;

    protected string $label;

    protected string $small;

    protected string $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $label = null, ?string $small = null, ?string $class = null)
    {
        parent::__construct();

        $this->id = Str::random(10);
        $this->aria = Str::random(10);
        $this->label = $label ?? "";
        $this->small = $small ?? "";
        $this->class = $class ?? "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.form.input', 
        [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "id" => $this->id, 
            "aria" => $this->aria, 
            "label" => $this->label, 
            "small" => $this->small, 
            "class" => $this->class, 
        ]);
    }
}
