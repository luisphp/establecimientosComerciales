<template>
    <div class="mapa" >
        <l-map
            :zoom="zoom"
            :center="center"
            @update:zoom="zoomUpdated"
            @update:center="centerUpdated"
            @update:bounds="boundsUpdated"
        >
        <l-tile-layer :url="url" ></l-tile-layer>
        <l-marker 
            v-for="establecimiento in establecimientos" 
            v-bind:key="establecimiento.id" 
            :lat-lng="obtenerCoordenadas(establecimiento)"
            :icon="iconoEstablecimiento(establecimiento)"
            >
            <l-tooltip>
                <div>
                    {{establecimiento.nombre}} - {{establecimiento.categoria.nombre}}
                </div>
            </l-tooltip>
        </l-marker>
        </l-map>
  </div>
</template>

<script>
import Vue from 'vue';
import { LMap, LTileLayer, LMarker, LTooltip, LIcon } from 'vue2-leaflet';
import 'leaflet/dist/leaflet.css';
import { latLng, icon, Marker } from 'leaflet';

Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);


export default {
    components: {
        LMap, 
        LTileLayer,
        LMarker,
        LTooltip,
        LIcon
    },
    data() {
        return {
        zoom: 13,
        center: latLng(10.485850000000028, -66.93440999999996),
        url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
        attribution:
            '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
        currentZoom: 11.5,
        currentCenter: latLng(10.485850000000028, -66.93440999999996),
        showParagraph: false,
        mapOptions: {
            zoomSnap: 0.5
        },
        showMap: true
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
        },
        obtenerCoordenadas (establecimiento) {
            return {
                lat : establecimiento.lat,
                lng: establecimiento.lng
            }
        },
        iconoEstablecimiento (establecimiento) {
            //console.log('Icono del establecimiento: ', establecimiento )

            const { slug  } = establecimiento.categoria;

            return L.icon({
                iconUrl: `images/iconos/${slug}.png`,
                iconSize: [40, 50]
            });

            
        }
    },
    computed: {
      establecimientos(){
          return this.$store.getters.obtenerEstablecimientos;
          
      }
    },
    created() {
        axios.get('./api/establecimientos')
        .then( response => {
            //console.log('Respuesta de los establecimientos: ', response.data )

            this.$store.commit('AGREGAR_ESTABLECIMIENTOS', response.data)
        } )
    },
    watch: {
        "$store.state.categoria": function() {
            //console.log('La categoria cambio a: ', this.$store.state.categoria );

            axios.get('./api/categoria/' + this.$store.getters.obtenerCategoria)
            .then((result) => {
               // console.log('resultado de la consulta', result.data)

               this.$store.coomit('AGREGAR_ESTABLECIMIENTOS', result.data);
            }).catch((err) => {
                console.log('Error en la consulta');
            });
        }
    }
}
</script>

<style scoped>
 .mapa{
     height: 250px;
     width: 100%;
 }
</style>