<?php

namespace App\Filament\Resources\Depots\Tables;

use App\Models\Region;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Tables\Grouping\Group;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use App\Filament\Tables\Columns\DepotColumn;
use App\Filament\Tables\Columns\ResourceColumn;

class DepotsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('map.name')
                    ->toggleable(isToggledHiddenByDefault: false),

                DepotColumn::make('type')
                    ->label('Depot'),

                // TextColumn::make('resources.display_name')
                //     ->badge()
                //     ->color(function (string $state, $record, $livewire) {
                //         $activeIds = data_get($livewire->tableFilters, 'resource_id.values', []);

                //         if (! $activeIds) {
                //             return 'gray';
                //         }

                //         $resource = $record->resources
                //             ->firstWhere('display_name', $state);

                //         return in_array($resource?->id, $activeIds)
                //             ? 'primary'
                //             : 'gray';
                //     }),

                ResourceColumn::make('resources'),

                ToggleColumn::make('is_unlocked'),
            ])
            ->striped()
            ->filters([
                SelectFilter::make('region_id')
                    ->relationship('region', 'name')
                    ->searchable()
                    ->preload()
                    ->indicateUsing(function (array $data): ?string {
                        if (! $data['value']) {
                            return null;
                        }

                        return 'Region: ' . Region::findOrFail($data['value'])->name;
                    }),

                SelectFilter::make('resource_id')
                    ->label('Resources')
                    ->relationship('resources', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload(),

                TernaryFilter::make('is_unlocked')
                    ->default(true)
            ], \Filament\Tables\Enums\FiltersLayout::AboveContent)
            ->defaultGroup('map.name')
            ->groups([
                Group::make('map.region.name')->collapsible(),
                Group::make('map.name')->collapsible(),
            ])
            ->recordAction('viewOnMap')
            ->recordActions([
                Action::make('viewOnMap')
                    ->label('View on map')
                    ->icon('heroicon-o-map')
                    ->modalHeading('')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->closeModalByClickingAway(true)
                    ->modalContent(fn($record) => view('filament.modals.depot-map', [
                        'depot' => $record,
                    ]))
            ])
            ->toolbarActions([
                //
            ]);
    }
}
