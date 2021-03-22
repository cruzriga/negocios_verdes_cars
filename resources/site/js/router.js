import Vue from 'vue'
import VueRouter from 'vue-router'
import listanegocios from "./pages/ListaNegocios";
import registrar from "./pages/Registrar";

Vue.use(VueRouter);


const router = new VueRouter(
    {
        routes :[
            {
                path    : '*',
                redirect: '/',
            },
            {
                path: '/', component: listanegocios, props:true,
                children: [
                    /* {
                     path: '/',
                     component: Business,
                     name: 'main'
                     },*/
                ]
            },
            {
                path: '/registrar', component: registrar, props:true,
                children: [
                    /* {s
                     path: '/',
                     component: Business,
                     name: 'main'
                     },*/
                ]
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
