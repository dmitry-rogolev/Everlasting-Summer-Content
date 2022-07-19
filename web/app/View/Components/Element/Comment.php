<?php

namespace App\View\Components\Element;

use App\Models\Comment as ModelsComment;
use App\Models\Content;
use App\Models\User;
use App\View\Components\Component;
use Illuminate\Support\Collection;

class Comment extends Component
{
    protected string $class;

    protected string $style;

    protected User $user;

    protected ModelsComment $comment;

    protected Collection $add;

    protected string $path;

    protected Content $content;

    protected Collection $remove;

    protected string $id;

    protected bool $like;

    protected bool $dislike;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        ?string $class = null, 
        ?string $style = null, 
        ?User $user = null, 
        ?ModelsComment $comment = null, 
        ?string $path = null, 
        ?Content $content = null, 
    )
    {
        parent::__construct();

        $this->class = $class ?? ""; 
        $this->style = $style ?? "";
        $this->user = $user ?? new User();
        $this->comment = $comment ?? new ModelsComment();
        $this->path = $path ?? "";
        $this->content = $content ?? new Content();

        $this->like = boolval($user->likes()->whereCommentId($comment->id)->count());
        $this->dislike = boolval($user->dislikes()->whereCommentId($comment->id)->count());

        $this->id = id();

        $this->add = new Collection([
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
        return view('components.element.comment', 
        [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "class" => $this->class, 
            "style" => $this->style, 
            "user" => $this->user, 
            "comment" => $this->comment, 
            "add" => $this->add, 
            "path" => $this->path, 
            "content" => $this->content, 
            "remove" => $this->remove, 
            "id" => $this->id, 
            "like" => $this->like, 
            "dislike" => $this->dislike, 
        ]);
    }
}
