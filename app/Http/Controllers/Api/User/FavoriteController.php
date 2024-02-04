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
     *     tags={"Favorites"},
     *     @OA\Response(
     *         response=200,
     *         description="Success response",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/AdvertDetail")
     *         ),
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
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
     *     @OA\Parameter(name="advertId", in="path", required=true, type="integer"),
     *     @OA\Response(
     *         response=204,
     *         description="Success response",
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    public function remove(Advert $advert)
    {
        try {
            $this->service->remove(Auth::id(), $advert->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('cabinet.favorites.index');
    }
}
