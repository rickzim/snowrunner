<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Map extends Model
{
    /** @use HasFactory<\Database\Factories\MapFactory> */
    use HasFactory;

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function depots(): HasMany
    {
        return $this->hasMany(Depot::class);
    }
}
