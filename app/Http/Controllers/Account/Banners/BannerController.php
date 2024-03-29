<?php

namespace App\Http\Controllers\Account\Banners;


use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\EditRequest;
use App\Http\Requests\Banner\FileRequest;
use App\Models\Banner\Banner;
use App\Services\Banners\BannerService;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BannerController extends Controller
{
    public function __construct( private BannerService $service)
    {
    }

    public function index()
    {
        $banners = Banner::forUser(Auth::user())->orderByDesc('id')->paginate(20);

        return view('account.banners.index', compact('banners'));
    }

    public function show(Banner $banner)
    {
        $this->checkAccess($banner);

        return view('account.banners.show', compact('banner'));
    }

    public function editForm(Banner $banner)
    {
        $this->checkAccess($banner);
        if (!$banner->canBeChanged()) {
            return redirect()->route('account.banners.show', $banner)->with('error', 'Unable to edit.');
        }
        return view('account.banners.edit', compact('banner'));
    }

    public function edit(EditRequest $request, Banner $banner)
    {
        $this->checkAccess($banner);
        try {
            $this->service->editByOwner($banner->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('account.banners.show', $banner);
    }

    public function fileForm(Banner $banner)
    {
        $this->checkAccess($banner);
        if (!$banner->canBeChanged()) {
            return redirect()->route('account.banners.show', $banner)->with('error', 'Unable to edit.');
        }
        $formats = Banner::formatsList();
        return view('account.banners.file', compact('banner', 'formats'));
    }

    public function file(FileRequest $request, Banner $banner)
    {
        $this->checkAccess($banner);
        try {
            $this->service->changeFile($banner->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('account.banners.show', $banner);
    }

    public function send(Banner $banner)
    {
        $this->checkAccess($banner);
        try {
            $this->service->sendToModeration($banner->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('account.banners.show', $banner);
    }

    public function cancel(Banner $banner)
    {
        $this->checkAccess($banner);
        try {
            $this->service->cancelModeration($banner->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('account.banners.show', $banner);
    }

//    public function order(Banner $banner)
//    {
//        $this->checkAccess($banner);
//        try {
//            $banner = $this->service->order($banner->id);
//            $url = $this->robokassa->generateRedirectUrl($banner->id, $banner->cost, 'banner');
//            return redirect($url);
//        } catch (\DomainException $e) {
//            return back()->with('error', $e->getMessage());
//        }
//
//        return redirect()->route('account.banners.show', $banner);
//    }

    public function destroy(Banner $banner)
    {
        $this->checkAccess($banner);
        try {
            $this->service->removeByOwner($banner->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('cabinet.banners.index');
    }

    private function checkAccess(Banner $banner): void
    {
        if (!Gate::allows('manage-own-banner', $banner)) {
            abort(403);
        }
    }
}
