<?php

namespace App\Http\Controllers\Account\Banners;


use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\CreateRequest;
use App\Models\Adverts\Category;
use App\Models\Banner\Banner;
use App\Models\Region;
use App\Services\Banners\BannerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function __construct(private BannerService $service)
    {
    }

    public function category()
    {
        $categories = Category::defaultOrder()->withDepth()->get()->toTree();

        return view('account.banners.create.category', compact('categories'));
    }

    public function region(Category $category, Region $region = null)
    {
        $regions = Region::where('parent_id', $region ? $region->id : null)->orderBy('name')->get();

        return view('account.banners.create.region', compact('category', 'region', 'regions'));
    }

    public function banner(Category $category, Region $region = null)
    {
        $formats = Banner::formatsList();

        return view('account.banners.create.banner', compact('category', 'region', 'formats'));
    }

    public function store(CreateRequest $request, Category $category, Region $region = null)
    {
        try {
            $banner = $this->service->create(
                Auth::user(),
                $category,
                $region,
                $request
            );
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('account.banners.show', $banner);
    }
}
