import Vue from 'vue'
import VueRouter from 'vue-router'
import negocios from "./pages/negocios";
import categorias from "./pages/categorias";
import archivos from "./pages/archivos";

import formulario from "./pages/formulario";
import perfiladmin from "./pages/perfiladmin";
import imgcarrusel from "./pages/imagenesCarrusel";

Vue.use(VueRouter);


const router = new VueRouter(
    {
        routes: [
            {
                path: '*',
                redirect: '/',
            },
            {
                path: '/', component: negocios, props: true,
            },
            {
                path: '/categorias', component: categorias, props: true,
            },
            {
                path: '/archivos', component: archivos, props: true,

            },
            {
                path: '/formulario', component: formulario, props: true,  name: 'formulario'

            },
            {
                path: '/imgcarrusel', component: imgcarrusel, props: true, name: 'imgcarrusel'

            },
            {
                path: '/perfilAdmin/:idEmpresa', component: perfiladmin, props: true,name: 'perfiladmin',
            }
        ]
    }
);

router.beforeEach((to, from, next) => {
    next();
})

router.beforeResolve((to, from, next) => {
    next();
})

router.afterEach((to, from) => {})



export default router