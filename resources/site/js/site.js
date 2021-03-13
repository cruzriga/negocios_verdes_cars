import Vue from 'vue';
import store from './store';
// import router from './router';
import index from './index'
import Quasar from "quasar";

Vue.use(Quasar, {
    config: {
        dark: false,
        addressbarColor: "secondary",
        preFetch: true
    }
})


window.vue  = new Vue({
                        //   router,
                          store,
                          data:{},
                          render: h => h(index)}
).$mount('#appsite');