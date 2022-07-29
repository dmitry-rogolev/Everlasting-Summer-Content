<?php

namespace App\Models;

use Database\Factories\DislikeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dislike extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
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

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    protected static function newFactory()
    {
        return DislikeFactory::new();
    }
}
