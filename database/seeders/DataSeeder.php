<?php

namespace Database\Seeders;

use App\Models\Map;
use App\Models\Region;
use App\Enums\DepotType;
use App\Models\Resource;
use Exception;
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
        $this->createAlaska();
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
            'width' => 1000,
            'height' => 1000,
            'image_path' => 'black_river_blank.webp'
        ]);
        static::createDepot($map, DepotType::FACTORY, ['Service Spare Parts'], 910, 180);
        static::createDepot($map, DepotType::WAREHOUSE, ['Bricks', 'Concrete Blocks', 'Metal Beams', 'Service Spare Parts'], 880, 610);
        static::createDepot($map, DepotType::LOG_STATION, ['Long Logs', 'Medium Logs'], 685, 300);
        static::createDepot($map, DepotType::FARM, ['Consumables'], 490, 835);
        static::createDepot($map, DepotType::TOWN_STORAGE, ['Metal Beams'], 190, 440);
        static::createDepot($map, DepotType::LUMBER_MILL, ['Wooden Planks'], 350, 570);

        /**
         * Smithville Dam
         */
        $map = $region->maps()->create([
            'name' => 'Smithville Dam',
            'width' => 1000,
            'height' => 1000,
            'image_path' => 'smithville_dam_blank.webp'
        ]);
        static::createDepot($map, DepotType::LOGISTICS_BASE, ['Drilling Spare Parts']);
        static::createDepot($map, DepotType::QUARRY_LOADING_ZONE, ['Cargo Container']);
        static::createDepot($map, DepotType::QUARRY, ['Cement']);
        static::createDepot($map, DepotType::DRILLING_SITE, ['Fuel']);
        static::createDepot($map, DepotType::WAREHOUSE, ['Concrete Slab', 'Bricks']);
        static::createDepot($map, DepotType::WAREHOUSE, ['Metal Beams', 'Wooden Planks', 'Concrete Blocks']);
        static::createDepot($map, DepotType::FARM, ['Consumables']);
        static::createDepot($map, DepotType::SERVICE_HUB, ['Service Spare Parts', 'Vehicle Spare Parts', 'Oil Rig Drill']);
        static::createDepot($map, DepotType::LOG_STATION, ['Medium Logs']);
        static::createDepot($map, DepotType::FUEL_STATION, ['Fuel']);

        /**
         * Island Lake
         */
        $map = $region->maps()->create([
            'name' => 'Island Lake',
            'width' => 1000,
            'height' => 500,
            'image_path' => 'island_lake_blank.webp'
        ]);
        static::createDepot($map, DepotType::SAWMILL, ['Wooden Planks']);
        static::createDepot($map, DepotType::WAREHOUSE, ['Drilling Equipment']);
        static::createDepot($map, DepotType::ABANDONED_DRILLING_SITE, ['Drilling Equipment']);
        static::createDepot($map, DepotType::FALLEN_ANTENNA, ['Cargo Container']);
        static::createDepot($map, DepotType::ABANDONED_DRILLING_SITE, ['Drilling Equipment']);
        static::createDepot($map, DepotType::ABANDONED_DRILLING_SITE, ['Drilling Equipment']);
        static::createDepot($map, DepotType::LOG_STATION, ['Metal Beams', 'Wooden Planks']);
        static::createDepot($map, DepotType::LOG_STATION, ['Medium Logs']);

        /**
         * Drummond Island
         */
        $map = $region->maps()->create([
            'name' => 'Drummond Island',
            'width' => 1000,
            'height' => 1000,
            'image_path' => 'drummond_island_blank.webp'
        ]);
        static::createDepot($map, DepotType::SAWMILL, ['Oversized Cargo']);
        static::createDepot($map, DepotType::LOG_STATION, ['Wooden Planks']);
        static::createDepot($map, DepotType::LOG_STATION, ['Long Logs']);
    }

    private function createAlaska()
    {
        $region = Region::create([
            'name' => 'Alaska, USA'
        ]);

        /**
         * North Port
         */
        $map = $region->maps()->create([
            'name' => 'North Port',
            'width' => 1000,
            'height' => 1000,
            'image_path' => 'north_port_blank.webp'
        ]);
        static::createDepot($map, DepotType::PORT, ['Large Pipe', 'Consumables', 'Oversized Cargo', 'Drilling Equipment', 'Cargo Container']);
    }

    private function createDepot(Map $map, DepotType $type, array $resources, $x = 0, $y = 0)
    {
        $depot = $map->depots()->create([
            'type' => $type,
            'map_x' => $x,
            'map_y' => $y,
        ]);

        $resourceIds = $this->resources
            ->whereIn('name', $resources)
            ->pluck('id');

        if (count($resourceIds) !== count($resources)) {
            throw new Exception('found missing resources');
        }

        $depot->resources()->attach($resourceIds);
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
            ['name' => 'Short Logs', 'tons' => 4, 'size' => 2, 'icon' => 'cargoTypeLogLow40.png'],
            ['name' => 'Medium Logs', 'tons' => 8, 'size' => 3, 'icon' => 'cargoTypeLogMid40.png'],
            ['name' => 'Long Logs', 'tons' => 12, 'size' => 5, 'icon' => 'cargoTypeLogLong40.png'],
        ])->each(fn($item) => Resource::create($item));
    }
}
