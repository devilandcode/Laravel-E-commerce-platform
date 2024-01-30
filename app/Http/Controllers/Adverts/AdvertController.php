<?php

namespace App\Http\Controllers\Adverts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adverts\SearchRequest;
use App\Http\Router\AdvertsPath;
use App\Models\Adverts\Advert\Advert;
use App\Models\Adverts\Category;
use App\Models\Region;
use App\Services\Adverts\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;



class AdvertController extends Controller
{

    public function __construct(private SearchService $search)
    {
    }

    public function index(SearchRequest $request, AdvertsPath $path)
    {
        $region = $path->region;
        $category = $path->category;

        $response = $this->search->search($category, $region, $request, 20, $request->get('page', 1));

        $adverts = $response->adverts;
        $regionsCounts = $response->regionsCounts;
        $categoriesCounts = $response->categoriesCounts;

        $regions = $region
            ? $region->children()->orderBy('name')->getModels()
            : Region::roots()->orderBy('name')->getModels();

        $categories = $category
            ? $category->children()->defaultOrder()->getModels()
            : Category::whereIsRoot()->defaultOrder()->getModels();

        $regions = array_filter($regions, function (Region $region) use ($regionsCounts) {
            return isset($regionsCounts[$region->id]) && $regionsCounts[$region->id] > 0;
        });

        $categories = array_filter($categories, function (Category $category) use ($categoriesCounts) {
            return isset($categoriesCounts[$category->id]) && $categoriesCounts[$category->id] > 0;
        });

        return view('adverts.index', compact(
            'category', 'region', 'categories', 'regions',
            'adverts','regionsCounts', 'categoriesCounts'));
    }

    public function show(Advert $advert)
    {
        if (!($advert->isActive() && Gate::allows('show-advert', $advert))) {
            abort(403);
        }

        $user = Auth::user();

        return view('adverts.show', compact('advert', 'user'));
    }

    public function phone(Advert $advert): string
    {
        if (! ($advert->isActive() && Gate::allows('show-advert', $advert))) {
            abort(403);
        }

        return $advert->user->phone;
    }

}
