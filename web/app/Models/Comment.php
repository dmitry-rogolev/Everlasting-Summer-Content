<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes
    {
        SoftDeletes::forceDelete as parentForceDelete;
    }

    protected $fillable = [
        "comment", 
        "user_id", 
        "content_id", 
        "comment_id", 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

    public function scopeComment($query)
    {
        return $query->whereId($this->comment_id);
    }

    public function scopeComments($query)
    {
        return $query->whereCommentId($this->id);
    }

    public function delete()
    {
        foreach ($this->comments()->get() as $comment)
        {
            $comment->delete();
        }

        return parent::delete();
    }

    public function forceDelete()
    {
        foreach ($this->comments()->get() as $comment)
        {
            $comment->forceDelete();
        }

        return $this->parentForceDelete();
    }
}
