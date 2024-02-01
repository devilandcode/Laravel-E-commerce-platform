<?php

namespace App\Providers;

use App\Services\Banners\CostCalculator;
use App\Services\Sms\SmsRu;
use App\Services\Sms\SmsSenderInterface;
use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SmsSenderInterface::class, function(Application $app) {
            $config = $app->make('config')->get('sms');
            return new SmsRu(app('GuzzleHttp\Client'), $config['api_id']);
        });

        $this->app->singleton(CostCalculator::class, function (Application $app) {
            $config = $app->make('config')->get('banner');
            return new CostCalculator($config['price']);
        });

        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
