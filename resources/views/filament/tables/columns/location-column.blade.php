<div class="location-row">
    <div class="location-icon">
        <img src="{{ asset($record->icon_path) }}" alt="{{ $record->type->getLabel() }}">
    </div>

    <div class="location-content">
        <div class="location-title">
            {{ $record->type->getLabel() }}
        </div>

        @if ($record->description)
            <div class="location-description">
                {{ $record->description }}
            </div>
        @endif
    </div>
</div>
