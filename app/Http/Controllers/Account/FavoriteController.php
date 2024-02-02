<?php

namespace App\Http\Controllers\Account;


use App\Http\Controllers\Controller;
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

    public function index()
    {
        $adverts = Advert::favoredByUser(Auth::user())->orderByDesc('id')->paginate(20);

        return view('account.favorites.index', compact('adverts'));
    }

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
