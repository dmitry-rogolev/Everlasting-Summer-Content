<?php

namespace App\View\Components\Body\Main\Folder;

use App\Models\Folder;
use Illuminate\Database\Eloquent\Collection;
use App\View\Components\Component;

class ControlPanel extends Component
{
    protected Folder $folder;

    protected bool $can;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Folder $folder, bool $can)
    {
        parent::__construct();

        $this->folder = $folder;
        $this->can = $can;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.body.main.folder.control-panel', $this->data->merge([
            "folder" => $this->folder, 
            "can" => $this->can, 

            "new" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]),

            "add" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]), 

            "rename" => new Collection([
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
