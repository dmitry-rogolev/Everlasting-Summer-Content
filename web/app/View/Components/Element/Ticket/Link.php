<?php

namespace App\View\Components\Element\Ticket;

use App\View\Components\Component;

class Link extends Component
{
    protected string $image;

    protected string $href;

    protected string $class;

    protected string $style;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $image = null, ?string $href = null, ?string $class = null, ?string $style = null)
    {
        parent::__construct();

        $this->image = $image ?? "";
        $this->href = $href ?? "";
        $this->class = $class ?? "";
        $this->style = $style ?? "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.ticket.link', $this->data->merge([
            "class" => $this->class, 
            "style" => $this->style, 
            "image" => $this->image, 
            "href" => $this->href, 
        ])->all());
    }
}
