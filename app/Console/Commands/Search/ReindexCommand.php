<?php

namespace App\Console\Commands\Search;

use App\Models\Adverts\Advert\Advert;
use App\Services\Search\AdvertIndexer;
use Illuminate\Console\Command;

class ReindexCommand extends Command
{

    protected $signature = 'search:reindex';

    protected $description = 'Index items';

    public function __construct(private AdvertIndexer $adverts)
    {
        parent::__construct();
    }

    public function handle(): bool
    {
        $this->adverts->clear();

        foreach (Advert::active()->orderBy('id')->cursor() as $advert) {
            $this->adverts->index($advert);
        }

        return true;
    }
}
