import Vue from 'vue'
import Vuex from 'vuex'
import { request } from './util';

Vue.use(Vuex);
export const CARGAR_CATEGORIA = 'CARGAR_CATEGORIA'
export const CATEGORIAS = 'CATEGORIAS'
const store = new Vuex.Store(
    {
        state: {
            categoria:null
        },
        getters:{
            bg(state){
                return ;
            },
        },
        mutations:{
            [CATEGORIAS](state, categorias){
                state.categoria = categorias;
            },
            
        },
        actions:{
            async CARGAR_CATEGORIA ({ commit }){
                let resp = await request('?option=com_mrnegociosverde&task=categorias&format=json')
                console.log(resp);
                if(resp.ok){
                    commit(CATEGORIAS,resp)
                }
            }
        },
        modules:{
        
        }
    });
export default store
