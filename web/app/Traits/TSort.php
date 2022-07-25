<?php 
namespace App\Traits;

use Illuminate\Support\Collection;

trait TSort
{
    protected function sort(string $column) : array
    {
        $sort = [ $column, config("view.sort.default") ];

        $sorts = new Collection(config("view.sort.all"));

        if (request()->has("sort") && $sorts->contains(request()->sort))
        {
            $sort = [ $column, request()->sort ];
        }

        return $sort;
    }
}
