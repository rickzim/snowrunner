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
            ['name' => 'Bricks', 'tons' => 1, 'size' => 1, 'icon' => 'cargoTypeBrick40.png'],
            ['name' => 'Cement', 'tons' => 3, 'size' => 1, 'icon' => 'cargoTypeBags40.png'],
            ['name' => 'Concrete Blocks', 'tons' => 3, 'size' => 1, 'icon' => 'cargoTypeBlock40.png'],
            ['name' => 'Concrete Slab', 'tons' => 6, 'size' => 2, 'icon' => 'cargoTypeSlabBig40.png'],
            ['name' => 'Packaged Sand', 'tons' => 3, 'size' => 1, 'icon' => 'cargoTypeSand40.png'],
            ['name' => 'Consumables', 'tons' => 3, 'size' => 1, 'icon' => 'cargoTypeBigBox40.png'],
            ['name' => 'Fuel', 'tons' => 2, 'size' => 1, 'icon' => 'cargoTypeBarrel40.png'],
            ['name' => 'Oil Barrels', 'tons' => 2, 'size' => 1, 'icon' => 'cargoTypeBarrelMasut40.png'],
            ['name' => 'Secure Container', 'tons' => 1, 'size' => 1, 'icon' => 'cargoTypeRadioactive40.png'],
            ['name' => 'Service Spare Parts', 'tons' => 1, 'size' => 1, 'icon' => 'cargoTypeServiceSpareParts40.png'],
            ['name' => 'Vehicle Spare Parts', 'tons' => 1, 'size' => 1, 'icon' => 'cargoTypeVehiclesSpareParts40.png'],
            ['name' => 'Drilling Spare Parts', 'tons' => 1, 'size' => 1, 'icon' => 'cargoTypeSparePartsTown40.png'],

            ['name' => 'Drilling Equipment', 'tons' => 10, 'size' => 4, 'icon' => 'cargoTypeContainerDrilling40.png'],
            ['name' => 'Oil Rig Drill', 'tons' => 10, 'size' => 5, 'icon' => 'cargoTypeBigDrills40.png'],

            ['name' => 'Metal Rolls', 'tons' => 1, 'size' => 1, 'icon' => 'cargoTypeSteelRoll40.png'],
            ['name' => 'Metal Beams', 'tons' => 5, 'size' => 2, 'icon' => 'cargoTypeMetall40.png'],
            ['name' => 'Small Pipes', 'tons' => 4, 'size' => 2, 'icon' => 'cargoTypePipe40.png'],
            ['name' => 'Medium Pipes', 'tons' => 5, 'size' => 2, 'icon' => 'cargoTypePipeAverage40.png'],
            ['name' => 'Large Pipe', 'tons' => 8, 'size' => 4, 'icon' => 'cargoTypePipeBig40.png'],

            ['name' => 'Rail Section', 'tons' => 1, 'size' => 5, 'icon' => 'cargoTypeRails40.png'],
            ['name' => 'Industrial Boiler', 'tons' => 1, 'size' => 5, 'icon' => 'cargoTypeBoiler40.png'],

            ['name' => 'Cabin', 'tons' => 3, 'size' => 2, 'icon' => 'cargoTypeChangeHouse40.png'],
            ['name' => 'Cargo Container', 'tons' => 3, 'size' => 2, 'icon' => 'cargoTypeContainerAlt40.png'],
            ['name' => 'Special Cargo', 'tons' => 3, 'size' => 2, 'icon' => 'cargoTypeContainerAlt40.png'],
            ['name' => 'Oversized Cargo', 'tons' => 10, 'size' => 4, 'icon' => 'cargoTypeContainerAlt40.png'],

            ['name' => 'Cellulose', 'tons' => 2, 'size' => 1, 'icon' => 'cargoTypePaper40.png'],
            ['name' => 'Wooden Planks', 'tons' => 1, 'size' => 1, 'icon' => 'cargoTypePlank40.png'],

            ['name' => 'Short Logs*', 'tons' => 4, 'size' => 2, 'icon' => 'cargoTypeLogLow40.png'],
            ['name' => 'Medium Logs*', 'tons' => 8, 'size' => 3, 'icon' => 'cargoTypeLogMid40.png'],
            ['name' => 'Long Logs*', 'tons' => 12, 'size' => 5, 'icon' => 'cargoTypeLogLong40.png'],
        ])->each(fn($item) => Resource::create($item));
    }
}
