<?php

namespace App\Services\Adverts;

use Illuminate\Pagination\LengthAwarePaginator;

class SearchResult
{
    public function __construct(
        public LengthAwarePaginator $adverts,
        public array $regionsCounts,
        public array $categoriesCounts)
    {

    }

}
