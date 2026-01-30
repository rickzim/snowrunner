<?php

namespace App\Models;

use App\Models\Map;
use App\Models\Region;
use App\Models\Resource;
use App\Enums\LocationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'type' => LocationType::class,
            'is_lockable' => 'boolean',
            'is_locked' => 'boolean',
        ];
    }

    public function map(): BelongsTo
    {
        return $this->belongsTo(Map::class);
    }

    public function region()
    {
        return $this->hasOneThrough(
            Region::class,
            Map::class,
            'id',        // maps.id
            'id',        // regions.id
            'map_id',    // locations.map_id
            'region_id'  // maps.region_id
        );
    }

    public function resources(): BelongsToMany
    {
        return $this->belongsToMany(Resource::class)->withPivot([
            'in_stock'
        ]);
    }

    protected function iconPath(): Attribute
    {
        return Attribute::get(fn() => str($this->icon)->prepend('images/icons/locations/')->toString());
    }
}
