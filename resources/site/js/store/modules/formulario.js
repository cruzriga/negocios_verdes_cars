import Vue from 'vue'
import Vuex from 'vuex'
import { request } from './../util';

Vue.use(Vuex);

export const CARGAR_CATEGORIA = 'CARGAR_CATEGORIA'
export const CATEGORIAS = 'CATEGORIAS'
export const GUARDAR_FORMULARIO = 'GUARDAR_FORMULARIO'
export const GUARDAR_DOCUMENTOS = 'GUARDAR_DOCUMENTOS'
export const GUARDAR_PRODUCTOS = 'GUARDAR_PRODUCTOS'
export const CARGAR_EMPRESAS = 'CARGAR_EMPRESAS'
export const GUARDAR_FILE = 'GUARDAR_FILE'
export const GUARDAR_DOC = 'GUARDAR_DOC'
export const CARGANDO = 'CARGANDO'

const store = 
    {        
        namespaced: true,
        state: {
            categoria:{
                categorias:[],
                subcategorias:[],
                tiposubcategorias:[]
            },
            cargando:false,
            municipios: [
                {
                    label: 'Albania',
                    value: 'Albania',
                    icon: 'img:media/iconospng/Flag_of_Albania.png'
                },
                {
                    label: 'Barrancas',
                    value: 'Barrancas',
                    icon: 'img:media/iconospng/Flag_of_Barrancas.png'
                },
                {
                    label: 'Dibulla',
                    value: 'Dibulla',
                    icon: 'img:media/iconospng/Flag_of_Dibulla.png'
                },
                {
                    label: 'Distracción',
                    value: 'Distracción',
                    icon: 'img:media/iconospng/Flag_of_Distracción.png'
                },
                {
                    label: 'El Molino',
                    value: 'El Molino',
                    icon: 'img:media/iconospng/Flag_of_El_Molino.png'
                },
                {
                    label: 'Fonseca',
                    value: 'Fonseca',
                    icon: 'img:media/iconospng/Flag_of_Fonseca.png'
                },
                {
                    label: 'Hatonuevo',
                    value: 'Hatonuevo',
                    icon: 'img:media/iconospng/Flag_of_Hatonuevo.png'
                },
                {
                    label: 'La Jagua del Pilar',
                    value: 'La Jagua del Pilar',
                    icon: 'img:media/iconospng/Flag_of_La_Jagua_del_Pilar.png'
                },
                {
                    label: 'Maicao',
                    value: 'Maicao',
                    icon: 'img:media/iconospng/Flag_of_Maicao.png'
                },
                {
                    label: 'Manaure',
                    value: 'Manaure',
                    icon: 'img:media/iconospng/Flag_of_Manaure.png'
                },
                {
                    label: 'Riohacha',
                    value: 'Riohacha',
                    icon: 'img:media/iconospng/Flag_of_Riohacha.png'
                },
                {
                    label: 'San Juan del Cesar',
                    value: 'San Juan del Cesar',
                    icon: 'img:media/iconospng/Flag_of_San_Juan_del_Cesar.png'
                },
                {
                    label: 'Uribia',
                    value: 'Uribia',
                    icon: 'img:media/iconospng/Flag_of_Uribia.png'
                },
                {
                    label: 'Urumita',
                    value: 'Urumita',
                    icon: 'img:media/iconospng/Flag_of_Urumita.png'
                },
                {
                    label: 'Villanueva',
                    value: 'Villanueva',
                    icon: 'img:media/iconospng/Flag_of_Villanueva.png'
                }
            ],
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
                    commit(CATEGORIAS,resp.resp)
                }
            },
            async GUARDAR_FILE ({ commit },datos){
                commit(CARGANDO,true)
                const config = { headers:{'Content-Type':'multipart/form-data'}};
                let resp = await request('../?option=com_mrnegociosverde&task=uploadFile&format=json&idempresa='+datos.idempresa,datos.file,config)
                // console.log(resp)
                if(resp.ok){
                    return resp;
                }
                commit(CARGANDO,false)
                return resp;
            },
            async GUARDAR_FORMULARIO ({ commit },datos){
                commit(CARGANDO,true)         
                var datopost = 'json='+encodeURIComponent(JSON.stringify(datos.formulario));
                // console.log(datopost); return;

                let resp = await request(root_url+'?option=com_mrnegociosverde&task=savedatosempresa&format=json',datopost)
                // console.log(resp);
                // return resp
                if(resp.ok){
                    if (datos.productos!=null) {
                        datos.productos.forEach((element,key) => {
                            if (datos.productos[key].idempresa==null || datos.productos[key].idempresa=='') {                                
                                datos.productos[key].idempresa = (resp.resp==null||resp.resp=='')?datos.formulario.idempresa:resp.resp;
                            }
                        });
                        // console.log(datos)
                        // console.log(datos.formulario.idempresa);
                        let resppro = await this.dispatch('formulario/GUARDAR_PRODUCTOS', datos);
                        if(!resppro.ok){
                            return resppro
                        }
                        if (datos.imagenlogo!=null) {
                            console.log(datos.formulario.idempresa);
                            let obj = {
                                idempresa: (resp.resp==null||resp.resp=='')?datos.formulario.idempresa:resp.resp,
                                file: datos.imagenlogo,
                                admiurl: datos.admiurl
                            }
                            let respdoc = await this.dispatch('formulario/GUARDAR_FILE', obj);
                            // console.log(respdoc)
                            if(!respdoc.ok){
                                return respdoc
                            }
                            if (datos.documentos!=null) {
                                let obj = {
                                    idempresa: (resp.resp==null||resp.resp=='')?datos.formulario.idempresa:resp.resp,
                                    file: datos.documentos,
                                    admiurl: datos.admiurl
                                }
                                respdoc = await this.dispatch('formulario/GUARDAR_FILE', obj);
                            }
                            return respdoc
                        }
                    }else{
                        return resp
                    }
                    commit(CARGANDO,false)
                }
            },
            async GUARDAR_PRODUCTOS ({ commit },datos){                
                commit(CARGANDO,true)
                var datopost = 'json='+JSON.stringify(datos.productos);
                let puntos = datos.admiurl?'../':'';
                let resp = await request(puntos+'?option=com_mrnegociosverde&task=addproductos&format=json',datopost)
                if(resp.ok){                
                    return resp
                }
                commit(CARGANDO,false)
            },
            async GUARDAR_DOCUMENTOS ({ commit },datos){                
                commit(CARGANDO,true)
                var datopost = 'json='+JSON.stringify(datos.prop4);
                let puntos = datos.admiurl?'../':'';
                let resp = await request(puntos+'?option=com_mrnegociosverde&task=adddocumentos&format=json',datopost)
                if(resp.ok){
                    commit(CARGANDO,false)
                    return resp
                }
                commit(CARGANDO,false)
            },
            async CARGAR_EMPRESAS ({ commit },datos){
                commit(CARGANDO,true)
                let puntos = datos.admiurl?'../':'';
                let resp = await request(puntos+'index.php?option=com_mrnegociosverde&task=getempresassite&format=json&pagina='+datos.pagina+'&numlist='+datos.numlist)
                // console.log(resp)
                if(resp.ok){
                    commit(EMPRESAS,resp.resp)
                    commit(CARGANDO,false)
                }
            }
        }
    };
export default store