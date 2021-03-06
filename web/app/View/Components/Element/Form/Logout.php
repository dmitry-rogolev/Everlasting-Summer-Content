<?php

namespace App\View\Components\Element\Form;

use App\View\Components\Component;

class Logout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.form.logout', $this->data->merge([

        ])->all());
    }
}
