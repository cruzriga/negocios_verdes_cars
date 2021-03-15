import Vue from 'vue'
import Vuex from 'vuex'
import { request } from './util';

Vue.use(Vuex);
export const CARGAR_CATEGORIA = 'CARGAR_CATEGORIA'
export const CATEGORIAS = 'CATEGORIAS'
export const GUARDAR_FORMULARIO = 'GUARDAR_FORMULARIO'
export const GUARDAR_DOCUMENTOS = 'GUARDAR_DOCUMENTOS'
export const GUARDAR_PRODUCTOS = 'GUARDAR_PRODUCTOS'
export const GUARDAR_IMG = 'GUARDAR_IMG'
export const GUARDAR_DOC = 'GUARDAR_DOC'
export const CARGANDO = 'CARGANDO'

const store = new Vuex.Store(
    {
        state: {
            categoria:[],
            cargando:false
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
            [CARGANDO](state, bool){
                state.cargando = bool;
            },
            
        },
        actions:{
            async CARGAR_CATEGORIA ({ commit }){
                let resp = await request('?option=com_mrnegociosverde&task=categorias&format=json')
                // console.log(resp);
                if(resp.ok){
                    commit(CATEGORIAS,resp)
                }
            },
            async GUARDAR_IMG ({ commit },datos){
                commit(CARGANDO,true)
                let resp = await request('?option=com_mrnegociosverde&task=uploadimg&format=json',datos.prop1)
                if(resp.ok){
                    if (datos.prop2!=null) {                        
                        datos.prop2.imagenlogo = resp.resp            
                        this.dispatch('GUARDAR_FORMULARIO', datos);
                    }else{
                        return resp;
                    }   
                }
            },
            async GUARDAR_DOC ({ commit },datos){
                let resp = await request('?option=com_mrnegociosverde&task=uploaddoc&format=json',datos)
                if(resp.ok){
                    return resp
                }
            },
            async GUARDAR_FORMULARIO ({ commit },datos){
                commit(CARGANDO,true)         
                var datopost = 'json='+JSON.stringify(datos.prop2);
                let resp = await request('?option=com_mrnegociosverde&task=savedatosempresa&format=json',datopost)                
                if(resp.ok){
                    if (datos.prop3!=null) {                        
                        datos.prop3.forEach((element,key) => {
                            datos.prop3[key].idempresa = resp.resp;
                        });
                        this.dispatch('GUARDAR_PRODUCTOS', datos);
                        if (datos.prop4!=null) {
                            datos.prop4.forEach((element,key) => {
                                datos.prop4[key].idempresa = resp.resp;
                            });
                            this.dispatch('GUARDAR_DOCUMENTOS', datos);
                        } 
                    }else{
                        commit(CARGANDO,false)
                        return resp
                    }
                    commit(CARGANDO,false)
                }
            },
            async GUARDAR_PRODUCTOS ({ commit },datos){                
                commit(CARGANDO,true)
                var datopost = 'json='+JSON.stringify(datos.prop3);
                let resp = await request('?option=com_mrnegociosverde&task=addproductos&format=json',datopost)
                if(resp.ok){                      
                    commit(CARGANDO,false)
                    return resp
                }
                commit(CARGANDO,false)
            },
            async GUARDAR_DOCUMENTOS ({ commit },datos){                
                commit(CARGANDO,true)
                var datopost = 'json='+JSON.stringify(datos.prop4);
                let resp = await request('?option=com_mrnegociosverde&task=adddocumentos&format=json',datopost)
                if(resp.ok){
                    commit(CARGANDO,false)
                    return resp
                }
                commit(CARGANDO,false)
            }
        },
        modules:{
        
        }
    });
export default store
