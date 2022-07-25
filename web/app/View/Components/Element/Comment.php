<?php

namespace App\View\Components\Element;

use App\Models\Comment as ModelsComment;
use App\Models\Content;
use App\View\Components\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

class Comment extends Component
{
    protected string $class;

    protected string $style;

    protected ModelsComment $comment;

    protected Collection $add;

    protected Collection $change;

    protected Content $content;

    protected Collection $remove;

    protected string $id;

    protected string $date;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        ?string $class = null, 
        ?string $style = null, 
        ?ModelsComment $comment = null, 
        ?Content $content = null, 
    )
    {
        parent::__construct();

        $this->class = $class ?? ""; 
        $this->style = $style ?? "";
        $this->comment = $comment ?? new ModelsComment();
        $this->content = $content ?? new Content();

        $this->id = id();

        $this->date = $this->date($comment);

        $this->add = new Collection([
            "id" => id(), 
            "labelledby" => id(), 
        ]);

        $this->change = new Collection([
            "id" => id(), 
            "labelledby" => id(), 
        ]);

        $this->remove = new Collection([
            "id" => id(), 
            "labelledby" => id(), 
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.comment', $this->data->merge([
            "class" => $this->class, 
            "style" => $this->style, 
            "comment" => $this->comment, 
            "add" => $this->add, 
            "change" => $this->change, 
            "content" => $this->content, 
            "remove" => $this->remove, 
            "id" => $this->id, 
            "date" => $this->date, 
            "like" => boolval(request()->user() ? request()->user()->likes()->whereCommentId($this->comment->id)->count() : null), 
            "dislike" => boolval(request()->user() ? request()->user()->dislikes()->whereCommentId($this->comment->id)->count() : null), 
        ])->all());
    }

    private function date(ModelsComment $comment) : string
    {
        $date = new Carbon($comment->updated_at);

        $seconds = $date->diffInSeconds(now(), false);

        if ($seconds <= 60)
            return trans_choice("page.seconds", $seconds);
            
        else if ($seconds > 60 && $seconds <= 60 * 60)
            return trans_choice("page.minutes", $date->diffInMinutes(now(), false));

        else if ($seconds > 60 * 60 && $seconds <= 60 * 60 * 24)
            return trans_choice("page.hours", $date->diffInHours(now(), false));

        else if ($seconds > 60 * 60 * 24 && $seconds <= 60 * 60 * 24 * 31)
            return trans_choice("page.months", $date->diffInMonths(now(), false));

        else 
            return trans_choice("page.years", $date->diffInYears(now(), false));
    }
}
