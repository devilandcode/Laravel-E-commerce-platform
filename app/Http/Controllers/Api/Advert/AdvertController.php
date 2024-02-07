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
     *     @OA\Parameter (
     *         name="advertId",
     *         description="ID of advert",
     *         in="path",
     *         required=true,
     *         example=1,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success response",
     *         @OA\Schema(ref="#/definitions/AdvertDetail"),
     *     ),
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

/**
 * @OA\Definition(
 *     definition="AdvertList",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="user", type="object",
 *         @OA\Property(property="name", type="string"),
 *         @OA\Property(property="phone", type="string"),
 *     ),
 *     @OA\Property(property="category", type="object",
 *         @OA\Property(property="id", type="integer"),
 *         @OA\Property(property="name", type="string"),
 *     ),
 *     @OA\Property(property="region", type="object",
 *         @OA\Property(property="id", type="integer"),
 *         @OA\Property(property="name", type="string"),
 *     ),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="price", type="integer"),
 *     @OA\Property(property="date", type="date"),
 *     @OA\Property(property="photo", type="string"),
 * )
 */

/**
 * @OA\Definition(
 *     definition="AdvertDetail",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user", type="object",
 *         @OA\Property(property="name", type="string", example="Tom"),
 *         @OA\Property(property="phone", type="string", example="Tailor"),
 *     ),
 *     @OA\Property(property="category", type="object",
 *         @OA\Property(property="id", type="integer", example=123),
 *         @OA\Property(property="name", type="string", example="Electronics"),
 *     ),
 *     @OA\Property(property="region", type="object",
 *         @OA\Property(property="id", type="integer", example=14),
 *         @OA\Property(property="name", type="string", example="Lake Garden"),
 *     ),
 *     @OA\Property(property="title", type="string", example=""),
 *     @OA\Property(property="content", type="string"),
 *     @OA\Property(property="price", type="integer"),
 *     @OA\Property(property="address", type="string"),
 *     @OA\Property(property="date", type="object",
 *         @OA\Property(property="published", type="date"),
 *         @OA\Property(property="expires", type="date"),
 *     ),
 *     @OA\Property(property="values", type="array", @OA\Items(ref="#/definitions/AdvertValue")),
 *     @OA\Property(property="photos", type="array", @OA\Items(type="string")),
 * )
 *
 * @OA\Definition(
 *     definition="AdvertValue",
 *     type="object",
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="value", type="string"),
 * )
 */
