<template>
    <!--<h1 class="mt-5" >Desde Inicio</h1>-->
    <div>
        <!-- <h1>Pagina de inicio</h1> -->
        <router-view>

        </router-view>
        <!-- <categoria-cafe></categoria-cafe>
        <categoria-restaurant></categoria-restaurant>
        <categoria-hotel></categoria-hotel> -->

    </div>

    

</template>



<script>

import store from '../store';

export default {
    store,

}
</script>
