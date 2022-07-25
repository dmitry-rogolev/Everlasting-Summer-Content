<?php

namespace App\View\Components\Element;

use App\View\Components\Component;

class Sort extends Component
{
    protected string|bool $sort;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string|bool $sort)
    {
        parent::__construct();

        $this->sort = $sort;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.sort', $this->data->merge([
            "sort" => $this->sort, 
        ])->all());
    }
}
