<?php 

namespace App\Traits;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

trait TCached 
{
    protected function cached() : void
    {
        $cached = config("cache.cached");

        foreach ($cached as $class => $toLocale)
        {
            if (is_string($class) && class_exists($class))
            {
                $class = new $class();
                
                if ($class instanceof Model && !Cache::has($class->getTable()))
                {
                    Cache::add($class->getTable(), 
                        is_callable($toLocale) ? $this->getLocaleCollection($class::class, $toLocale) : $class::all(), 
                        config("cache.keep"));
                }
            }
        }
    }

    private function getLocaleCollection(Model|string $model, callable $callback) : Collection
    {
        $collection = new Collection();

        foreach ($model instanceof Model ? $model->all() : $model::all() as $model)
        {
            $collection->put(...$callback($model));
        }

        return $collection;
    }
}
