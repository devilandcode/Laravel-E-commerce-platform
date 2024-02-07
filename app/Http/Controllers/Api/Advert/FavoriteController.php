<?php

namespace App\Http\Controllers\Api\Advert;

use App\Http\Controllers\Controller;
use App\Models\Adverts\Advert\Advert;
use App\Services\Adverts\FavoriteService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __construct(private FavoriteService $service)
    {
    }

    /**
     * @OA\Post(
     *     path="/adverts/{advertId}/favorite",
     *     tags={"Adverts"},
     *     @OA\Parameter(name="advertId", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=201,
     *         description="Success response",
     *     ),
     * )
     */
    public function add(Advert $advert)
    {
        $this->service->add(Auth::id(), $advert->id);
        return response()->json([], Response::HTTP_CREATED);
    }
    /**
     * @OA\Delete(
     *     path="/adverts/{advertId}/favorite",
     *     tags={"Adverts"},
     *     @OA\Parameter(name="advertId", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=204,
     *         description="Success response",
     *     ),
     * )
     */

    public function remove(Advert $advert)
    {
        $this->service->remove(Auth::id(), $advert->id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
