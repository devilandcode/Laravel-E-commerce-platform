<?php

namespace App\Http\Controllers\Account\Adverts;

use App\Http\Controllers\Controller;
use App\Http\Middleware\FilledProfile;
use App\Http\Requests\Adverts\AttributesRequest;
use App\Http\Requests\Adverts\EditRequest;
use App\Http\Requests\Adverts\PhotosRequest;
use App\Models\Adverts\Advert\Advert;
use App\Services\Adverts\AdvertService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ManageController extends Controller
{
    public function __construct(
        private AdvertService $service)
    {
        $this->middleware(FilledProfile::class);
    }

    public function editForm(Advert $advert)
    {
        $this->checkAccess($advert);

        return view('adverts.edit.advert', compact('advert'));
    }

    public function edit(EditRequest $request, Advert $advert)
    {
        $this->checkAccess($advert);

        try {
            $this->service->edit($advert->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('adverts.show', $advert);
    }

    public function attributesForm(Advert $advert)
    {
        return view('adverts.edit.attributes', compact('advert'));
    }

    public function attributes(AttributesRequest $request, Advert $advert)
    {
        $this->checkAccess($advert);

        try {
            $this->service->editAttributes($advert->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('adverts.show', $advert);
    }

    public function photosForm(Advert $advert)
    {
        $this->checkAccess($advert);

        return view('adverts.edit.photos', compact('advert'));
    }

    public function photos(PhotosRequest $request, Advert $advert)
    {
        $this->checkAccess($advert);

        try {
            $this->service->addPhotos($advert->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('adverts.show', $advert);
    }

    public function send(Advert $advert)
    {
        $this->checkAccess($advert);

        try {
            $this->service->sendToModeration($advert->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('adverts.show', $advert);
    }

    public function close(Advert $advert)
    {
        $this->checkAccess($advert);

        try {
            $this->service->close($advert->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('adverts.show', $advert);
    }

    public function destroy(Advert $advert)
    {
        $this->checkAccess($advert);

        try {
            $this->service->remove($advert->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('cabinet.adverts.index');
    }

    private function checkAccess(Advert $advert): void
    {
        if (!Gate::allows('manage-own-advert', $advert)) {
            abort(403);
        }
    }
}
