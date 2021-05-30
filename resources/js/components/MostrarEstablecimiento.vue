<template>
    <div class="container my-5">
        <h2 class="text-center mb-5">{{ establecimiento.nombre }} </h2>

        <div class="row align-items-start">
            <div class="col-md-8 order-2">
                <img :src="`./storage/${establecimiento.imagen_principal}`" class="img-fluid">
                <p class="mt-5">{{ establecimiento.descripcion }}</p>
                <galeria-imagenes></galeria-imagenes>
            </div>

                

            <aside class="col-md-4 bg-primary order-1">
                <!-- mapa -->
                <div>
                    <mapa-ubicacion></mapa-ubicacion>
                </div>


                <div class="p-4">
                    <h2 class="text-center text-white mt-2 mb-4"> Más informacion </h2>

                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                            Ubicacion: 
                        </span>
                        {{ establecimiento.direccion }}
                    </p>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                            Colonia: 
                        </span>
                        {{ establecimiento.colonia }}
                    </p>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                            Horario: 
                        </span>
                        {{ establecimiento.apertura }} - {{ establecimiento.cierre }}
                    </p>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                           Telefono: 
                        </span>
                        {{ establecimiento.telefono }}
                    </p>
                </div>
            </aside>
        </div>
    </div>
</template>

<script>
import MapaUbicacion from './MapaUbicacion';
import GaleriaImagenes from './GaleriaImagenes';


export default {
  components: { 
      MapaUbicacion, 
      GaleriaImagenes 
      },

    mounted() {
        const {id} = this.$route.params;
        console.log('Este es el id del params: '+ id);

        axios.get(`./api/establecimiento/` + id)
        .then(respuesta => {
            //console.log(respuesta.data);
            //this.cafes = respuesta.data;
            //this.$store.commit('AGREGAR_CAFES', respuesta.data);
            this.$store.commit('AGREGAR_ESTABLECIMIENTO', respuesta.data );
        })
    },
    computed: {
         establecimiento(){
             return this.$store.getters.obtenerEstablecimiento;
         }
    }

}
</script>
