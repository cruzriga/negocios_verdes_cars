import Vue from 'vue'
import Vuex from 'vuex'
import { request } from './../util';

Vue.use(Vuex);

export const CARGAR_EMPRESAS = 'CARGAR_EMPRESAS'
export const BUSCAR_EMPRESAS = 'BUSCAR_EMPRESAS'
export const EMPRESAS = 'EMPRESAS'
export const CARGANDO = 'CARGANDO'

const store = 
    {        
        namespaced: true,
        state: {
            ListaEmpresas:{
                data:{
                    pagina:0,
                    empresas:[]
                }
            },
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
                    if (resp.resp!=null && resp.resp!='') {
                        commit(EMPRESAS,resp.resp)
                    }
                    commit(CARGANDO,false)
                }
            },
            async BUSCAR_EMPRESAS ({ commit },datos){
                commit(CARGANDO,true)
                let resp = await request('../?option=com_mrnegociosverde&task=getempresassite&format=json&buscar='+datos.buscar+'&campo='+datos.campo)
                // console.log(resp)
                if(resp.ok){
                    commit(CARGANDO,false)
                    if (datos.campo=='e.idempresa') {                        
                        return(resp.resp.data.empresas[0])
                    }else{
                        commit(EMPRESAS,resp.resp)
                    }
                }
            }
        }
    };
export default store