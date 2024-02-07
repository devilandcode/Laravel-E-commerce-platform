<?php

namespace App\Http\Controllers;


use App\Models\Adverts\Category;
use App\Models\Region;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $regions = Region::roots()->orderBy('name')->getModels();

        $categories = Category::whereIsRoot()->defaultOrder()->getModels();

        return view('home', compact('regions', 'categories'));
    }
}
