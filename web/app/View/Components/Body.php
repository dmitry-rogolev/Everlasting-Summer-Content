<?php

namespace App\View\Components;

class Body extends Component
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
        return view('components.body', $this->data->merge([
            "class" => $this->class, 
        ])->all());
    }
}
