import Vue from 'vue'
import Vuex from 'vuex'
import { request } from './../util';

Vue.use(Vuex);
export const CARGAR_EMPRESAS = 'CARGAR_EMPRESAS'
export const CAMBIAR_ESTADO_EMPRESA = 'CAMBIAR_ESTADO_EMPRESA'
export const EMPRESAS = 'EMPRESAS'
export const CARGANDO = 'CARGANDO'

const store = 
    {
        namespaced: true,
        state: {
            empresas:{data:[]},
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
            async CARGAR_EMPRESAS ({ commit },datos){
                commit(CARGANDO,true)
                let resp = await request('index.php?option=com_mrnegociosverde&task=getempresas&format=json&pagina='+datos.pagina+'&numlist='+datos.numlist)
                // console.log(resp)
                if(resp.ok){
                    commit(EMPRESAS,resp.resp)
                    commit(CARGANDO,false)
                }
            },
            async CAMBIAR_ESTADO_EMPRESA ({ commit },datos){
                commit(CARGANDO,true)
                var datopost = 'json='+JSON.stringify(datos);
                let resp = await request('index.php?option=com_mrnegociosverde&task=updateEstadorEmpresa&format=json',datopost)
                if(resp.ok){
                    return resp;
                }
            }
        }
    };
export default store
