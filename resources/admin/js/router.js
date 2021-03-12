import Vue from 'vue'
import VueRouter from 'vue-router'
import dashboard from "./pages/dashboard";

Vue.use(VueRouter);


const router = new VueRouter(
    {
        routes :[
            {
                path    : '*',
                redirect: '/',
            },
            {
                path: '/', component: dashboard, props:true,
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
