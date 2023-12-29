<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('account.home');
    }
}
