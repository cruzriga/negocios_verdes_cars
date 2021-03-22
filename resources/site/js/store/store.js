import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

import formulario from './modules/formulario'
import listado from './modules/listado'

export default function (/* { ssrContext } */) {
  const Store = new Vuex.Store({
    modules: {
      formulario: formulario,
      listado: listado
    },

    // enable strict mode (adds overhead!)
    // for dev mode only
    strict: process.env.DEBUGGING
  })
  return Store
}
  