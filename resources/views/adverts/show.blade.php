@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render() }}

    @if ($advert->isDraft())
        <div class="alert alert-danger">
            It is a draft.
        </div>
        @if ($advert->reject_reason)
            <div class="alert alert-danger">
                {{ $advert->reject_reason }}
            </div>
        @endif
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
        {{ session('error') }}
        </div>
    @endif

    @can ('manage-adverts')
        <div class="d-flex flex-row mb-3">
            <a href="{{ route('admin.adverts.adverts.edit', $advert) }}" class="btn btn-primary me-1">Edit</a>
            <a href="{{ route('admin.adverts.adverts.photos', $advert) }}" class="btn btn-primary me-1">Photos</a>

            @if ($advert->isOnModeration())
                <form method="POST" action="{{ route('admin.adverts.adverts.moderate', $advert) }}" class="me-1">
                    @csrf
                    <button class="btn btn-success">Moderate</button>
                </form>
            @endif

            @if ($advert->isOnModeration() || $advert->isActive())
                <a href="{{ route('admin.adverts.adverts.reject', $advert) }}" class="btn btn-danger me-1">Reject</a>
            @endif

            <form method="POST" action="{{ route('admin.adverts.adverts.destroy', $advert) }}" class="me-1">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
    @endcan

    @can ('manage-own-advert', $advert)
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('account.adverts.edit', $advert) }}" class="btn btn-primary me-1">Edit</a>
                <a href="{{ route('account.adverts.photos', $advert) }}" class="btn btn-primary me-1">Photos</a>

                @if ($advert->isDraft())
                    <form method="POST" action="{{ route('account.adverts.send', $advert) }}" class="me-1">
                        @csrf
                        <button class="btn btn-success">Publish</button>
                    </form>
                @endif
                @if ($advert->isActive())
                    <form method="POST" action="{{ route('account.adverts.close', $advert) }}" class="me-1">
                        @csrf
                        <button class="btn btn-success">Close</button>
                    </form>
                @endif

                <form method="POST" action="{{ route('account.adverts.destroy', $advert) }}" class="me-1">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>
    @endcan

    <div class="row">
        <div class="col-md-9">

            <p class="float-right" style="font-size: 36px;">{{ $advert->price }}</p>
            <h1 style="margin-bottom: 10px">{{ $advert->title  }}</h1>
            <p>
                @if ($advert->expires_at)
                    Date: {{ $advert->published_at }} &nbsp;
                @endif
                @if ($advert->expires_at)
                    Expires: {{ $advert->expires_at }}
                @endif
            </p>

            <div style="margin-bottom: 20px">
                <div class="row">
                    <div class="col-10">
                        <div style="height: 400px; background: #f6f6f6; border: 1px solid #ddd"></div>
                    </div>
                    <div class="col-2">
                        <div style="height: 100px; background: #f6f6f6; border: 1px solid #ddd"></div>
                        <div style="height: 100px; background: #f6f6f6; border: 1px solid #ddd"></div>
                        <div style="height: 100px; background: #f6f6f6; border: 1px solid #ddd"></div>
                        <div style="height: 100px; background: #f6f6f6; border: 1px solid #ddd"></div>
                    </div>
                </div>
            </div>

            <p>{{ nl2br(e($advert->content)) }}</p>

            <table class="table table-bordered">
                <tbody>
                @foreach ($advert->category->allAttributes() as $attribute)
                    <tr>
                        <th>{{ $attribute->name }}</th>
                        <td>{{ $advert->getValue($attribute->id) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <p>Address: {{ $advert->address }}</p>

            <div style="height: 300px; margin: 20px 0; border: 1px solid #ddd">
                <div id="map" style="width: 100%; height: 300px"></div>
            </div>

            <p style="margin-bottom: 20px">Seller: {{ $advert->user->name }}</p>

            <div class="d-flex flex-row mb-3">
                <span class="btn btn-success me-1"><span class="fa fa-envelope"></span> Send Message</span>
                <span class="btn btn-primary phone-button me-1" data-source="{{ route('adverts.phone', $advert) }}"><span class="fa fa-phone"></span> <span class="number">Show Phone Number</span></span>
{{--                @if ($user && $user->hasInFavorites($advert->id))--}}
{{--                    <form method="POST" action="{{ route('adverts.favorites', $advert) }}" class="mr-1">--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}
{{--                        <button class="btn btn-secondary"><span class="fa fa-star"></span> Remove from Favorites</button>--}}
{{--                    </form>--}}
{{--                @else--}}
{{--                    <form method="POST" action="{{ route('adverts.favorites', $advert) }}" class="mr-1">--}}
{{--                        @csrf--}}
{{--                        <button class="btn btn-danger"><span class="fa fa-star"></span> Add to Favorites</button>--}}
{{--                    </form>--}}
{{--                @endif--}}
            </div>

            <hr/>

            <div class="h3">Similar adverts</div>

            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="https://images.pexels.com/photos/297933/pexels-photo-297933.jpeg?w=1260&h=750&auto=compress&cs=tinysrgb" alt=""/>
                        <div class="card-body">
                            <div class="card-title h4 mt-0" style="margin: 10px 0"><a href="#">The First Thing</a></div>
                            <p class="card-text" style="color: #666">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="https://images.pexels.com/photos/297933/pexels-photo-297933.jpeg?w=1260&h=750&auto=compress&cs=tinysrgb" alt=""/>
                        <div class="card-body">
                            <div class="card-title h4 mt-0" style="margin: 10px 0"><a href="#">The First Thing</a></div>
                            <p class="card-text" style="color: #666">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="https://images.pexels.com/photos/297933/pexels-photo-297933.jpeg?w=1260&h=750&auto=compress&cs=tinysrgb" alt=""/>
                        <div class="card-body">
                            <div class="card-title h4 mt-0" style="margin: 10px 0"><a href="#">The First Thing</a></div>
                            <p class="card-text" style="color: #666">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-3">
            <div style="height: 400px; background: #f6f6f6; border: 1px solid #ddd; margin-bottom: 20px"></div>
            <div style="height: 400px; background: #f6f6f6; border: 1px solid #ddd; margin-bottom: 20px"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://api-maps.yandex.ru/2.1/?apikey=049a437c-003d-47db-8f0b-351c672407db&lang=ru_RU" type="text/javascript"></script>
    <script type='text/javascript'>
        ymaps.ready(init);

        function init(){

            var myMap = new ymaps.Map('map', {
                center: [55.753994, 37.622093],
                zoom: 9
            });

            var geocoder = ymaps.geocode(
                '{{ $advert->address }}',
                { results: 1 }
            );
            geocoder.then(
                function (res) {
                    var firstGeoObject = res.geoObjects.get(0),
                        coords = firstGeoObject.geometry.getCoordinates(),
                        bounds = firstGeoObject.properties.get('boundedBy');
                    firstGeoObject.options.set('preset', 'islands#darkBlueDotIconWithCaption');
                    firstGeoObject.properties.set('iconCaption', firstGeoObject.getAddressLine());
                    myMap.geoObjects.add(firstGeoObject);
                    myMap.setBounds(bounds, {
                        checkZoomRange: true
                    });
                }
            );
        }
    </script>
@endsection
