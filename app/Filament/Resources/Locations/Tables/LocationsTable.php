<?php

namespace App\Filament\Resources\Locations\Tables;

use App\Models\Region;
use Filament\Tables\Table;
use App\Enums\LocationType;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use PhpParser\Node\Expr\Ternary;
use Filament\Actions\ActionGroup;
use Filament\Support\Enums\Width;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Grouping\Group;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;
use App\Filament\Tables\Columns\LocationColumn;
use App\Filament\Tables\Columns\ResourceColumn;

class LocationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('map.name')
                    ->toggleable(isToggledHiddenByDefault: true),

                LocationColumn::make('type')
                    ->label('Location'),

                ToggleColumn::make('is_locked')
                    ->wrapHeader()
                    ->label('Status')
                    ->onIcon(fn($record) => $record->is_lockable ? Heroicon::LockClosed : null)
                    ->offIcon(fn($record) => $record->is_lockable ? Heroicon::LockOpen : null)
                    ->onColor(fn($record) => $record->is_lockable ? 'danger' : null)
                    ->offColor(fn($record) => $record->is_lockable ? 'success' : null)
                    ->disabled(fn($record) => !$record->is_lockable),

                ResourceColumn::make('resources'),

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
            ])
            ->striped()
            ->paginated(false)
            ->filters([
                SelectFilter::make('region_id')
                    ->relationship('region', 'name')
                    ->default(Region::first()?->id ?? null)
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
                    ->modalWidth(Width::FiveExtraLarge)
                    ->modalContent(fn($record) => view('filament.modals.map', [
                        'location' => $record,
                    ])),
                ActionGroup::make([
                    Action::make('unlock'),
                    Action::make('lock'),
                    Action::make('markAsEmpty'),
                ])
            ])
            ->toolbarActions([
                //
            ]);
    }
}
