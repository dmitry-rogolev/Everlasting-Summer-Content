<?php

namespace App\View\Components\Element\Modal;

use App\View\Components\Component;

class Header extends Component
{
    protected string $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $class = null)
    {
        parent::__construct();

        $this->class = $class ?? "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.modal.header', $this->data->merge([
            "class" => $this->class, 
        ])->all());
    }
}
