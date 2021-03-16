import Vue from 'vue'
import Vuex from 'vuex'
import { request } from './util';

Vue.use(Vuex);
export const CARGAR_EMPRESAS = 'CARGAR_EMPRESAS'
export const EMPRESAS = 'EMPRESAS'
export const CARGANDO = 'CARGANDO'

const store = new Vuex.Store(
    {
        state: {
            empresas:[],
            cargando:false
        },
        getters:{
            bg(state){
                return ;
            },
        },
        mutations:{
            [EMPRESAS](state, empresas){
                state.empresas = empresas;
            },
            [CARGANDO](state, bool){
                state.cargando = bool;
            }
            
        },
        actions:{
            async CARGAR_EMPRESAS ({ commit }){
                commit(CARGANDO,true)
                let resp = await request('index.php?option=com_mrnegociosverde&task=getempresas&format=json')
                if(resp.ok){
                    commit(EMPRESAS,resp)
                    commit(CARGANDO,false)
                }
            }
        },
        modules:{
        
        }
    });
export default store
