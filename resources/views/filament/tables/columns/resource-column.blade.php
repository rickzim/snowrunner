@php
    $resources = $record->resources;

    $activeIds = data_get($this->tableFilters, 'resource_id.values', []);
@endphp

<div class="flex flex-wrap gap-2">
    @foreach ($resources as $resource)
        <div @class([
            'resource-row',
            'is-filtered' => $activeIds,
            'is-active' => in_array($resource->id, $activeIds),
        ])>
            <div class="resource-badge" title="{{ $resource->name }}">
                <img src="{{ asset(!empty($resource->icon) ? 'images/icons/resources/' . $resource->icon : 'images/icons/resources/placeholder.png') }}"
                    alt="{{ $resource->name }}">

                <span class="resource-size">
                    {{ $resource->size }}
                </span>
            </div>

            <div class="text-xs text-center text-gray-400 w-full -mt-1">
                {{ $resource->name }}
            </div>
        </div>
    @endforeach
</div>
