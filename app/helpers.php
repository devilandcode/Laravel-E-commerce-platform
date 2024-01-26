<?php

use App\Http\Router\AdvertsPath;
use App\Models\Region;
use \App\Models\Adverts\Category;

if (! function_exists('adverts_path')) {

    function adverts_path(?Region $region, ?Category $category)
    {
        return app()->make(AdvertsPath::class)
            ->withRegion($region)
            ->withCategory($category);
    }
}
