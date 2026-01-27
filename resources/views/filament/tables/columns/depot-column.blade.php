@php
    use App\Enums\DepotType;

    // $type = DepotType::from($record->type);

@endphp

<div class="depot-row">
    <div class="depot-icon">
        <img src="{{ asset($record->type->getIcon()) }}" alt="{{ $record->type->getLabel() }}">
    </div>

    <div class="depot-content">
        <div class="depot-title">
            {{ $record->type->getLabel() }}
        </div>

        @if ($record->description)
            <div class="depot-description">
                {{ $record->description }}
            </div>
        @endif
    </div>
</div>
