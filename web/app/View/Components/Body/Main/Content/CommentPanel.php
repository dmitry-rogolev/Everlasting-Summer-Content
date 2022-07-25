<?php

namespace App\View\Components\Body\Main\Content;

use App\Models\Content;
use App\View\Components\Component;
use Illuminate\Support\Collection;

class CommentPanel extends Component
{
    protected Content $content;

    protected Collection $comments;

    protected string|bool $sort;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Content $content, Collection $comments, string|bool $sort)
    {
        parent::__construct();

        $this->content = $content;
        $this->comments = $comments;
        $this->sort = $sort;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.body.main.content.comment-panel', $this->data->merge([
            "content" => $this->content, 
            "comments" => $this->comments, 
            "sort" => $this->sort, 

            "add_comment" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]), 
        ])->all());
    }
}
