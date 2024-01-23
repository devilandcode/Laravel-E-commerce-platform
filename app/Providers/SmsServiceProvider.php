<?php

namespace App\Providers;

use App\Services\Sms\ArraySender;
use App\Services\Sms\SmsRu;
use App\Services\Sms\SmsSenderInterface;
use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SmsSenderInterface::class, function (Application $app) {
            $config = $app->make('config')->get('sms');

            switch ($config['driver']) {
                case 'sms.ru':
                    $params = $config['drivers']['sms.ru'];
                    if (!empty($params['url'])) {
                        return new SmsRu(app(Client::class),$params['api_id']);
                    }
                    return new SmsRu(app(Client::class),$params['api_id']);
                case 'array':
                    return new ArraySender();
                default:
                    throw new \InvalidArgumentException('Undefined SMS driver ' . $config['driver']);
            }
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
