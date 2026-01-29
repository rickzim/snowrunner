<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum LocationType: string implements HasLabel
{
    case GATEWAY = 'GTWY';
    case FACTORY = 'FCTY';
    case WAREHOUSE = 'WRHS';
    case LOG_STATION = 'LGST';
    case FARM = 'FRM';
    case TOWN_STORAGE = 'TNST';
    case LUMBER_MILL = 'LBRML';
    case LOGISTICS_BASE = 'LCSB';
    case QUARRY_LOADING_ZONE = 'QRYLZ';
    case QUARRY = 'QRY';
    case DRILLING_SITE = 'DRLS';
    case SERVICE_HUB = 'SRVH';
    case FUEL_STATION = 'FLST';
    case SAWMILL = 'SWML';
    case ABANDONED_DRILLING_SITE = 'BDRLS';
    case FALLEN_ANTENNA = 'FNNT';
    case ABANDONED_SHIP = 'BSHP';
    case PORT = 'PORT';

    case MINE = 'MINE'; // Ore / coal (region dependent)
    case STEEL_MILL = 'STML'; // Steel beams / rolls
    case CONCRETE_PLANT = 'CNCT'; // Concrete slabs / blocks
    case POWER_PLANT = 'PWRP'; // Generator / power related contracts
    case OIL_REFINERY = 'OILR'; // Fuel or refined oil
    case RAIL_YARD = 'RLYD'; // Rail depots / loading yards
    case GARAGE = 'GRG'; // Vehicle storage & service
    case CONSTRUCTION_SITE = 'CSTR'; // Mission-driven delivery sites
    case TRAILER_STORE = 'TRLST'; // Trailer shop zones

    public function getLabel(): string
    {
        return str($this->name)->slug('_')->replace('_', ' ')->title();
    }
}
