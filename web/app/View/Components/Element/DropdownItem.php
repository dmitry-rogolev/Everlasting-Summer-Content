<?php

namespace App\View\Components\Element;

use App\View\Components\Component;

class DropdownItem extends Component
{
    protected string $url;

    protected string $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $url = null, ?string $class = null)
    {
        parent::__construct();

        $this->url = $url ?? "";
        $this->class = $class ?? "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.dropdown-item', $this->data->merge([
            "url" => $this->url, 
            "class" => $this->class, 
        ])->all());
    }
}
