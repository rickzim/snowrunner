<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Resource extends Model
{
    /** @use HasFactory<\Database\Factories\ResourceFactory> */
    use HasFactory;

    public function resources(): BelongsToMany
    {
        return $this->belongsToMany(Depot::class);
    }

    protected function displayName(): Attribute
    {
        return Attribute::get(fn () => "{$this->name} [{$this->size}]");
    }
}
