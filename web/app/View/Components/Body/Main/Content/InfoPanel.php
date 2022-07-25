<?php

namespace App\View\Components\Body\Main\Content;

use App\Models\Content;
use App\Models\User;
use App\View\Components\Component;

class InfoPanel extends Component
{
    protected User $user;

    protected Content $content;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user, Content $content)
    {
        parent::__construct();

        $this->user = $user;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.body.main.content.info-panel', $this->data->merge([

            "user" => $this->user, 
            "content" => $this->content, 

            "like" => boolval(request()->user() ? request()->user()->likes()->whereContentId($this->content->id)->count() : null), 

            "dislike" => boolval(request()->user() ? request()->user()->dislikes()->whereContentId($this->content->id)->count() : null), 

            "favorite" => boolval(request()->user() ? request()->user()->favorites()->whereContentId($this->content->id)->count() : null), 

        ])->all());
    }
}
