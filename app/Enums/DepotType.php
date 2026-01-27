<?php

namespace App\Enums;

enum DepotType: string
{
    case FACTORY = 'FCTY';
    case WAREHOUSE = 'WRHS';
    case LOG_STATION = 'LGST';
    case FARM = 'FRM';
    case FUEL_STATION = 'FLST';
    case TOWN_STORAGE = 'TNST';
    case LUMBER_MILL = 'LBRML';
    // case xxx = 'xxx';
    // case xxx = 'xxx';
}
