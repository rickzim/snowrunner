<?php

namespace App\Enums;

use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum DepotType: string implements HasLabel, HasIcon
{
    /** Generic */
    case FACTORY = 'FCTY'; // General production buildings
    case WAREHOUSE = 'WRHS'; // Multi-resource storage
    case TOWN_STORAGE = 'TNST'; // Town-city storage zones

    /** Resource specific */
    case FARM = 'FRM'; // Grain, potatoes, etc.
    case LOG_STATION = 'LGST'; // Log pickup zones
    case LUMBER_MILL = 'LBRML'; // Produces planks from logs
    case SAWMILL = 'SWML'; // Same role as lumber mill (map-dependent)
    case QUARRY = 'QRY'; // Stone / gravel
    case MINE = 'MINE'; // Ore / coal (region dependent)
    case DRILL_SITE = 'DRLS'; // Oil drilling locations

    /** Industrial */
    case STEEL_MILL = 'STML'; // Steel beams / rolls
    case CONCRETE_PLANT = 'CNCT'; // Concrete slabs / blocks
    case POWER_PLANT = 'PWRP'; // Generator / power related contracts
    case OIL_REFINERY = 'OILR'; // Fuel or refined oil

    /** Logistics */
    case PORT = 'PORT'; // Harbors, docks
    case RAIL_YARD = 'RLYD'; // Rail depots / loading yards

    /** Fuel / service (often excluded, but useful) */
    case FUEL_STATION = 'FLST'; // Fuel only
    case SERVICE_HUB = 'SRVH'; // Repairs, spare parts
    case GARAGE = 'GRG'; // Vehicle storage & service

    /** Special / misc */
    case CONSTRUCTION_SITE = 'CSTR'; // Mission-driven delivery sites
    case TRAILER_STORE = 'TRLST'; // Trailer shop zones

    public function getLabel(): string
    {
        return str($this->name)->slug('_')->title();
    }
}
