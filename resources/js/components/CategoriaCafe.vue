<template>
    <div class="container mt-5">
        <h2> Cafés </h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for="cafe in this.cafes" v-bind:key="cafe.id">
                <div class="card">
                    <div class="card-body">
                        <img :src="`./storage/${cafe.imagen_principal}`" class="card-img-top" alt="img restaurant">
                        <h3 clas="card-title text-primary font-weight-bold">
                            {{cafe.nombre}}
                        </h3>
                        <p class="card-text"> {{cafe.direccion}} </p>
                        <p class="card-text"> {{cafe.direccion}} </p>
                        <p> <span class="font-weight-bold" > Horario:  </span>  {{cafe.apertura}} a {{cafe.cierre}}</p>
                        <router-link :to="{ name: 'establecimiento', params: { id : cafe.id} }" >
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
        axios.get('./api/categoria/cafe')
        .then(respuesta => {
            console.log(respuesta.data);
            //this.cafes = respuesta.data;
             this.$store.commit('AGREGAR_CAFES', respuesta.data);
        })
    },
    computed: {
        cafes(){
            return this.$store.state.cafes;
        }
    }
}
</script>
