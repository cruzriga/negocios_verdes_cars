import Vue from 'vue'
import Vuex from 'vuex'
import { request } from './../util';

Vue.use(Vuex);

export const CARGAR_CATEGORIA = 'CARGAR_CATEGORIA'
export const CATEGORIAS = 'CATEGORIAS'
export const GUARDAR_FORMULARIO = 'GUARDAR_FORMULARIO'
export const GUARDAR_DOCUMENTOS = 'GUARDAR_DOCUMENTOS'
export const GUARDAR_PRODUCTOS = 'GUARDAR_PRODUCTOS'
export const GUARDAR_FILE = 'GUARDAR_FILE'
export const GUARDAR_DOC = 'GUARDAR_DOC'
export const CARGANDO = 'CARGANDO'

const store = 
    {        
        namespaced: true,
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
            async GUARDAR_FILE ({ commit },datos){
                commit(CARGANDO,true)
                const config = { headers:{'Content-Type':'multipart/form-data'}};
                let resp = await request('?option=com_mrnegociosverde&task=uploadFile&format=json&idempresa='+datos.idempresa,datos.file,config)
                if(resp.ok){
                    return resp;
                }
                commit(CARGANDO,false)
            },
            async GUARDAR_FORMULARIO ({ commit },datos){
                commit(CARGANDO,true)         
                var datopost = 'json='+JSON.stringify(datos.formulario);
                let resp = await request('?option=com_mrnegociosverde&task=savedatosempresa&format=json',datopost)                
                if(resp.ok){
                    if (datos.productos!=null) {                        
                        datos.productos.forEach((element,key) => {
                            datos.productos[key].idempresa = resp.resp;
                        });
                        this.dispatch('formulario/GUARDAR_PRODUCTOS', datos);
                        if (datos.imagenlogo!=null) {
                            let obj = {
                                idempresa: resp.resp,
                                file: datos.imagenlogo
                            }
                            this.dispatch('formulario/GUARDAR_FILE', obj);
                            if (datos.documentos!=null) {
                                let obj = {
                                    idempresa: resp.resp,
                                    file: datos.documentos
                                }
                                this.dispatch('formulario/GUARDAR_FILE', obj);
                            } 
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
                var datopost = 'json='+JSON.stringify(datos.productos);
                let resp = await request('?option=com_mrnegociosverde&task=addproductos&format=json',datopost)
                if(resp.ok){                
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
        }
    };
export default store