<?php

namespace Database\Seeders;


use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Region::factory()->count(10)->create()->each(function(Region $region) {
            $region->children()->saveMany(Region::factory()->count(5)->create()->each(function(Region $region) {
                $region->children()->saveMany(Region::factory()->count(6)->make());
            }));
        });
    }
}
