<?php

namespace App\Filament\Resources\Depots\Schemas;

use App\Enums\DepotType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DepotForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->options(DepotType::class)
                    ->required(),
                TextInput::make('description'),
                Select::make('map_id')
                    ->relationship('map', 'name')
                    ->required(),
                Toggle::make('is_unlocked')
                    ->required(),
            ]);
    }
}
