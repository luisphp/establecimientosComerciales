import Vue from 'vue';
import VueX from 'vuex';

Vue.use(VueX);

export default new VueX.Store({
    state: {
        cafes: [],
        restaurants: [],
        hoteles: [],
        establecimiento: {},
        establecimientos: [],
        categorias : [],
        categoria: ''
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
        },
        AGREGAR_ESTABLECIMIENTOS(state, establecimientos){
            state.establecimientos = establecimientos;
        },
        AGREGAR_CATEGORIAS(state, categorias) {
            state.categorias = categorias;
        },
        SELECCIONAR_CATEGORIA(state, categoria){
            state.categoria = categoria;
        }
    },
    getters: {
       obtenerEstablecimiento: state => {
           return state.establecimiento;
       }, 
       obtenerEstablecimientos: state => {
           return state.establecimientos;
       }, 
       obtenerImagenes: state => {
           return state.establecimiento.imagenes;
       },
       obtenerCategorias: state => {
           return state.categorias;
       },
       obtenerCategoria: state => {
           return state.categoria;
       }
    }
});