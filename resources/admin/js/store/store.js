import Vue from 'vue'
import Vuex from 'vuex'
import formulario from './../../../site/js/store/modules/formulario'
import administrar from './modules/admin';
Vue.use(Vuex);

const store = new Vuex.Store(
    {
        modules:{
            formulario: formulario,
            admin: administrar
        }
    });
export default store
