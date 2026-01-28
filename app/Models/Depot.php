<?php

namespace App\Models;

use App\Enums\DepotType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Depot extends Model
{
    /** @use HasFactory<\Database\Factories\DepotFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'type' => DepotType::class,
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
            'map_id',    // depots.map_id
            'region_id'  // maps.region_id
        );
    }

    public function resources(): BelongsToMany
    {
        return $this->belongsToMany(Resource::class);
    }

    protected function iconPath(): Attribute
    {
        return Attribute::get(fn($value) => str($this->type->getIcon())->prepend('images/icons/depots/')->toString());
    }
}
