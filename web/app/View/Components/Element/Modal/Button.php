<?php

namespace App\View\Components\Element\Modal;

use App\View\Components\Component;

class Button extends Component
{
    protected string $class;

    protected string $target;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $class = null, ?string $target = null)
    {
        parent::__construct();

        $this->class = $class ?? "";
        $this->target = $target ?? "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.modal.button', $this->data->merge([
            "class" => $this->class, 
            "target" => $this->target, 
        ])->all());
    }
}
