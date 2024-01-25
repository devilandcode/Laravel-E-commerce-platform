<?php

// routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Adverts\Category;
use App\Models\Region;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


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

// Home > admin > users
Breadcrumbs::for('admin.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.home');
    $trail->push('Users', route('admin.users.index'));
});

// Home > admin > users > create
Breadcrumbs::for('admin.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.users.index');
    $trail->push('Create', route('admin.users.create'));
});

// Home > admin > users > show
Breadcrumbs::for('admin.users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('admin.users.index');
    $trail->push($user->name, route('admin.users.show', $user));
});

// Home > admin > users > edit
Breadcrumbs::for('admin.users.edit', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('admin.users.index');
    $trail->push($user->name, route('admin.users.edit', $user));
});

// Home > admin > regions
Breadcrumbs::for('admin.regions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.home');
    $trail->push('Regions', route('admin.regions.index'));
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
    $trail->parent('adverts.index');
    $trail->push('Create', route('account.adverts.create'));
});

Breadcrumbs::for('account.adverts.create.region', function (BreadcrumbTrail $trail, Category $category, Region $region = null) {
    $trail->parent('cabinet.adverts.create');
    $trail->push($category->name, route('account.adverts.create.region', [$category, $region]));
});

Breadcrumbs::for('account.adverts.create.advert', function (BreadcrumbTrail $trail, Category $category, Region $region = null) {
    $trail->parent('cabinet.adverts.create.region', $category, $region);
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

