<?php

namespace App\Http\Controllers;


use App\Models\Banner\Banner;
use App\Services\Banners\BannerService;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function __construct(private BannerService $service)
    {
    }

    public function get(Request $request)
    {
        $format = $request['format'];
        $category = $request['category'];
        $region = $request['region'];

        if (!$banner = $this->service->getRandomForView($category, $region, $format)) {
            return '';
        }

        return view('banner.get', compact('banner'));
    }

    public function click(Banner $banner)
    {
        $this->service->click($banner);
        return redirect($banner->url);
    }
}
