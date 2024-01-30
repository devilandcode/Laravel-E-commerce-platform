<?php

namespace App\Services\Banners;

class CostCalculator
{
    public function __construct(private int $price)
    {
    }

    public function calc(int $views): int
    {
        return floor($this->price * ($views / 1000));
    }
}
