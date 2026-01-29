<?php

namespace Database\Seeders;

use App\Enums\LocationIcon;
use Exception;
use App\Models\Map;
use App\Models\Region;
use App\Models\Resource;
use App\Enums\LocationType;
use App\Enums\ResourceIcon;
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

        $region = Region::create(['name' => 'Michigan, USA']);
        $this->createBlackRiver($region);

        $region = Region::create(['name' => 'Alaska, USA']);
        $this->createNorthPort($region);
    }

    private function createBlackRiver(Region $region)
    {
        $map = $region->maps()->create([
            'name' => 'Black River',
            'width' => 1000,
            'height' => 1000,
            'map_image' => 'black_river_blank.webp'
        ]);
        static::createLocation($map, LocationType::FACTORY, LocationIcon::FACTORY, 910, 180, ['Service Spare Parts'], true, true);
        static::createLocation($map, LocationType::WAREHOUSE, LocationIcon::CONSTRUCTION_WAREHOUSE, 880, 610, ['Bricks', 'Concrete Blocks', 'Metal Beams', 'Service Spare Parts']);
        static::createLocation($map, LocationType::LOG_STATION, LocationIcon::LUMBERJACK, 685, 300, ['Long Logs', 'Medium Logs']);
        static::createLocation($map, LocationType::FARM, LocationIcon::FARM, 490, 835, ['Consumables']);
        static::createLocation($map, LocationType::FUEL_STATION, LocationIcon::FUEL_STATION, 0, 0);
        static::createLocation($map, LocationType::TOWN_STORAGE, LocationIcon::TOWN_STORAGE, 190, 440, ['Metal Beams']);
        static::createLocation($map, LocationType::LUMBER_MILL, LocationIcon::SAWMILL, 350, 570, ['Wooden Planks']);
        static::createLocation($map, LocationType::FUEL_STATION, LocationIcon::FUEL_STATION);
        static::createLocation($map, LocationType::TRAILER_STORE, LocationIcon::TRAILER_SHOP);
        static::createLocation($map, LocationType::TRAILER_STORE, LocationIcon::TRAILER_SHOP);
        static::createLocation($map, LocationType::GATEWAY, LocationIcon::GATEWAY, 115, 145, description: 'Smithville Dam');
    }

    private function createSmithvilleDam(Region $region)
    {
        // $map = $region->maps()->create([
        //     'name' => 'Smithville Dam',
        //     'width' => 1000,
        //     'height' => 1000,
        //     'map_image' => 'smithville_dam_blank.webp'
        // ]);
        // static::createLocation($map, DepotType::LOGISTICS_BASE, ['Drilling Spare Parts'], 85, 100);
        // static::createLocation($map, DepotType::QUARRY_LOADING_ZONE, ['Cargo Container'], 480, 675);
        // static::createLocation($map, DepotType::QUARRY, ['Cement'], 490, 670);
        // static::createLocation($map, DepotType::DRILLING_SITE, ['Fuel'], 245, 385);
        // static::createLocation($map, DepotType::WAREHOUSE, ['Concrete Slab', 'Bricks'], 410, 490);
        // static::createLocation($map, DepotType::WAREHOUSE, ['Metal Beams', 'Wooden Planks', 'Concrete Blocks'], 110, 790);
        // static::createLocation($map, DepotType::FARM, ['Consumables'], 480, 180);
        // static::createLocation($map, DepotType::SERVICE_HUB, ['Service Spare Parts', 'Vehicle Spare Parts', 'Oil Rig Drill'], 910, 120);
        // static::createLocation($map, DepotType::LOG_STATION, ['Medium Logs'], 310, 120);
        // static::createLocation($map, DepotType::FUEL_STATION, ['Fuel'], 940, 320);
    }

    private function createIslandLake(Region $region)
    {
        $map = $region->maps()->create([
            'name' => 'Island Lake',
            'width' => 1000,
            'height' => 500,
            'map_image' => 'island_lake_blank.webp'
        ]);
        // static::createLocation($map, DepotType::SAWMILL, ['Wooden Planks']);
        // static::createLocation($map, DepotType::WAREHOUSE, ['Drilling Equipment']);
        // static::createLocation($map, DepotType::ABANDONED_DRILLING_SITE, ['Drilling Equipment']);
        // static::createLocation($map, DepotType::FALLEN_ANTENNA, ['Cargo Container']);
        // static::createLocation($map, DepotType::ABANDONED_DRILLING_SITE, ['Drilling Equipment']);
        // static::createLocation($map, DepotType::ABANDONED_DRILLING_SITE, ['Drilling Equipment']);
        // static::createLocation($map, DepotType::LOG_STATION, ['Metal Beams', 'Wooden Planks']);
        // static::createLocation($map, DepotType::LOG_STATION, ['Medium Logs']);
    }
    private function createDrummondIsland(Region $region)
    {
        $map = $region->maps()->create([
            'name' => 'Drummond Island',
            'width' => 1000,
            'height' => 1000,
            'map_image' => 'drummond_island_blank.webp'
        ]);
        // static::createLocation($map, DepotType::SAWMILL, ['Oversized Cargo']);
        // static::createLocation($map, DepotType::LOG_STATION, ['Wooden Planks']);
        // static::createLocation($map, DepotType::LOG_STATION, ['Long Logs']);
    }

    private function createNorthPort(Region $region)
    {
        // $map = $region->maps()->create([
        //     'name' => 'North Port',
        //     'width' => 1000,
        //     'height' => 1000,
        //     'map_image' => 'north_port_blank.webp'
        // ]);
        // static::createLocation($map, DepotType::PORT, ['Large Pipe', 'Consumables', 'Oversized Cargo', 'Drilling Equipment', 'Cargo Container']);
    }

    private function createLocation(
        Map $map,
        LocationType $type,
        ?LocationIcon $icon,
        int $x = 0,
        int $y = 0,
        array $resources = [],
        bool $isLockable = false,
        bool $isLocked = false,
        ?string $description = null
    ) {
        $locations = $map->locations()->create([
            'type' => $type,
            'description' => $description,
            'icon' => $icon,
            'map_x' => $x,
            'map_y' => $y,
            'is_lockable' => $isLockable,
            'is_locked' => $isLocked,
        ]);

        $resourceIds = $this->resources
            ->whereIn('name', $resources)
            ->pluck('id');

        if (count($resourceIds) !== count($resources)) {
            throw new Exception('found missing resources');
        }

        $locations->resources()->attach($resourceIds);
    }

    private function createResources()
    {
        collect([
            ['name' => 'Bricks', 'tons' => 1, 'size' => 1, 'icon' => ResourceIcon::BRICK],
            ['name' => 'Cement', 'tons' => 3, 'size' => 1, 'icon' => ResourceIcon::BAGS],
            ['name' => 'Concrete Blocks', 'tons' => 3, 'size' => 1, 'icon' => ResourceIcon::BLOCK],
            ['name' => 'Concrete Slab', 'tons' => 6, 'size' => 2, 'icon' => ResourceIcon::SLAB_BIG],
            ['name' => 'Packaged Sand', 'tons' => 3, 'size' => 1, 'icon' => ResourceIcon::SAND],
            ['name' => 'Consumables', 'tons' => 3, 'size' => 1, 'icon' => ResourceIcon::BIG_BOX],
            ['name' => 'Fuel', 'tons' => 2, 'size' => 1, 'icon' => ResourceIcon::BARREL],
            ['name' => 'Oil Barrels', 'tons' => 2, 'size' => 1, 'icon' => ResourceIcon::BARREL_MASUT],
            ['name' => 'Secure Container', 'tons' => 1, 'size' => 1, 'icon' => ResourceIcon::RADIOACTIVE],
            ['name' => 'Service Spare Parts', 'tons' => 1, 'size' => 1, 'icon' => ResourceIcon::SERVICE_SPARE_PARTS],
            ['name' => 'Vehicle Spare Parts', 'tons' => 1, 'size' => 1, 'icon' => ResourceIcon::VEHICLES_SPARE_PARTS],
            ['name' => 'Drilling Spare Parts', 'tons' => 1, 'size' => 1, 'icon' => ResourceIcon::SPARE_PARTS_TOWN],
            ['name' => 'Drilling Equipment', 'tons' => 10, 'size' => 4, 'icon' => ResourceIcon::CONTAINER_DRILLING],
            ['name' => 'Oil Rig Drill', 'tons' => 10, 'size' => 5, 'icon' => ResourceIcon::BIG_DRILLS],
            ['name' => 'Metal Rolls', 'tons' => 1, 'size' => 1, 'icon' => ResourceIcon::STEEL_ROLL],
            ['name' => 'Metal Beams', 'tons' => 5, 'size' => 2, 'icon' => ResourceIcon::METALL],
            ['name' => 'Small Pipes', 'tons' => 4, 'size' => 2, 'icon' => ResourceIcon::PIPE],
            ['name' => 'Medium Pipes', 'tons' => 5, 'size' => 2, 'icon' => ResourceIcon::PIPE_AVERAGE],
            ['name' => 'Large Pipe', 'tons' => 8, 'size' => 4, 'icon' => ResourceIcon::PIPE_BIG],
            ['name' => 'Rail Section', 'tons' => 1, 'size' => 5, 'icon' => ResourceIcon::RAILS],
            ['name' => 'Industrial Boiler', 'tons' => 1, 'size' => 5, 'icon' => ResourceIcon::BOILER],
            ['name' => 'Cabin', 'tons' => 3, 'size' => 2, 'icon' => ResourceIcon::CHANGE_HOUSE],
            ['name' => 'Cargo Container', 'tons' => 3, 'size' => 2, 'icon' => ResourceIcon::CONTAINER_ALT],
            ['name' => 'Special Cargo', 'tons' => 3, 'size' => 2, 'icon' => ResourceIcon::CONTAINER_ALT],
            ['name' => 'Oversized Cargo', 'tons' => 10, 'size' => 4, 'icon' => ResourceIcon::CONTAINER_ALT],
            ['name' => 'Cellulose', 'tons' => 2, 'size' => 1, 'icon' => ResourceIcon::PAPER],
            ['name' => 'Wooden Planks', 'tons' => 1, 'size' => 1, 'icon' => ResourceIcon::PLANK],
            ['name' => 'Short Logs', 'tons' => 4, 'size' => 2, 'icon' => ResourceIcon::LOG_LOW],
            ['name' => 'Medium Logs', 'tons' => 8, 'size' => 3, 'icon' => ResourceIcon::LOG_MID],
            ['name' => 'Long Logs', 'tons' => 12, 'size' => 5, 'icon' => ResourceIcon::LOG_LONG],
        ])->each(fn($item) => Resource::create($item));
    }
}
