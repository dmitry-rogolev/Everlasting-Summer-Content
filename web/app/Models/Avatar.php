<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "title", 
        "extension", 
        "type", 
        "user_id", 
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
