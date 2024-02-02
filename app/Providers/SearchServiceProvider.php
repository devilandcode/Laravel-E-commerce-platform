<?php

namespace App\Providers;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Client::class, function (Application $app) {
            return ClientBuilder::create()
                ->setHosts(['127.0.0.1:9200'])
                ->setRetries(3)
                ->build();
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
