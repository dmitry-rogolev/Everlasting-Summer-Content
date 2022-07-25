<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Avatar extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        "name", 
        "title", 
        "extension", 
        "type", 
        "user_id", 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function remove() : ?bool
    {
        Storage::disk("local")
            ->move("public/avatars/" . $this->user_id . "/" . $this->name, 
                   "deletes/avatars/" . $this->user_id . "/" . $this->name);

        return $this->delete();
    }

    public function forceRemove() : ?bool
    {
        Storage::disk("local")
            ->delete("deletes/avatars/" . $this->user_id . "/" . $this->name);

        return $this->forceDelete();
    }
}
