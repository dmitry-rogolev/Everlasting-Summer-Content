<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use App\Models\Navigation;

class ContentController extends Controller
{
    protected string $header;

    protected string $referer;

    protected Collection $breadcrumbs;

    public function __construct(
        ?string $title = null, 
        ?string $header = null, 
        ?string $referer = null, 
        ?Collection $breadcrumbs = null, 
        ?string $theme = null, 
    )
    {
        parent::__construct($title, $theme);

        $this->header = $header;
        $this->referer = $referer;
        $this->breadcrumbs = $breadcrumbs;

        Cache::put("breadcrumbs", $this->breadcrumbs);

        Navigation::cache();
    }
}
