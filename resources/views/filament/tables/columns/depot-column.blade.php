<div class="depot-row">
    <div class="depot-icon">
        <img src="{{ asset($record->icon_path) }}" alt="{{ $record->type->getLabel() }}">
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
