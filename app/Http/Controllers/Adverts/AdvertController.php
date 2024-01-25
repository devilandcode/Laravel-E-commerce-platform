<?php

namespace App\Http\Controllers\Adverts;

use App\Http\Controllers\Controller;
use App\Models\Adverts\Advert\Advert;
use App\Models\Adverts\Category;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdvertController extends Controller
{
    public function index(Region $region = null, Category $category = null)
    {
       $query = Advert::with(['category', 'region'])->orderByDesc('id');

       if ($category) {
           $query->forCategory($category);
       }

       if ($region) {
           $query->forRegion($region);
       }

       $regions = $region
           ? $region->children()->orderBy('name')->getModels()
           : Region::roots()->orderBy('name')->getModels();

       $categories = $category
           ? $category->children()->defaultOrder()->getModels()
           : Category::whereIsRoot()->defaultOrder()->getModels();

       $adverts = $query->paginate(20);

       return view('adverts.index', compact(
           'category', 'region', 'categories', 'regions','adverts'));
    }

    public function show(Advert $advert)
    {
        if (!($advert->isActive() || Gate::allows('show-advert', $advert))) {
            abort(403);
        }

        return view('adverts.show', compact('advert'));
    }

}
