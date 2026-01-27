@php
    $map = $depot->map;
@endphp

<div x-data="{
    originalWidth: {{ $depot->map->width }},
    originalHeight: {{ $depot->map->height }},
    x: {{ $depot->map_x }},
    y: {{ $depot->map_y }},
    markerStyle: '',
    hasLocation: {{ $depot->map_x > 0 || $depot->map_y > 0 ? 'true' : 'false' }},

    update() {
        if (!this.hasLocation) return;

        const img = this.$refs.img
        if (!img) return

        const w = img.clientWidth
        const h = img.clientHeight

        if (w === 0 || h === 0) {
            requestAnimationFrame(() => this.update())
            return
        }

        const scaleX = w / this.originalWidth
        const scaleY = h / this.originalHeight

        this.markerStyle = `
            left: ${this.x * scaleX}px;
            top: ${this.y * scaleY}px;
        `
    },

    init() {
        this.$nextTick(() => this.update())
        window.addEventListener('resize', () => this.update())
    }
}" class="relative w-full h-[500px] overflow-hidden rounded-lg bg-gray-900">
    <img x-ref="map" src="{{ asset($map->image_path) }}" class="w-full h-full object-contain" alt="Map">

    <!-- Marker -->
    <div x-ref="marker" class="map-marker"></div>
</div>
