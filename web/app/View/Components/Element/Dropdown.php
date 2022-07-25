<?php

namespace App\View\Components\Element;

use App\View\Components\Component;
use Illuminate\Support\Str;

class Dropdown extends Component
{
    protected string $name;

    protected string $class;

    protected string $id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $name = null, ?string $class = null)
    {
        parent::__construct();

        $this->name = $name ?? "";
        $this->class = $class ?? "";
        $this->id = id();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.dropdown', $this->data->merge([
            "name" => $this->name, 
            "class" => $this->class, 
            "id" => $this->id, 
        ])->all());
    }
}
