<template>
    
    <div class="mapa">
        <div class="info" style="height: 15%">
        <span>Center: {{ center }}</span>
        <span>Zoom: {{ zoom }}</span>
        <span>Bounds: {{ bounds }}</span>
        </div>
        <l-map
            
            :zoom="zoom"
            :center="center"
            @update:zoom="zoomUpdated"
            @update:center="centerUpdated"
            @update:bounds="boundsUpdated"
        ></l-map>
        <l-tile-layer :url="url"></l-tile-layer>
    </div>

</template>


<script>
import Vue from 'vue';
import { LMap, LTileLayer, LMarker } from 'vue2-leaflet';
import 'leaflet/dist/leaflet.css';

Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);


export default {
    components: {
        LMap,
        LTileLayer
    },
    data () {
    return {
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      zoom: 16,
      center: [47.413220, -1.219482],
      bounds: null
    };
  },
    methods: {
        zoomUpdated (zoom) {
        this.zoom = zoom;
        },
        centerUpdated (center) {
        this.center = center;
        },
        boundsUpdated (bounds) {
        this.bounds = bounds;
        }
    }

}
</script>

<style scoped>
    .mapa{
        height: 300px;
        width: 100%;
    }
</style>
