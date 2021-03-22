import Vue from 'vue';
import store from './store/store';
import router from './router';
import index from './index'
import Quasar from "quasar";
import VueMasonry from 'vue-masonry-css'
import Croppa from 'vue-croppa'
// import iconSet from 'quasar/icon-set/fontawesome-v5'

Vue.use(Quasar, {
    // iconSet: iconSet,
    config: {
        dark: false,
        addressbarColor: "secondary",
        preFetch: true
    },
})

Vue.use(VueMasonry);
Vue.use(Croppa);

window.vue  = new Vue({
                          router,
                          store,
                          data:{},
                          render: h => h(index)}
                          
).$mount('#appsite');