<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Adverts\Advert\Advert;
use App\Models\User;
use Illuminate\Auth\Access\Response;
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

        Gate::define('admin-panel', function(User $user) {
            return $user->isAdmin()
                        ? Response::allow()
                        : Response::denyWithStatus(403);
        });

        Gate::define('show-advert', function (User $user, Advert $advert) {
            return $user->isAdmin() || $user->isModerator() || $advert->user_id === $user->id;
        });

        Gate::define('manage-own-advert', function(User $user, Advert $advert) {
           return $user->id === $advert->user_id
                           ? Response::allow()
                           : Response::denyWithStatus(403);
        });
    }
}
