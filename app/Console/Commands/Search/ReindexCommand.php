<?php

namespace App\Console\Commands\Search;

use App\Models\Adverts\Advert\Advert;
use App\Models\Banner\Banner;
use App\Services\Search\AdvertIndexer;
use App\Services\Search\BannerIndexer;
use Illuminate\Console\Command;

class ReindexCommand extends Command
{

    protected $signature = 'search:reindex';

    protected $description = 'Index items';

    public function __construct(private AdvertIndexer $adverts, private BannerIndexer $banners)
    {
        parent::__construct();
    }

    public function handle(): bool
    {
        $this->adverts->clear();

        foreach (Advert::active()->orderBy('id')->cursor() as $advert) {
            $this->adverts->index($advert);
        }

        $this->banners->clear();

        foreach (Banner::active()->orderBy('id')->cursor() as $banner) {
            $this->banners->index($banner);
        }

        return true;
    }
}
