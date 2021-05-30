import Vue from 'vue'
import VuePageTransition from 'vue-page-transition'
import VueRouter from 'vue-router'
import InicioEstablecimientos from '../components/InicioEstablecimientos'
import MostrarEstablecimiento from '../components/MostrarEstablecimiento'


const routes  = [
    {
        path: '/',
        component: InicioEstablecimientos
    },
    {
        path: '/establecimiento/:id',
        name: "establecimiento",
        component: MostrarEstablecimiento
    }
]

const router = new VueRouter({
    
    routes
});


Vue.use(VueRouter);
Vue.use(VuePageTransition);

export default router;
