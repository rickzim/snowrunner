<?php

namespace Database\Seeders;

use App\Enums\LocationIcon;
use Exception;
use App\Models\Map;
use App\Models\Region;
use App\Models\Resource;
use App\Enums\LocationType;
use App\Enums\ResourceIcon;
use App\Models\Location;
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
        $this->createSmithvilleDam($region);
        $this->createIslandLake($region);
        $this->createDrummondIsland($region);

        // $region = Region::create(['name' => 'Alaska, USA']);
        // $this->createNorthPort($region);
    }

    private function createBlackRiver(Region $region)
    {
        $map = $region->maps()->create([
            'name' => 'Black River',
            'map_image' => 'black_river_blank_4032_4032.webp',
            'width' => 4032,
            'height' => 4032,
        ]);
        static::createLocation($map, LocationType::FACTORY, LocationIcon::FACTORY, 3690, 720, ['Service Spare Parts'], true, true);
        static::createLocation($map, LocationType::WAREHOUSE, LocationIcon::CONSTRUCTION_WAREHOUSE, 3550, 2490, ['Bricks', 'Concrete Blocks', 'Metal Beams', 'Service Spare Parts']);
        static::createLocation($map, LocationType::LOG_STATION, LocationIcon::LUMBERJACK, 2750, 1230, ['Long Logs', 'Medium Logs']);
        static::createLocation($map, LocationType::FARM, LocationIcon::FARM, 1960, 3380, ['Consumables']);
        static::createLocation($map, LocationType::FUEL_STATION, LocationIcon::FUEL_STATION, 2017, 2730);
        static::createLocation($map, LocationType::TOWN_STORAGE, LocationIcon::TOWN_STORAGE, 770, 1760, ['Metal Beams']);
        static::createLocation($map, LocationType::LUMBER_MILL, LocationIcon::SAWMILL, 1400, 2320, ['Wooden Planks']);
        static::createLocation($map, LocationType::FUEL_STATION, LocationIcon::FUEL_STATION, 825, 2460);
        static::createLocation($map, LocationType::TRAILER_STORE, LocationIcon::TRAILER_SHOP, 2825, 3325);
        static::createLocation($map, LocationType::TRAILER_STORE, LocationIcon::TRAILER_SHOP, 845, 665);
        static::createLocation($map, LocationType::GARAGE_ENTRANCE, LocationIcon::GARAGE, 2785, 3215);
        static::createLocation($map, LocationType::GATEWAY, LocationIcon::GATEWAY, 555, 650, description: 'Smithville Dam');
    }

    private function createSmithvilleDam(Region $region)
    {
        $map = $region->maps()->create([
            'name' => 'Smithville Dam',
            'map_image' => 'smithville_dam_blank_4032_4032.webp',
            'width' => 4032,
            'height' => 4032,
        ]);
        static::createLocation($map, LocationType::LOGISTICS_BASE, LocationIcon::TOWN_STORAGE, 310, 430, ['Drilling Spare Parts'], true, true);
        static::createLocation($map, LocationType::REPAIR_ZONE, LocationIcon::SERVICE_HUB, 330, 380, null, true, true);
        static::createLocation($map, LocationType::QUARRY_LOADING_ZONE, LocationIcon::TOWN_STORAGE, 1920, 2725, ['Cargo Container'], true, true);
        static::createLocation($map, LocationType::QUARRY, LocationIcon::TASK_SUB, 1980, 2680, ['Cement'], true, true);
        static::createLocation($map, LocationType::DRILLING_SITE, LocationIcon::DRILLING_SITE, 970, 1550,  ['Fuel']);
        static::createLocation($map, LocationType::WAREHOUSE, LocationIcon::CONSTRUCTION_WAREHOUSE, 1660, 1980, ['Concrete Slab', 'Bricks']);
        static::createLocation($map, LocationType::WAREHOUSE, LocationIcon::CONSTRUCTION_WAREHOUSE, 430, 3180, ['Metal Beams', 'Wooden Planks', 'Concrete Blocks']);
        static::createLocation($map, LocationType::FARM, LocationIcon::FARM, 1155, 525,  ['Consumables']);
        static::createLocation($map, LocationType::SERVICE_HUB, LocationIcon::SERVICE_HUB, 3646, 450,  ['Service Spare Parts', 'Vehicle Spare Parts', 'Oil Rig Drill']);
        static::createLocation($map, LocationType::LOG_STATION, LocationIcon::LUMBERJACK, 1220, 480, ['Medium Logs']);
        static::createLocation($map, LocationType::FUEL_STATION, LocationIcon::FUEL_STATION, 3755, 1245);
        static::createLocation($map, LocationType::TRAILER_STORE, LocationIcon::TRAILER_SHOP, 3150, 215);
        static::createLocation($map, LocationType::TRAILER_STORE, LocationIcon::TRAILER_SHOP, 1815, 2050);
        static::createLocation($map, LocationType::TRAILER_STORE, LocationIcon::TRAILER_SHOP, 340, 3420);
        static::createLocation($map, LocationType::FUEL_LOADING_ZONE, LocationIcon::TOWN_STORAGE, 3780, 1240, ['Fuel']);
        static::createLocation($map, LocationType::RESUPPLY_ZONE, LocationIcon::HARD_RESUPPLY, 1670, 1870);
        static::createLocation($map, LocationType::GARAGE_ENTRANCE, LocationIcon::GARAGE, 3030, 270);
        static::createLocation($map, LocationType::GATEWAY, LocationIcon::GATEWAY, 3790, 870, description: 'Black River');
        static::createLocation($map, LocationType::GATEWAY, LocationIcon::GATEWAY, 3290, 3830, description: 'Island Lake');
        static::createLocation($map, LocationType::GATEWAY, LocationIcon::GATEWAY, 200, 2900, description: 'Drummond Island');
    }

    private function createIslandLake(Region $region)
    {
        $map = $region->maps()->create([
            'name' => 'Island Lake',
            'width' => 4032,
            'height' => 2016,
            'map_image' => 'island_lake_blank_4032_2016.webp'
        ]);
        static::createLocation($map, LocationType::SAWMILL, LocationIcon::SAWMILL, 2950, 1750, ['Wooden Planks'], true, true);
        static::createLocation($map, LocationType::WAREHOUSE, LocationIcon::CONSTRUCTION_WAREHOUSE, 3800, 1760, ['Drilling Equipment:1'], true, true);
        static::createLocation($map, LocationType::ABANDONED_DRILLING_SITE, LocationIcon::DRILLING_SITE, 3475, 490, ['Drilling Equipment:1']);
        static::createLocation($map, LocationType::FALLEN_ANTENNA, LocationIcon::TASK_SUB, 2310, 990, ['Cargo Container']);
        static::createLocation($map, LocationType::TRAILER_STORE, LocationIcon::TRAILER_SHOP, 3470, 1860);
        static::createLocation($map, LocationType::ABANDONED_DRILLING_SITE, LocationIcon::DRILLING_SITE, 2445, 645, ['Drilling Equipment:1']);
        static::createLocation($map, LocationType::ABANDONED_DRILLING_SITE, LocationIcon::DRILLING_SITE, 1355, 765, ['Drilling Equipment']);
        static::createLocation($map, LocationType::LOG_STATION, LocationIcon::TOWN_STORAGE, 2170, 320, ['Metal Beams', 'Wooden Planks']);
        static::createLocation($map, LocationType::LOG_STATION, LocationIcon::LUMBERJACK, 3110, 325, ['Medium Logs']);
        static::createLocation($map, LocationType::GARAGE_ENTRANCE, LocationIcon::GATEWAY, 3720, 1260, description: 'Smithville Dam');
        static::createLocation($map, LocationType::GARAGE_ENTRANCE, LocationIcon::GATEWAY, 520, 700, description: 'Drummond Island');
    }
    private function createDrummondIsland(Region $region)
    {
        $map = $region->maps()->create([
            'name' => 'Drummond Island',
            'width' => 2016,
            'height' => 2016,
            'map_image' => 'drummond_island_blank_2016_2016.webp'
        ]);

        static::createLocation($map, LocationType::ABANDONED_SHIP, LocationIcon::FLAG, 340, 1100, ['Oversized Cargo'], true, true);
        static::createLocation($map, LocationType::FUEL_STATION, LocationIcon::FUEL_STATION, 1370, 1700);
        static::createLocation($map, LocationType::LOG_STATION, LocationIcon::TOWN_STORAGE, 465, 1850, ['Wooden Planks']);
        static::createLocation($map, LocationType::LOG_STATION, LocationIcon::LUMBERJACK, 550, 1780, ['Long Logs']);
        static::createLocation($map, LocationType::RESUPPLY_ZONE, LocationIcon::HARD_RESUPPLY, 1660, 385);
        static::createLocation($map, LocationType::GATEWAY, LocationIcon::GATEWAY, 145, 150, description: 'Smithville Dam');
        static::createLocation($map, LocationType::GATEWAY, LocationIcon::GATEWAY, 130, 1920, description: 'Island Lake');
    }

    // private function createNorthPort(Region $region)
    // {
    //     $map = $region->maps()->create([
    //         'name' => 'North Port',
    //         'width' => 4032,
    //         'height' => 4032,
    //         'map_image' => 'north_port_blank_4032_4032.webp'
    //     ]);
    // static::createLocation($map, LocationType::XXX, LocationIcon::XXX, 000, 000, null, true, true);
    //     static::createLocation($map, LocationType::PORT, ['Large Pipe', 'Consumables', 'Oversized Cargo', 'Drilling Equipment', 'Cargo Container']);
    // }

    private function createLocation(
        Map $map,
        LocationType $type,
        ?LocationIcon $icon,
        int $x = 0,
        int $y = 0,
        ?array $resources = [],
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

        $attachData = collect($resources)->mapWithKeys(function ($resource) {
            [$name, $inStock] = array_pad(explode(':', $resource, 2), 2, null);

            $model = $this->resources->firstWhere('name', $name);

            if (! $model) {
                throw new Exception("found missing resource: {$name}");
            }

            return [
                $model->id => $inStock !== null
                    ? ['in_stock' => (int) $inStock]
                    : [],
            ];
        });

        $locations->resources()->attach($attachData);
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
