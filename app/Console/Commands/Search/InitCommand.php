<?php

namespace App\Console\Commands\Search;

use App\Models\Adverts\Advert\Advert;
use App\Models\Adverts\Advert\Value;
use Elastic\Elasticsearch\Client;
use Illuminate\Console\Command;

class InitCommand extends Command
{
    protected $signature = 'search:init';

    protected $description = 'create index';
    public function __construct( private Client $client)
    {
        parent::__construct();
    }

    public function handle(): bool
    {
        $this->initAdverts();
        $this->initBanners();

        return true;
    }

    private function initAdverts(): void
    {
        try {
            $this->client->indices()->delete([
                'index' => 'adverts'
            ]);
        } catch (\Exception $e) {
        }
        $this->client->indices()->create([
            'index' => 'adverts',
            'body' => [
                'mappings' => [
                    'properties' => [
                        'id' => [
                            'type' => 'integer',
                        ],
                        'published_at' => [
                            'type' => 'date',
                        ],
                        'title' => [
                            'type' => 'text',
                        ],
                        'content' => [
                            'type' => 'text',
                        ],
                        'price' => [
                            'type' => 'integer',
                        ],
                        'status' => [
                            'type' => 'keyword',
                        ],
                        'categories' => [
                            'type' => 'integer',
                        ],
                        'regions' => [
                            'type' => 'integer',
                        ],
                        'values' => [
                            'type' => 'nested',
                            'properties' => [
                                'attribute' => [
                                    'type' => 'integer'
                                ],
                                'value_string' => [
                                    'type' => 'keyword',
                                ],
                                'value_int' => [
                                    'type' => 'integer',
                                ],
                            ],
                        ],
                    ],
                ],
                'settings' => [
                    'analysis' => [
                        'char_filter' => [
                            'replace' => [
                                'type' => 'mapping',
                                'mappings' => [
                                    '&=> and '
                                ],
                            ],
                        ],
                        'filter' => [
                            'word_delimiter' => [
                                'type' => 'word_delimiter',
                                'split_on_numerics' => false,
                                'split_on_case_change' => true,
                                'generate_word_parts' => true,
                                'generate_number_parts' => true,
                                'catenate_all' => true,
                                'preserve_original' => true,
                                'catenate_numbers' => true,
                            ],
                            'trigrams' => [
                                'type' => 'ngram',
                                'min_gram' => 3,
                                'max_gram' => 4,
                            ],
                        ],
                        'analyzer' => [
                            'default' => [
                                'type' => 'custom',
                                'char_filter' => [
                                    'html_strip',
                                    'replace',
                                ],
                                'tokenizer' => 'whitespace',
                                'filter' => [
                                    'lowercase',
                                    'word_delimiter',
                                    'trigrams',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }

    private function initBanners(): void
    {
        try {
            $this->client->indices()->delete([
                'index' => 'banners'
            ]);
        } catch (\Exception $e) {
        }

        $this->client->indices()->create([
            'index' => 'banners',
            'body' => [
                'mappings' => [
                    'properties' => [
                        'id' => [
                            'type' => 'integer',
                        ],
                        'status' => [
                            'type' => 'keyword',
                        ],
                        'format' => [
                            'type' => 'keyword',
                        ],
                        'categories' => [
                            'type' => 'integer',
                        ],
                        'regions' => [
                            'type' => 'integer',
                        ],
                    ],
                ],
            ],
        ]);
    }
}
