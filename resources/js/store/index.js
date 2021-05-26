import Vue from 'vue';
import VueX from 'vuex';

Vue.use(VueX);

export default new VueX.Store({
    state: {
        cafes: [],
        restaurants: [],
        hoteles: [],
        establecimiento: {}
    },
    mutations: {
        AGREGAR_CAFES(state, cafes) {
            state.cafes = cafes;
        },
        AGREGAR_RESTAURANTES(state, restaurants) {
            state.restaurants = restaurants;
        },
        AGREGAR_HOTELES(state, hoteles) {
            state.hoteles = hoteles;
        },
        AGREGAR_ESTABLECIMIENTO(state, establecimiento){
            state.establecimiento = establecimiento;
        }
    },
    getters: {
       obtenerEstablecimiento: state => {
           return state.establecimiento;
       } 
    }
});