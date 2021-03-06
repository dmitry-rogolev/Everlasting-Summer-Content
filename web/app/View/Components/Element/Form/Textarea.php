<?php

namespace App\View\Components\Element\Form;

use App\View\Components\Component;
use Illuminate\Support\Str;

class Textarea extends Component
{
    protected string $id;

    protected string $label;

    protected string $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $label = null, ?string $class = null)
    {
        parent::__construct();

        $this->id = id();
        $this->label = $label ?? "";
        $this->class = $class ?? "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.form.textarea', $this->data->merge([
            "id" => $this->id, 
            "label" => $this->label, 
            "class" => $this->class, 
        ])->all());
    }
}
