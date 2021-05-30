<template>
    <div style="height: 350px;">
    <!-- <div class="info" style="height: 15%">
      <span>Center: {{ center }}</span>
      <span>Zoom: {{ zoom }}</span>
      <span>Bounds: {{ bounds }}</span>
    </div> -->
    <l-map
      style="height: 80%; width: 100%"
      :zoom="zoom"
      :center="center"
      @update:zoom="zoomUpdated"
      @update:center="centerUpdated"
      @update:bounds="boundsUpdated"
    >
      <l-tile-layer :url="url"></l-tile-layer>
      <l-marker :lat-lng="{lat, lng}" >
          <l-tooltip><div>
              {{establecimiento.nombre}}
              </div></l-tooltip>
      </l-marker>
    </l-map>
  </div>
</template>


<script>
/*import { latLng } from 'leaflet';
import { LMap, LTileLayer } from 'vue2-leaflet';*/

import Vue from 'vue';
import { LMap, LTileLayer, LMarker, LTooltip } from 'vue2-leaflet';
import 'leaflet/dist/leaflet.css';
import { latLng } from 'leaflet';

Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);

export default {
    components: {
        LMap, 
        LTileLayer,
        LMarker,
        LTooltip
    },
    data() {
        return {
        zoom: 16,
        center: [10.504016, -66.919077],
        bounds: null,
        url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
        attribution:
            '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
        currentZoom: 11.5,
        mapOptions: {
            zoomSnap: 0.5
        },
        showMap: true,
        lat: "10.495030000000042",
        lng: "-66.84553999999997",
        markerLatLng: [10.504016, -66.919077]
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
  },
  mounted() {
      setTimeout(() => {
          this.lat = this.$store.getters.obtenerEstablecimiento.lat;
          this.lng = this.$store.getters.obtenerEstablecimiento.lng;
          this.center = latLng( this.lat, this.lng );
          //this.markerLatLng = [this.lat, this.lng];
          var datos= this.$store.getters.obtenerEstablecimiento;
          var parsedobj = JSON.parse(JSON.stringify(datos))
          console.log('Datos: ', datos);

      }, 1000);
      console.log('Se creo el componente');
  },
  computed: {
      establecimiento(){
          return this.$store.getters.obtenerEstablecimiento;
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
