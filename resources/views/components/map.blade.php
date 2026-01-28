<?php

use Livewire\Component;

new class extends Component {
    public $map;
    public $selectedDepot;

    public function mount($map, $depot)
    {
        $this->map = $map;
        $this->selectedDepot = $depot->id;
    }

    public function getScaledCoordinates($depot)
    {
        $scaleX = $this->map->width > 0 ? 848 / $this->map->width : 1;
        $scaleY = $this->map->height > 0 ? 848 / $this->map->height : 1;

        return [
            'x' => ($depot->map_x + 24) * $scaleX,
            'y' => ($depot->map_y + 24) * $scaleY,
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
        <img src="{{ asset($map->image_path) }}" alt="{{ $map->name }}" class="block max-w-full max-h-[500px]">

        <!-- Depot icons overlay -->
        @foreach ($map->depots as $depot)
            @php
                $coords = $this->getScaledCoordinates($depot);
            @endphp
            <div @class([
                'map-marker',
                'active-marker' => $depot->id === $selectedDepot,
            ]) @style(['left:' . $coords['x'] . 'px', 'top:' . $coords['y'] . 'px']) title="{{ $depot->type->name }}">
                <img src="{{ asset($depot->icon_path) }}" alt="{{ $depot->type->name }}">
            </div>
        @endforeach
    </div>
</div>
