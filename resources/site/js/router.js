import Vue from 'vue'
import VueRouter from 'vue-router'
import negocios from "./pages/negocios";
import categorias from "./pages/categorias";
import archivos from "./pages/archivos";

Vue.use(VueRouter);


const router = new VueRouter(
    {
        routes :[
            {
                path    : '*',
                redirect: '/',
            },
            {
                path: '/', component: negocios, props:true,
                children: [
                    /* {
                     path: '/',
                     component: Business,
                     name: 'main'
                     },*/
                ]
            },
            {
                path: '/categorias', component: categorias, props:true,
                children: [
                    /* {s
                     path: '/',
                     component: Business,
                     name: 'main'
                     },*/
                ]
            },
            {
                path: '/archivos', component: archivos, props:true,
                children: [
                    /* {
                     path: '/',
                     component: Business,
                     name: 'main'
                     },*/
                ]
            },
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
