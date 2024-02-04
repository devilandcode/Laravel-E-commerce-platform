<?php

namespace App\Http\Controllers\Api\Advert;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adverts\SearchRequest;
use App\Http\Resources\Advert\AdvertDetailResource;
use App\Http\Resources\Advert\AdvertListResource;
use App\Models\Adverts\Advert\Advert;
use App\Models\Adverts\Category;
use App\Models\Region;
use App\Services\Adverts\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdvertController extends Controller
{
    public function __construct(private SearchService $search)
    {
    }

    public function index(SearchRequest $request)
    {
        $region = $request->get('region') ? Region::findOrFail($request->get('region')) : null;
        $category = $request->get('category') ? Category::findOrFail($request->get('category')) : null;

        $result = $this->search->search($category, $region, $request, 20, $request->get('page', 1));

        return AdvertListResource::collection($result->adverts);
    }

    public function show(Advert $advert)
    {
        if (!($advert->isActive() || Gate::allows('show-advert', $advert))) {
            abort(403);
        }

        return AdvertDetailResource::make($advert);
    }
}
