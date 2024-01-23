<?php

namespace App\Providers;

use App\Services\Sms\SmsRu;
use App\Services\Sms\SmsSenderInterface;
use GuzzleHttp\Client;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SmsSenderInterface::class, function($app) {
            $config = $app->make('config')->get('sms');
            return new SmsRu(app('GuzzleHttp\Client'), $config['api_id']);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
