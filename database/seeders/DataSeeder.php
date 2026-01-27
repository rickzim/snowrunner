<?php

namespace Database\Seeders;

use App\Models\Map;
use App\Models\Depot;
use App\Models\Region;
use App\Enums\DepotType;
use App\Models\Resource;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataSeeder extends Seeder
{
    private Collection $resources;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createResources();
        $this->resources = Resource::get();

        $this->createMichigan();
    }

    private function createMichigan()
    {
        $region = Region::create([
            'name' => 'Michigan, USA',
        ]);

        /**
         * Black River
         */
        $map = $region->maps()->create([
            'name' => 'Black River'
        ]);

        $depot = $map->depots()->create(['type' => DepotType::FACTORY]);
        $depot->resources()->attach($this->getResourceIds([
            'Service Spare Parts',
        ]));

        $depot = $map->depots()->create(['type' => DepotType::WAREHOUSE]);
        $depot->resources()->attach($this->getResourceIds([
            'Bricks',
            'Concrete Blocks',
            'Metal Beams',
            'Service Spare Parts'
        ]));

        /**
         * Smithville Dam
         */
        /**
         * Island Lake
         */
        /**
         * Drummond Island
         */
    }

    private function getResourceIds(array $resources)
    {
        return $this->resources->whereIn('name', $resources)
            ->pluck('id');
    }

    private function createResources()
    {
        collect([
            // ['name' => 'XXX', 'slots' => 1],
            ['name' => 'Bricks', 'slots' => 1],
            ['name' => 'Concrete Blocks', 'slots' => 1],
            ['name' => 'Metal Beams', 'slots' => 2],
            ['name' => 'Service Spare Parts', 'slots' => 1],
            // ['name' => 'XXX', 'slots' => 1],
        ])->each(fn($item) => Resource::create($item));
    }
}
