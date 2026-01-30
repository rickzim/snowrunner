<?php

use Livewire\Component;

new class extends Component {
    public $map;
    public $selectedLocation;

    public function mount($map, $location)
    {
        $this->map = $map;
        $this->selectedLocation = $location->id;
    }

    public function getScaledCoordinates($location)
    {
        $scaleX = $this->map->width > 0 ? 848 / $this->map->width : 1;
        $scaleY = $this->map->height > 0 ? 848 / $this->map->height : 1;

        return [
            'x' => $location->map_x * $scaleX + 24,
            'y' => $location->map_y * $scaleY + 24,
        ];
    }

    public function render()
    {
        return $this->view();
    }
};
?>

<div class="relative w-full h-[500px] bg-gray-900 rounded-lg overflow-hidden flex items-center justify-center">
    <div class="relative inline-block">
        <!-- Map image -->
        <img src="{{ asset($map->map_image_path) }}" alt="{{ $map->name }}" class="block max-w-full max-h-[500px]">

        <!-- location icons overlay -->
        @foreach ($map->locations as $location)
            @php
                $coords = $this->getScaledCoordinates($location);
                $title = $location->type->getLabel();

                if ($location->description) {
                    $title = $title . ' - ' . $location->description;
                }

                if ($location->resources) {
                    foreach ($location->resources as $resource) {
                        $title = $title . PHP_EOL . $resource->name . ' [' . $resource->size . ']';
                    }
                }

            @endphp
            <div @class([
                'map-marker',
                'active-marker' => $location->id === $selectedLocation,
                'locked' => $location->is_locked,
            ]) @style(['left:' . $coords['x'] . 'px', 'top:' . $coords['y'] . 'px']) title="{{ $title }}">
                <img src="{{ asset($location->icon_path) }}" alt="{{ $location->type->name }}">
            </div>
        @endforeach
    </div>
</div>
