<?php

// routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.


use App\Http\Router\AdvertsPath;
use App\Models\Adverts\Advert\Advert;
use App\Models\Adverts\Category;
use App\Models\Region;
use App\Models\User\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.


// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > Country
Breadcrumbs::for('country', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Country', URL::to('/countries'));
});

// Home > Login
Breadcrumbs::for('login', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Login', route('login'));
});

// Home > Register
Breadcrumbs::for('register', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Register', route('register'));
});

// Admin
Breadcrumbs::for('admin.home', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Admin', route('admin.home'));
});


Breadcrumbs::for('admin.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.home');
    $trail->push('Users', route('admin.users.index'));
});


Breadcrumbs::for('admin.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.users.index');
    $trail->push('Create', route('admin.users.create'));
});


Breadcrumbs::for('admin.users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('admin.users.index');
    $trail->push($user->name, route('admin.users.show', $user));
});


Breadcrumbs::for('admin.users.edit', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('admin.users.index');
    $trail->push($user->name, route('admin.users.edit', $user));
});


Breadcrumbs::for('admin.regions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.home');
    $trail->push('Regions', route('admin.regions.index'));
});

Breadcrumbs::for('admin.adverts.adverts.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.home');
    $trail->push('Categories', route('admin.adverts.adverts.index'));
});

Breadcrumbs::for('admin.adverts.adverts.edit', function (BreadcrumbTrail $trail, Advert $advert) {
    $trail->parent('admin.home', $advert);
    $trail->push($advert->title, route('admin.adverts.adverts.edit', $advert));
});


// Adverts
Breadcrumbs::for('adverts.inner_region', function (BreadcrumbTrail $trail, AdvertsPath $path) {
    if ($path->region && $parent = $path->region->parent) {
        $trail->parent('adverts.inner_region', $path->withRegion($parent));
    } else {
        $trail->parent('home');
        $trail->push('Adverts', route('adverts.index'));
    }
    if ($path->region) {
        $trail->push($path->region->name, route('adverts.index', $path));
    }
});

Breadcrumbs::for('adverts.inner_category', function (BreadcrumbTrail $trail, AdvertsPath $path, AdvertsPath $orig) {
    if ($path->category && $parent = $path->category->parent) {
        $trail->parent('adverts.inner_category', $path->withCategory($parent), $orig);
    } else {
        $trail->parent('adverts.inner_region', $orig);
    }
    if ($path->category) {
        $trail->push($path->category->name, route('adverts.index', $path));
    }
});

Breadcrumbs::for('adverts.index', function (BreadcrumbTrail $trail, AdvertsPath $path = null) {
    $path = $path ?: adverts_path(null, null);
    $trail->parent('adverts.inner_category', $path, $path);
});

Breadcrumbs::for('adverts.show', function (BreadcrumbTrail $trail, Advert $advert) {
    $trail->parent('adverts.index', adverts_path($advert->region, $advert->category));
    $trail->push($advert->title, route('adverts.show', $advert));
});


// Account
Breadcrumbs::for('account.home', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Account', route('account.home'));
});


// Account Adverts
Breadcrumbs::for('account.adverts.index', function (BreadcrumbTrail $trail) {
    $trail->parent('account.home');
    $trail->push('Adverts', route('account.adverts.index'));
});

Breadcrumbs::for('account.adverts.create', function (BreadcrumbTrail $trail) {
    $trail->parent('account.adverts.index');
    $trail->push('Create', route('account.adverts.create'));
});

Breadcrumbs::for('account.adverts.edit', function (BreadcrumbTrail $trail, Advert $advert) {
    $trail->parent('adverts.show', $advert);
    $trail->push('Edit', route('account.adverts.edit', $advert));
});

Breadcrumbs::for('account.adverts.create.region', function (BreadcrumbTrail $trail, Category $category, Region $region = null) {
    $trail->parent('account.adverts.create');
    $trail->push($category->name, route('account.adverts.create.region', [$category, $region]));
});

Breadcrumbs::for('account.adverts.create.advert', function (BreadcrumbTrail $trail, Category $category, Region $region = null) {
    $trail->parent('account.adverts.create.region', $category, $region);
    $trail->push($region ? $region->name : 'All', route('account.adverts.create.advert', [$category, $region]));
});


//Profile
Breadcrumbs::for('account.profile.home', function (BreadcrumbTrail $trail) {
    $trail->parent('account.home');
    $trail->push('Profile', route('account.profile.home'));
});

Breadcrumbs::for('account.profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('account.profile.home');
    $trail->push('Edit', route('account.profile.edit'));
});

Breadcrumbs::for('account.profile.phone', function (BreadcrumbTrail $trail) {
    $trail->parent('account.profile.home');
    $trail->push('Phone', route('account.profile.phone'));
});

