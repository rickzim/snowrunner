<div class="relative w-full h-[500px] bg-gray-900 rounded-lg overflow-hidden flex items-center justify-center"
    x-data="{
        originalWidth: {{ $depot->map->width }},
        originalHeight: {{ $depot->map->height }},
        x: {{ $depot->map_x }},
        y: {{ $depot->map_y }},
        markerStyle: '',
        rafId: null,
    
        update() {
            const img = this.$refs.img
            if (!img) return
    
            const w = img.clientWidth
            const h = img.clientHeight
    
            if (w === 0 || h === 0) {
                // layout not ready yet — try again next frame
                this.rafId = requestAnimationFrame(() => this.update())
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
    }" x-init="init">
    <div class="relative inline-block">
        <img x-ref="img" src="{{ asset($depot->map->image_path) }}" alt="Map" class="block max-w-full max-h-[500px]"
            @load="update">

        <div class="map-marker" :style="markerStyle"></div>
    </div>
</div>
