import Vue from 'vue'
import Vuex from 'vuex'
import { request } from './../util';

Vue.use(Vuex);
export const CARGAR_EMPRESAS = 'CARGAR_EMPRESAS'
export const REMOVER_IMG_CARRUSEL = 'REMOVER_IMG_CARRUSEL'
export const CAMBIAR_ESTADO_EMPRESA = 'CAMBIAR_ESTADO_EMPRESA'
export const EMPRESAS = 'EMPRESAS'
export const CARGANDO = 'CARGANDO'

const store = 
    {
        namespaced: true,
        state: {
            empresas:{
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
                let emp = empresas.data.empresas.map(
                    e => {
                        e.adic = parseInt(e.adic);
                        e.cumplimiento = parseInt(e.cumplimiento);
                        return e
                    }
                )
                empresas.data.empresas = emp;
                state.empresas = empresas;
            },
            [CARGANDO](state, bool){
                state.cargando = bool;
            }
            
        },
        actions:{
            async CARGAR_EMPRESAS ({ commit }, datos){
                commit(CARGANDO,true)
                var datopost = 'filtros=' + JSON.stringify(datos.filtros);
                let resp = await request('index.php?option=com_mrnegociosverde&task=getempresasadmin&format=json&pagina=' + datos.pagina + '&numlist=' + datos.numlist, datopost)
                // console.log(resp)
                if(resp.ok){
                    commit(EMPRESAS,resp.resp)
                    commit(CARGANDO,false)
                }
            },
            async BUSCAR_EMPRESAS ({ commit },datos){
                commit(CARGANDO,true)
                var datopost = 'filtros=' + JSON.stringify(datos.filtros);
                let resp = await request('?option=com_mrnegociosverde&task=getempresasadmin&format=json&buscar=' + datos.buscar + '&campo=' + datos.campo, datopost)
                // console.log(resp)
                if(resp.ok){
                    commit(CARGANDO,false)
                    if (datos.campo=='e.idempresa') {                        
                        return(resp.resp.data.empresas[0])
                    }else{
                        commit(EMPRESAS,resp.resp)
                    }
                }
            },
            async DESCARGAR_EMPRESAS({ commit }, datos) {
                commit(CARGANDO, true)
                var datopost = 'filtros=' + JSON.stringify(datos.filtros);
                let resp = await request('?option=com_mrnegociosverde&task=dempresasadmin&format=json&buscar=' + datos.buscar + '&campo=' + datos.campo, datopost)
                
                if (resp.ok) {
                    if (datos.campo == 'e.idempresa') {
                        return (resp.resp.data.empresas[0])
                    } else {
                        commit(EMPRESAS, resp.resp)
                    }
                }
                commit(CARGANDO, false);
            },
            async CAMBIAR_ESTADO_EMPRESA ({ commit },datos){
                commit(CARGANDO,true)
                var datopost = 'json='+JSON.stringify(datos);
                let resp = await request('index.php?option=com_mrnegociosverde&task=updateestadorempresa&format=json',datopost)
                if(resp.ok){
                    return resp;
                }
            },
            async REMOVER_IMG_CARRUSEL ({ commit },datos){
                commit(CARGANDO,true)
                var datopost = 'json='+encodeURIComponent(JSON.stringify(datos));
                let resp = await request('index.php?option=com_mrnegociosverde&task=removeimgcarrusel&format=json',datopost)
                if(resp.ok){
                    return resp;
                }
            }
            
        }
    };
export default store