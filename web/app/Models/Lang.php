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

    public static function cache()
    {
        if (!Cache::has("langs"))
        {
            $langs = new Collection();
            foreach (Lang::all() as $lang)
            {
                $langs->put(__("lang." . $lang->name), $lang->name);
            }
            Cache::add("langs", $langs, config("cache.keep"));
        }
    }
}
