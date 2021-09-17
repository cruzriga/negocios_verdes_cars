import Vue from 'vue'
import Vuex from 'vuex'
import formulario from './../../../site/js/store/modules/formulario'
import listado from './../../../site/js/store/modules/listado'
import administrar from './modules/admin';
Vue.use(Vuex);

const store = new Vuex.Store(
    {
        modules:{
            formulario: formulario,
            admin: administrar,
            listado: listado,
        }
    });
export default store
