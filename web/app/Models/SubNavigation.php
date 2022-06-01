<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubNavigation extends Model
{
    use HasFactory;

    public function Nav()
    {
        return $this->belongsTo(Navigation::class);
    }
}
