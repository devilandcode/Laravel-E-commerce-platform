<?php

namespace App\Services\Search;


use App\Models\Banner\Banner;
use App\Models\Region;
use Elastic\Elasticsearch\Client;

class BannerIndexer
{
    public function __construct(private Client $client)
    {
    }

    public function clear(): void
    {
        $this->client->deleteByQuery([
            'index' => 'banners',
            'body' => [
                'query' => [
                    'match_all' => new \stdClass(),
                ],
            ],
        ]);
    }

    public function index(Banner $banner): void
    {
        $regionIds = [0];
        if ($banner->region) {
            $regionIds = [$banner->region->id];
            $childrenIds = $regionIds;
            while ($childrenIds = Region::whereIn('parent_id', $childrenIds)->pluck('id')->toArray()) {
                $regionIds = array_merge($regionIds, $childrenIds);
            }
        }

        $this->client->index([
            'index' => 'banners',
            'id' => $banner->id,
            'body' => [
                'id' => $banner->id,
                'status' => $banner->status,
                'format' => $banner->format,
                'categories' => array_merge(
                    [$banner->category->id],
                    $banner->category->descendants()->pluck('id')->toArray()
                ),
                'regions' => $regionIds,
            ],
        ]);
    }

    public function remove(Banner $banner): void
    {
        $this->client->delete([
            'index' => 'banners',
            'id' => $banner->id,
        ]);
    }
}
