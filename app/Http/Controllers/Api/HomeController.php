<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/",
     *     tags={"Info"},
     *     @OA\Response(
     *          response="200",
     *          description="API version")
     *     ),
     * )
     */
    public function home()
    {
        return [
          'name' => 'Board Api',
        ];
    }
}
