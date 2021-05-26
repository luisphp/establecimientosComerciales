<template>
    <!--<h1 class="mt-5" >Desde Inicio</h1>-->
    <div>
        <!-- <h1>Pagina de inicio</h1> -->

        <categoria-cafe></categoria-cafe>
        <categoria-restaurant></categoria-restaurant>
        <categoria-hotel></categoria-hotel>

    </div>

    

</template>

<script>
import  CategoriaCafe  from './CategoriaCafe';
import  CategoriaRestaurant  from './CategoriaRestaurant';
import  CategoriaHotel  from './CategoriaHotel';




export default {

    components: {
        CategoriaCafe,
        CategoriaRestaurant,
        CategoriaHotel
    }
}
</script>