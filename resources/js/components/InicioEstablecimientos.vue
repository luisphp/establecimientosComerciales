<template>
    <!--<h1 class="mt-5" >Desde Inicio</h1>-->
    <div>
        <listado-categoria></listado-categoria>
        <mapa-establecimientos></mapa-establecimientos>
        <categoria-cafe></categoria-cafe>
        <categoria-restaurant></categoria-restaurant>
        <categoria-hotel></categoria-hotel>
        

    </div>

    

</template>

<script>
import  CategoriaCafe  from './CategoriaCafe';
import  CategoriaRestaurant  from './CategoriaRestaurant';
import  CategoriaHotel  from './CategoriaHotel';
import MapaEstablecimientos from './MapaEstablecimientos.vue';
import ListadoCategoria from './ListadoCategoria.vue';





export default {

    components: {
        CategoriaCafe,
        CategoriaRestaurant,
        CategoriaHotel,
        MapaEstablecimientos,
        ListadoCategoria
        
    }
}
</script>