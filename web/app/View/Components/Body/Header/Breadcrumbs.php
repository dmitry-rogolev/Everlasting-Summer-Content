<?php

namespace App\View\Components\Body\Header;

use App\View\Components\Component;
use Illuminate\Support\Collection;

class Breadcrumbs extends Component
{
    protected Collection $breadcrumbs;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?Collection $breadcrumbs = null)
    {
        parent::__construct();

        $this->breadcrumbs = $breadcrumbs ?? new Collection();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.body.header.breadcrumbs', $this->data->merge([
            "breadcrumbs" => $this->breadcrumbs, 
        ])->all());
    }
}
