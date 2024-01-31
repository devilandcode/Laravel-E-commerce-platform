<?php

namespace App\Http\Controllers\Account\Adverts;

use App\Http\Controllers\Controller;
use App\Http\Middleware\FilledProfile;
use App\Models\Adverts\Advert\Advert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertController extends Controller
{

    public function __construct()
    {
        $this->middleware(FilledProfile::class);
    }

    public function index()
    {
        $adverts = Advert::forUser(Auth::user())->orderByDesc('id')->paginate(20);

        return view('account.adverts.index', compact('adverts'));
    }
}
