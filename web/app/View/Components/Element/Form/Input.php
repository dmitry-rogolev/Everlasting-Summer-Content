<?php

namespace App\View\Components\Element\Form;

use App\View\Components\Component;

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

        $this->id = id();
        $this->aria = id();
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
        return view('components.element.form.input', $this->data->merge([
            "id" => $this->id, 
            "aria" => $this->aria, 
            "label" => $this->label, 
            "small" => $this->small, 
            "class" => $this->class, 
        ])->all());
    }
}
