<?php

namespace App\Http\Controllers\Account\Adverts;

use App\Http\Controllers\Controller;
use App\Http\Middleware\FilledProfile;
use App\Http\Requests\Adverts\CreateRequest;
use App\Models\Adverts\Category;
use App\Models\Region;
use App\Services\Adverts\AdvertService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function __construct(
        private AdvertService $service
    )
    {
        $this->middleware(FilledProfile::class);
    }

    public function category()
    {
        $categories = Category::defaultOrder()->withDepth()->get()->toTree();

        return view('account.adverts.create.category', compact('categories'));
    }

    public function region(Category $category, Region $region = null)
    {
        $regions = Region::where('parent_id', $region ? $region->id : null)->orderBy('name')->get();

        return view('account.adverts.create.region', compact('category', 'region', 'regions'));
    }

    public function advert(Category $category, Region $region = null)
    {
        return view('account.adverts.create.advert', compact('category', 'region'));
    }

    public function store(CreateRequest $request, Category $category, Region $region = null)
    {
        try {
            $advert = $this->service->create(
                Auth::id(),
                $category->id,
                $region ? $region->id : null,
                $request
            );
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('adverts.show', $advert);
    }
}
