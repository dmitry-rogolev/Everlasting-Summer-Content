<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Lang extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", 
    ];

    public $timestamps = false;
}
