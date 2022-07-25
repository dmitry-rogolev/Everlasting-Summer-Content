<?php

namespace App\View\Components\Body\Main\Content;

use App\Models\Content;
use App\View\Components\Component;
use Illuminate\Support\Collection;

class ControlPanel extends Component
{
    protected Content $content;

    protected bool $can;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Content $content, bool $can)
    {
        parent::__construct();

        $this->content = $content;
        $this->can = $can;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.body.main.content.control-panel', $this->data->merge([
            "content" => $this->content, 
            "can" => $this->can, 

            "rename" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]), 
    
            "description" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]),
    
            "tags" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]),
    
            "remove" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]),
        ])->all());
    }
}
