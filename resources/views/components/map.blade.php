<?php

use Livewire\Component;

new class extends Component {
    public $map;
    public $selectedLocation;
    // 1. Define these properties
    public $modalWidth = 0;
    public $modalHeight = 0;

    public function mount($map, $location)
    {
        $this->map = $map;
        $this->selectedLocation = $location->id;
    }

    public function updateModalDimensions($width, $height)
    {
        $this->modalWidth = $width;
        $this->modalHeight = $height;
        // This triggers a re-render automatically
    }

    public function getScaledCoordinates($location)
    {
        // 2. Use the dynamic width/height instead of 848
        $currentWidth = $this->modalWidth ?: 848; // Fallback to 848
        $currentHeight = $this->modalHeight ?: 500;

        $scaleX = $this->map->width > 0 ? $currentWidth / $this->map->width : 1;
        $scaleY = $this->map->height > 0 ? $currentHeight / $this->map->height : 1;

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

<div class="relative w-full h-[500px] bg-gray-900 rounded-lg overflow-hidden flex items-center justify-center"
    x-data="{
        width: 0,
        height: 0,
        measure() {
            // Wait for animations to finish
            setTimeout(() => {
                this.width = this.$el.offsetWidth;
                this.height = this.$el.offsetHeight;

                if (this.width > 0) {
                    $wire.updateModalDimensions(this.width, this.height);
                }
            }, 300); // 300ms matches most modal animations
        }
    }" x-init="measure()" x-intersect="measure()" @resize.window.debounce.200ms="measure()"
    class="relative" x-cloak>

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
                'active-marker' => $location->id == $selectedLocation,
                'locked' => $location->is_locked,
            ]) @style(['left:' . $coords['x'] . 'px', 'top:' . $coords['y'] . 'px']) title="{{ $title }}">
                <img src="{{ asset($location->icon_path) }}" alt="{{ $location->type->name }}">
            </div>
        @endforeach
    </div>
</div>
