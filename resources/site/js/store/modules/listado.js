import Vue from 'vue'
import Vuex from 'vuex'
import { request } from './../util';

Vue.use(Vuex);

export const CARGAR_EMPRESAS = 'CARGAR_EMPRESAS'
export const EMPRESAS = 'EMPRESAS'
export const CARGANDO = 'CARGANDO'

const store = 
    {        
        namespaced: true,
        state: {
            ListaEmpresas:[],
            cargando:false
        },
        getters:{
            bg(state){
                return ;
            },
        },
        mutations:{
            [EMPRESAS](state, empresas){
                state.ListaEmpresas = empresas;
            },
            [CARGANDO](state, bool){
                state.cargando = bool;
            },
            
        },
        actions:{
            async CARGAR_EMPRESAS ({ commit },datos){
                commit(CARGANDO,true)
                let resp = await request('index.php?option=com_mrnegociosverde&task=getempresassite&format=json&pagina='+datos.pagina+'&numlist='+datos.numlist)
                // console.log(resp)
                if(resp.ok){
                    commit(EMPRESAS,resp.resp)
                    commit(CARGANDO,false)
                }
            },
        }
    };
export default store