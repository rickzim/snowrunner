<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum LocationType: string implements HasLabel
{
    case FACTORY = 'FCTY';
    case WAREHOUSE = 'WRHS';
    case LOG_STATION = 'LGST';
    case FARM = 'FRM';
    case FUEL_STATION = 'FLST';
    case TOWN_STORAGE = 'TNST';
    case LUMBER_MILL = 'LBRML';
    case TRAILER_STORE = 'TRLST';
    case LOGISTICS_BASE = 'LCSB';
    case REPAIR_ZONE = 'RPRZ';
    case QUARRY_LOADING_ZONE = 'QRYLZ';
    case QUARRY = 'QRY';
    case DRILLING_SITE = 'DRLS';
    case SERVICE_HUB = 'SRVH';
    case FUEL_LOADING_ZONE = 'FLLZ';
    case RESUPPLY_ZONE = 'RSPLY';
    case SAWMILL = 'SWML';
    case ABANDONED_DRILLING_SITE = 'BDRLS';
    case FALLEN_ANTENNA = 'FNNT';
    case ABANDONED_SHIP = 'BSHP';

    case GARAGE_ENTRANCE = 'GRG';
    case GATEWAY = 'GTWY';

    // case PORT = 'PORT';
    // case MINE = 'MINE'; // Ore / coal (region dependent)
    // case STEEL_MILL = 'STML'; // Steel beams / rolls
    // case CONCRETE_PLANT = 'CNCT'; // Concrete slabs / blocks
    // case POWER_PLANT = 'PWRP'; // Generator / power related contracts
    // case OIL_REFINERY = 'OILR'; // Fuel or refined oil
    // case RAIL_YARD = 'RLYD'; // Rail depots / loading yards
    // case CONSTRUCTION_SITE = 'CSTR'; // Mission-driven delivery sites

    public function getLabel(): string
    {
        return str($this->name)
            ->slug('_')
            ->replace('_', ' ')
            ->title();
    }
}
