<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Advert\AdvertDetailResource;
use App\Models\Adverts\Advert\Advert;
use App\Services\Adverts\FavoriteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __construct(private FavoriteService $service)
    {
        $this->middleware('auth');
    }

    /**
     * @OA\Get(
     *     path="/user/favorites",
     *     summary="Get Favorites Adverts",
     *     tags={"Favorites"},
     *     @OA\Response(
     *         response=200,
     *         description="Success response",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/AdvertDetail")
     *         ),
     *     ),
     * ),
     */
    public function index()
    {
        $adverts = Advert::favoredByUser(Auth::user())->orderByDesc('id')->paginate(20);

        return AdvertDetailResource::collection($adverts);
    }

    /**
     * @OA\Delete(
     *     path="/user/favorites/{advertId}",
     *     tags={"Favorites"},
     *     @OA\Parameter(name="advertId", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=204,
     *         description="Success response",
     *     ),
     * )
     */
    public function remove(Advert $advert)
    {
        try {
            $this->service->remove(Auth::id(), $advert->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('account.favorites.index');
    }
}


/**
 * @OA\Definition(
 *     definition="AdvertDetail",
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
 *
 */
