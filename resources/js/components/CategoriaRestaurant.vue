<template>
    <div class="container mt-5">
        <h2> Restaurants </h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for="restaurant in this.restaurants" v-bind:key="restaurant.id">
                <div class="card">
                    <div class="card-body">
                        <img :src="`./storage/${restaurant.imagen_principal}`" class="card-img-top" alt="img restaurant">
                        <h3 clas="card-title text-primary font-weight-bold">
                            {{restaurant.nombre}}
                        </h3>
                        <p class="card-text"> {{restaurant.direccion}} </p>
                        <p class="card-text"> {{restaurant.direccion}} </p>
                        <p> <span class="font-weight-bold" > Horario:  </span>  {{restaurant.apertura}} a {{restaurant.cierre}}</p>
                        
                        <router-link :to="{ name: 'establecimiento', params: { id : restaurant.id} }" >
                            <a class="btn btn-primary d-block">Ver más</a>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//import { defineComponent } from '@vue/composition-api'

export default {

    mounted(){
        axios.get('./api/categoria/restaurant')
        .then(respuesta => {
            console.log(respuesta.data);
            //this.hoteles = respuesta.data;
            this.$store.commit('AGREGAR_RESTAURANTES', respuesta.data);
        })
    },
    computed: {
        restaurants(){
            return this.$store.state.restaurants;
        }
    }
}
</script>
