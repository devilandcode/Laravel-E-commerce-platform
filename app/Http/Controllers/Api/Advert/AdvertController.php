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
    /**
     * @OA\Get(
     *     path="/adverts",
     *     tags={"Adverts"},
     *     @OA\Response(
     *         response=200,
     *         description="Success response",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/AdvertList")
     *         ),
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    public function index(SearchRequest $request)
    {
        $region = $request->get('region') ? Region::findOrFail($request->get('region')) : null;
        $category = $request->get('category') ? Category::findOrFail($request->get('category')) : null;

        $result = $this->search->search($category, $region, $request, 20, $request->get('page', 1));

        return AdvertListResource::collection($result->adverts);
    }

    /**
     * @OA\Get(
     *     path="/adverts/{advertId}",
     *     tags={"Adverts"},
     *     @OA\Parameter(
     *         name="advertId",
     *         description="ID of advert",
     *         in="path",
     *         required=true,
     *         type="integer"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success response",
     *         @OA\Schema(ref="#/definitions/AdvertDetail"),
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    public function show(Advert $advert)
    {
        if (!($advert->isActive() || Gate::allows('show-advert', $advert))) {
            abort(403);
        }

        return AdvertDetailResource::make($advert);
    }
}
