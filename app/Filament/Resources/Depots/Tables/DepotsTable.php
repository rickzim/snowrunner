<?php

namespace App\Filament\Resources\Depots\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DepotsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->badge()
                    ->searchable(),
                TextColumn::make('description')
                    ->searchable(),
                TextColumn::make('map.name')
                    ->searchable(),

                TextColumn::make('resources.display_name')
                    ->badge()
                    ->color(function (string $state, $record, $livewire) {
                        $activeResourceId = data_get(
                            $livewire->tableFilters,
                            'resource_id.value'
                        );

                        if (! $activeResourceId) {
                            return 'gray';
                        }

                        $resource = $record->resources
                            ->firstWhere('display_name', $state);

                        return $resource?->id == $activeResourceId
                            ? 'primary'   // highlighted
                            : 'gray';     // dimmed
                    }),

                IconColumn::make('is_unlocked')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('resource_id')
                    ->relationship('resources', 'name')
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
