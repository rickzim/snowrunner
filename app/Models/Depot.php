<?php

namespace App\Models;

use App\Enums\DepotType;
use Illuminate\Database\Eloquent\Model;
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

    public function resources(): BelongsToMany
    {
        return $this->belongsToMany(Resource::class);
    }
}
