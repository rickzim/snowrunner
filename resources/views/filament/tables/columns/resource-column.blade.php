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

                <span
                    class="resource-tl">{{ is_null($resource->pivot->in_stock) ? '∞' : $resource->pivot->in_stock }}</span>
                {{-- <span class="resource-tl">{{ $resource->size }}</span> --}}
            </div>

            <div class="text-xs text-center text-gray-400 w-full -mt-1 text-block">
                {{-- <span>{{ is_null($resource->pivot->in_stock) ? '∞' : $resource->pivot->in_stock }}</span> --}}
                {{ $resource->name }} <span class="small-badge">S{{ $resource->size }}</span>
            </div>
        </div>
    @endforeach
</div>
