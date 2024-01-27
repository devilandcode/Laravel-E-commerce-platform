<?php

namespace App\Console\Commands\Search;

use Elastic\Elasticsearch\Client;
use Illuminate\Console\Command;

class InitCommand extends Command
{
    protected $signature = 'search:init';

    protected $description = 'Init ElasticSearch';
    public function __construct( private Client $client)
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $this->client->indices()->delete([
                'index' => 'adverts'
            ]);
        } catch (Missing404Exception $e) {
        }
        $this->client->indices()->create([
            'index' => 'adverts',
            'body' => [

            ],
        ]);
    }
}
