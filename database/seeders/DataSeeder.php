<?php

namespace Database\Seeders;

use App\Enums\DepotType;
use App\Models\Region;
use App\Models\Resource;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

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
            'name' => 'Black River',
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
            'Service Spare Parts',
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
            ['name' => 'Bricks', 'tons' => 1, 'size' => 1],
            ['name' => 'Cement', 'tons' => 3, 'size' => 1],
            ['name' => 'Concrete Blocks', 'tons' => 3, 'size' => 1],
            ['name' => 'Concrete Slab', 'tons' => 6, 'size' => 2],
            ['name' => 'Packaged Sand', 'tons' => 3, 'size' => 1],
            ['name' => 'Consumables', 'tons' => 3, 'size' => 1],
            ['name' => 'Fuel', 'tons' => 2, 'size' => 1],
            ['name' => 'Oil Barrels', 'tons' => 2, 'size' => 1],
            ['name' => 'Secure Container', 'tons' => 1, 'size' => 1],
            ['name' => 'Service Spare Parts', 'tons' => 1, 'size' => 1],
            ['name' => 'Vehicle Spare Parts', 'tons' => 1, 'size' => 1],
            ['name' => 'Drilling Spare Parts', 'tons' => 1, 'size' => 1],

            ['name' => 'Drilling Equipment', 'tons' => 10, 'size' => 4],
            ['name' => 'Oil Rig Drill', 'tons' => 10, 'size' => 5],

            ['name' => 'Metal Rolls', 'tons' => 1, 'size' => 1],
            ['name' => 'Metal Beams', 'tons' => 5, 'size' => 2],
            ['name' => 'Small Pipes', 'tons' => 4, 'size' => 2],
            ['name' => 'Medium Pipes', 'tons' => 5, 'size' => 2],
            ['name' => 'Large Pipe', 'tons' => 8, 'size' => 4],

            ['name' => 'Rail Section', 'tons' => 1, 'size' => 5],
            ['name' => 'Rails', 'tons' => 1, 'size' => 4],
            ['name' => 'Industrial Boiler', 'tons' => 1, 'size' => 5],

            ['name' => 'Cabin', 'tons' => 3, 'size' => 2],
            ['name' => 'Cargo Container', 'tons' => 3, 'size' => 2],
            ['name' => 'Special Cargo', 'tons' => 3, 'size' => 2],
            ['name' => 'Oversized Cargo', 'tons' => 10, 'size' => 4],

            ['name' => 'Cellulose', 'tons' => 2, 'size' => 1],
            ['name' => 'Wooden Planks', 'tons' => 1, 'size' => 1],

            ['name' => 'Short Logs', 'tons' => 4, 'size' => '2*'],
            ['name' => 'Medium Logs', 'tons' => 8, 'size' => '3*'],
            ['name' => 'Long Logs', 'tons' => 12, 'size' => '5*'],
            ['name' => 'Sequoia', 'tons' => 1, 'size' => 5],

            ['name' => 'Airplane Fuselage', 'tons' => 10, 'size' => 5],
            ['name' => 'Airplane Wing', 'tons' => 2, 'size' => 4],
            ['name' => 'Airplane Wing/Engine', 'tons' => 2, 'size' => 5],

            ['name' => 'BA-20 Armored Car', 'tons' => 3, 'size' => 2],
            ['name' => 'Diesel Locomotive', 'tons' => 200, 'size' => 10],

            ['name' => 'Portable Cabin', 'tons' => 3, 'size' => 2],
            ['name' => 'Engine Assembly', 'tons' => 3, 'size' => 1],
            ['name' => 'Stage 2 Fuel Tank', 'tons' => 2, 'size' => 3],
            ['name' => 'Stage 3 Fuel Tank', 'tons' => 2, 'size' => 3],

            ['name' => 'Rocket Carrier Platform', 'tons' => 325, 'size' => 12],
        ])->each(fn ($item) => Resource::create($item));
    }
}
