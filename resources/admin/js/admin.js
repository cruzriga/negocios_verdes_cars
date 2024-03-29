import Vue from 'vue';
import store from './store/store';
import router from './router';
import index from './index'
import Quasar from "quasar";
import VueMasonry from 'vue-masonry-css'
import Croppa from 'vue-croppa'
import JsonExcel from "vue-json-excel"

Vue.use(Quasar, {
    config: {
        dark: false,
        addressbarColor: "secondary",
        preFetch: true
    }
})

Vue.use(VueMasonry);
Vue.use(Croppa);

Vue.component("downloadExcel", JsonExcel);

window.vue  = new Vue({
                          router,
                          store,
                          data:{},
                          render: h => h(index)}
).$mount('#appadmin');
