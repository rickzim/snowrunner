<?php

use Livewire\Component;

new class extends Component {
    public $map;
    public $selectedDepot;
    public $x;
    public $y;

    protected $listeners = [
        'mapClick' => 'setCoords',
    ];

    public function mount($map, $depot)
    {
        $this->map = $map;
        $this->selectedDepot = $depot->id;
    }

    public function getScaledCoordinates($depot)
    {
        $width = $this->map->width > 0 ? $this->map->width : 1;
        $height = $this->map->height > 0 ? $this->map->height : 1;

        return [
            'x' => ($depot->map_x / $width) * 100,
            'y' => ($depot->map_y / $height) * 100,
        ];
    }

    public function setCoords(float $x, float $y): void
    {
        $this->x = round($x, 4);
        $this->y = round($y, 4);
    }

    public function render()
    {
        return $this->view();
    }
};
?>

<div class="relative w-full h-[500px] bg-gray-900 rounded-lg overflow-hidden flex items-center justify-center">
    <div id="mapWrap" class="relative w-full h-full">
        <!-- Map image -->
        <img id="mapImage" src="{{ asset($map->image_path) }}" alt="{{ $map->name }}"
            class="block w-full h-auto object-contain max-h-[500px]">

        <!-- Depot icons overlay (use percent positions so markers scale with image) -->
        @foreach ($map->depots as $depot)
            @php
                $coords = $this->getScaledCoordinates($depot);
            @endphp
            <div @class([
                'map-marker absolute -translate-x-1/2 -translate-y-1/2',
                'active-marker' => $depot->id === $selectedDepot,
            ]) style="left: {{ $coords['x'] }}%; top: {{ $coords['y'] }}%;"
                title="{{ $depot->type->name }}">
                <img src="{{ asset($depot->icon_path) }}" alt="{{ $depot->type->name }}">
            </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const img = document.getElementById('mapImage');
        if (!img) return;

        img.addEventListener('click', function(e) {
            const rect = img.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;
            if (window.Livewire) {
                Livewire.emit('mapClick', x, y);
            }
        });
    });
</script>
