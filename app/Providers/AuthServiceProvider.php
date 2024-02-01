<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Adverts\Advert\Advert;
use App\Models\Banner\Banner;
use App\Models\User\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        $this->registerPermissions();
    }

    private function registerPermissions()
    {
        Gate::define('admin-panel', function(User $user) {
            return $user->isAdmin() || $user->isModerator();
        });

        Gate::define('show-advert', function (User $user, Advert $advert) {
            return $user->isAdmin() || $user->isModerator() || $advert->user_id === $user->id;
        });

        Gate::define('manage-users', function (User $user) {
            return $user->isAdmin() || $user->isModerator();
        });

        Gate::define('manage-own-advert', function(User $user, Advert $advert) {
            return $user->id === $advert->user_id;
        });

        Gate::define('manage-adverts', function (User $user) {
            return $user->isAdmin() || $user->isModerator();
        });

        Gate::define('manage-regions', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-adverts-categories', function (User $user) {
            return $user->isAdmin() || $user->isModerator();
        });

        Gate::define('manage-own-banner', function (User $user, Banner $banner) {
            return $banner->user_id === $user->id;
        });

        Gate::define('manage-banners', function (User $user) {
            return $user->isAdmin() || $user->isModerator();
        });
    }
}
