<template>
    <div class="container mt-5">
        <h2> Hoteles </h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for="hotel in this.hoteles" v-bind:key="hotel.id">
                <div class="card">
                    <div class="card-body">
                        <img :src="`./storage/${hotel.imagen_principal}`" class="card-img-top" alt="img restaurant">
                        <h3 clas="card-title text-primary font-weight-bold">
                            {{hotel.nombre}}
                        </h3>
                        <p class="card-text"> {{hotel.direccion}} </p>
                        <p class="card-text"> {{hotel.direccion}} </p>
                        <p> <span class="font-weight-bold" > Horario:  </span>  {{hotel.apertura}} a {{hotel.cierre}}</p>
                        
                        <router-link :to="{ name: 'establecimiento', params: { id : hotel.id} }" >
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
        axios.get('./api/categoria/hoteles')
        .then(respuesta => {
            //console.log(respuesta.data);
            //this.hoteles = respuesta.data;
            this.$store.commit('AGREGAR_HOTELES', respuesta.data);
        })
    },
    computed: {
        hoteles(){
            return this.$store.state.hoteles;
        }
    }
}
</script>
