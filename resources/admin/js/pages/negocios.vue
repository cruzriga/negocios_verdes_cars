<template>
  <q-page class="row">

    <!-- BEGIN Filtros -->
     <q-list dense bordered class="rounded-borders col-3 q-mr-md"  >
      <h6 class="q-pl-md text-body2 text-weight-bold text-uppercase">Filtros</h6>

      <q-separator />
      
      <div class="q-pl-md q-pt-md text-weight-medium">Estado</div>
      <q-item v-for="(estado, index) in estados" :key="index" >
        <q-checkbox 
          v-model="estadosFiltro" 
          :val="estado.id" 
          :label="estado.label" 
          color="teal" 
          size="xs"
          @input="filtrar"
        />
      </q-item>

      <q-separator />

      <div class="q-pl-md  q-pt-md  text-weight-medium">Categoria</div>
      <q-item v-for="categoria in this.$store.state.formulario.categoria.categorias" :key="categoria.idcategoria" >
        <q-checkbox 
          v-model="categoriasFiltro" 
          :val="categoria.idcategoria" 
          :label="categoria.nombre" 
          color="teal" 
          size="xs"
          @input="filtrar"
        />
      </q-item>

      <q-separator />

      <div class="q-pl-md q-pt-md text-weight-medium">Cumplimiento</div>
      <q-item v-for="cumplimiento in nivelCumplimiento" :key="cumplimiento.id" >
        <q-checkbox 
          v-model="nivelCumplimientoFiltro" 
          :val="cumplimiento" 
          :label="cumplimiento.start + '-' + cumplimiento.end + ' ' + cumplimiento.label" 
          color="teal"
          size="xs"
          @input="filtrar"
        />
      </q-item>

      <q-separator />

        <div class="q-pl-md q-pt-md text-weight-medium">Municipio</div>
        <q-item v-for="municipio in $store.state.formulario.municipios" :key="municipio.id" >
          <q-checkbox 
            v-model="municipioFiltro" 
            :val="municipio.label" 
            :label="municipio.label"
            color="teal"
            size="xs"
            @input="filtrar"
          />
        </q-item>

      <q-separator />

      <q-item class="q-mt-lg">
        <!-- download-excel :data="json_data">
          Descargar
          
        </download-excel -->
        <a :href="getURLToDownload" target="_blank" flat class="full-width btn bg-secondary text-white q-pa-md no-border text-subtitle2">
          <q-icon name="download" />
          Descargar empresas
        </a>
      </q-item>
     
    </q-list>

    <!-- END Filtros -->


    <q-list bordered class="rounded-borders col-8"  >
      <q-item-label  header>
        <q-toolbar class="text-primary" style="height: 50px">
          <q-input @keyup.enter="buscar" class="GPL__toolbar-input" dense standout="bg-primary" v-model="search" placeholder="Buscar">
            <template v-slot:prepend>
              <q-icon v-if="search === ''" name="search" />
              <q-icon v-else name="clear" class="cursor-pointer" @click="search = ''" />
            </template>
          </q-input>
          <q-space/>
          <div>
             <span class="q-mr-md"> {{this.$store.state.admin.empresas.data.pagina+1}} - {{this.$store.state.admin.empresas.data.total}} </span> <q-btn @click="backPage(-1)" flat round dense icon="arrow_back_ios" class=""/> <q-btn @click="nextPage(1)" flat round dense icon="arrow_forward_ios" />
          </div>
        </q-toolbar>
      </q-item-label>
      <template v-if = "items.length > 0">
      <div v-for="(empresa, count) in this.$store.state.admin.empresas.data.empresas" v-bind:key="count">
        <!-- {{empresa}} -->
        <q-separator spaced/>
        <q-item>
          <q-item-section avatar style="width: 90px;">
            <q-img :src="root_url+empresa.imagenlogo" style="height: 80px;">
              <template v-slot:error>
                <div class="absolute-full flex flex-center bg-grey-6 text-white rounded-borders">
                  <q-icon name="image" size="md"></q-icon>
                </div>
              </template>
            </q-img>
          </q-item-section>

          <q-item-section top>
            <q-item-label lines = "1">
              <a style="cursor: pointer;color:#000000;" @click="openPerfil(empresa.idempresa,empresa)" >
                <span class = "q-mt-xs text-body2 text-weight-bold text-uppercase">{{empresa.nombreempresa}}</span>
              </a>
            </q-item-label>
            <q-item-label lines="1">
              <span class = "text-grey-8">
                <q-icon name="date_range" class="q-mr-md"/>
                {{empresa.fechaCreacion}}
              </span>
                <q-badge @click="mostrarBtnCambioEstado=true" :color="estados[empresa.estado].color" class="q-ml-md">
                  <template v-slot:default>
                    <div>{{estados[empresa.estado].label}}</div>
                    <q-menu v-if="mostrarBtnCambioEstado==true" auto-close rounded size='xs' padding='xs'>
                      <q-list style="min-width: 100px">
                        <q-item v-for="estado in estados" :key="estado.id+'e'" @click="cambiarEstadoInterno(empresa.idempresa, estado.id)" clickable>
                          <q-item-section>{{estado.label}}</q-item-section>
                        </q-item>
                      </q-list>
                    </q-menu>
                  </template>
                  
                </q-badge>
                
            </q-item-label>
            <q-item-label caption lines = "1">
              {{empresa.descripcion}}             
            </q-item-label>
            <q-item-label caption lines = "1" class="row">
              <div class="q-pr-xs">
                <q-icon name="face" /> {{empresa.representantelegal}} </div>
              <div class="q-pr-xs">
                | <q-icon name="gps_fixed" /> {{empresa.municipio}}
              </div>
              <div class="q-pr-xs">
                | <q-icon name="phone" /> {{empresa.telefono}}
              </div>
              <div class="q-pr-xs">
                | <q-icon name="mail" /> {{empresa.email}}
              </div>
              <div v-if="empresa.documentos.length>1" class="q-pr-xs">
                | <q-icon name="attach_file" /> {{empresa.documentos.length}}
              </div>              
            </q-item-label>
            <q-item-label lines = "1" class = "q-mt-xs text-body2 text-weight-bold text-uppercase">
              <span v-if="empresa.categoria.nombre  != ''  && empresa.categoria.nombre  != null"> - {{empresa.categoria.nombre}}</span>
              <span v-if="empresa.subcategoria.nombre  != '' && empresa.subcategoria.nombre  != null "> - {{empresa.subcategoria.nombre}}</span>
              <span v-if="empresa.tiposubcategoria.nombre  != ''  && empresa.tiposubcategoria.nombre  != null"> - {{empresa.tiposubcategoria.nombre}}</span>
            </q-item-label>
          </q-item-section>
          <q-item-section side style="align-items: center;" top>
            <q-item-label lines = "1" >
              <span class = "q-mt-xs text-weight-bold ">Cump</span>
            </q-item-label >
            <q-item-label lines = "1" >
              <q-knob
                  v-model="empresa.cumplimiento"
                  show-value
                  size="50px"
                  color="teal"
                  track-color="grey-3"
                  readonly

              >
              <div class="q-pa-md">
                <div class="cursor-pointer">
                  {{ empresa.cumplimiento }}
                  <q-popup-edit v-model="empresa.cumplimiento" :validate="val => val > 0">
                    <template v-slot="{ initialValue, value, emitValue, validate, set, cancel }">
                      <q-input
                        autofocus
                        dense
                        :value="empresa.cumplimiento"
                        @input="emitValue"
                      >
                        <template v-slot:after>
                          <q-btn flat dense color="negative" icon="cancel" @click.stop="cancel" />
                          <q-btn @click="updatevalues('cumplimiento',empresa.cumplimiento,empresa.idempresa)" flat dense color="positive" icon="check_circle" @click.stop="set" :disable="validate(value) === false || initialValue === value" />
                        </template>
                      </q-input>
                    </template>
                  </q-popup-edit>
                </div>
              </div>

              </q-knob>
            </q-item-label>
          </q-item-section>

          <q-item-section side style="align-items: center;" top>
            <q-item-label lines = "1" >
              <span class = "q-mt-xs text-weight-bold ">Adic</span>
            </q-item-label >
            <q-item-label lines = "1" >
              <q-knob
                  v-model="empresa.adic"
                  show-value
                  size="50px"
                  color="teal"
                  track-color="grey-3"
                  readonly
              >

              <div class="q-pa-md">
                <div class="cursor-pointer">
                  {{ empresa.adic }}
                  <q-popup-edit v-model="empresa.adic" :validate="val => val > 1">
                    <template v-slot="{ initialValue, value, emitValue, validate, set, cancel }">
                      <q-input
                        autofocus
                        dense
                        :value="empresa.adic"
                        @input="emitValue"
                      >
                        <template v-slot:after>
                          <q-btn flat dense color="negative" icon="cancel" @click.stop="cancel" />
                          <q-btn @click="updatevalues('adic',empresa.adic,empresa.idempresa)" flat dense color="positive" icon="check_circle" @click.stop="set" :disable="validate(value) === false || initialValue === value" />
                        </template>
                      </q-input>
                    </template>
                  </q-popup-edit>
                </div>
              </div>

              </q-knob>
            </q-item-label>
          </q-item-section>

          <q-item-section side style="align-items: center;" top v-if="false">
            <q-item-label lines = "1" >
              <span class = "q-mt-xs text-weight-bold ">Interpretación</span>
            </q-item-label >
            <q-item-label lines = "1" >
              <q-chip class = "text-uppercase" >
                AVANZADO
              </q-chip>
            </q-item-label>
          </q-item-section>
          <q-item-section top side>
              <q-toggle
                  false-value="0"
                  true-value="1"
                  v-model="empresa.activo"
                  :key="empresa.idempresa"
                  :name="empresa.idempresa"
                  :ref="'activo' + empresa.idempresa"
                  color="green"
                  icon="check"
                  @input="onToggleChange"
              />
          </q-item-section>
          <q-item-section top side>
            <q-btn class="more_vert" ound flat icon="more_vert">
              <q-menu auto-close :offset="[110, 0]">
                <q-list style="min-width: 150px">
                  <q-item clickable @click="openFormulario(empresa)">
                    <q-item-section>Editar</q-item-section>
                  </q-item>
                  <q-item clickable @click="openModalImg(empresa)">
                    <q-item-section>Insertar Imagen</q-item-section>
                  </q-item>
                  <q-item clickable @click="openModalAdjunto(empresa.documentos)">
                    <q-item-section>Adjuntos</q-item-section>
                  </q-item>
                </q-list>
              </q-menu>
            </q-btn>
          </q-item-section>
        </q-item>
      </div>

      </template>
      <q-item v-else>
          <q-item-section avatar top class="full-width">
           <div class="fit row wrap justify-center items-center content-center" style="min-height: 400px;">
             <div class="text-grey" style="max-width: 500px;">
               <h1><q-icon name="manage_search"></q-icon></h1>
               <h5>Sin registros</h5>
             </div>
           </div>
          </q-item-section>
        </q-item>
    </q-list>
    <q-inner-loading :showing="this.$store.state.admin.cargando">
      <q-spinner-hourglass size="5.5em" color="green" />
    </q-inner-loading>
    <ModalAdjunto ref="modalAdjunto"/>
  </q-page>
</template>

<script>
import ModalAdjunto from './../components/Modal';

export default {
  name: 'Negocios',
  components:{ ModalAdjunto },
  data(){
    return {
      mostrarBtnCambioEstado: false,
      debug: false,
      id: 0,
      msg: 'Hey Nic Raboy',
      search:'',
      online: false,
      items : [1],
      adic: 60,
      cump : 80,
      municipioFiltro: [],
      nivelCumplimientoFiltro: [],
      nivelCumplimiento: [
        {
          id: 0,
          start: 0,
          end: 10,
          label: 'Inicial',
        },
        {
          id: 1,
          start: 11,
          end: 30,
          label: 'Básico',
        },
        {
          id: 2,
          start: 31,
          end: 50,
          label: 'Intermedio',
        },
        {
          id: 3,
          start: 51,
          end: 80,
          label: 'Satisfactorio',
        },
        {
          id:4,
          start: 81,
          end: 100,
          label: 'Avanzado',
        },
        {
          id:5,
          start: 'adic',
          end: 100,
          label: '81-100 - Ideal + Adicional (50-100)',
        }
      ],
      pagina:0,
      numlist: 50,
      labeladic:this.adic,
      labelcump:this.cump,
      root_url,
      categoriasFiltro: [],
      estadosFiltro: [],
      estados: [
        {
          id: 0,
          label: 'Preinscrito',
          color: 'cyan-4'
        },
        {
          id: 1,
          label: 'En revision',
          color: 'orange-5'
        },
        {
          id: 2,
          label: 'Rechazado',
          color: 'deep-orange-5'
        },
        {
          id: 3,
          label: 'Aceptado',
          color: 'green-5'
        },
      ],
    }
  },
  computed: {
    getURLToDownload: function() {
      let filtros = {
          municipioFiltro: this.municipioFiltro,
          nivelCumplimientoFiltro: this.nivelCumplimientoFiltro,
          categoriasFiltro: this.categoriasFiltro,
          estadosFiltro: this.estadosFiltro,
      };
      return "?option=com_mrnegociosverde&task=downloadempresas&format=json&buscar='"
                + this.search
                + '&campo=e.nombreempresa' 
                + "&filtros=" + encodeURIComponent(JSON.stringify(filtros));
    },
  },
  beforeMount () {
    let obj = {
      pagina: this.pagina,
      numlist: this.numlist,
      filtros: {
        municipioFiltro: this.municipioFiltro,
        nivelCumplimientoFiltro: this.nivelCumplimientoFiltro,
        categoriasFiltro: this.categoriasFiltro,
        estadosFiltro: this.estadosFiltro,
      }
    }
    this.$store.dispatch('admin/CARGAR_EMPRESAS',obj);
    this.$store.dispatch('formulario/CARGAR_CATEGORIA');
  },
  methods: {
    status(n){
      return this.estados[n]
    },
    async cambiarEstadoInterno(idEmpresa, estadoInterno) {
      let data= {
        id:idEmpresa,
        estado:estadoInterno
      }
      let res = await this.$store.dispatch('admin/CAMBIAR_ESTADO_INTERNO', data);
      let app = this;
      if (res.ok) {
        this.mostrarBtnCambioEstado = false;
        app.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'El estado ha sido actualizado.',
          position:'top'
        });
      } else {
         app.$q.notify({
          color: 'negative',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Error al actualizar estado',                
          position:'top'
        });
      }
    },
    filtrar() {
      let obj = {
        pagina: this.pagina,
        numlist: this.numlist,
        buscar: this.search,
        campo: 'e.nombreempresa',
        filtros: {
          municipioFiltro: this.municipioFiltro,
          nivelCumplimientoFiltro: this.nivelCumplimientoFiltro,
          categoriasFiltro: this.categoriasFiltro,
          estadosFiltro: this.estadosFiltro,
        }
      }
      this.$store.dispatch('admin/BUSCAR_EMPRESAS',obj);
    },
    buscar(){
      let obj = {
        buscar: this.search,
        campo: 'e.nombreempresa',
        filtros: {
          municipioFiltro: this.municipioFiltro,
          nivelCumplimientoFiltro: this.nivelCumplimientoFiltro,
          categoriasFiltro: this.categoriasFiltro,
          estadosFiltro: this.estadosFiltro,
        }
      }
      this.$store.dispatch('admin/BUSCAR_EMPRESAS',obj);
    },
    backPage(n){
      let actual = this.$store.state.admin.empresas.data.pagina+1
      if(actual!=1){
        let obj = {
          pagina: this.$store.state.admin.empresas.data.pagina+n,
          numlist: this.$store.state.admin.empresas.data.numList,
          filtros: {
            municipioFiltro: this.municipioFiltro,
            nivelCumplimientoFiltro: this.nivelCumplimientoFiltro,
            categoriasFiltro: this.categoriasFiltro,
            estadosFiltro: this.estadosFiltro,
          }
        }
        this.$store.dispatch('admin/CARGAR_EMPRESAS',obj);
      }
    },
    nextPage(n){
      let actual = this.$store.state.admin.empresas.data.pagina+1
      let total = this.$store.state.admin.empresas.data.total
      if(actual!=total){
        let obj = {
          pagina: this.$store.state.admin.empresas.data.pagina+n,
          numlist: this.$store.state.admin.empresas.data.numList,
          filtros: {
            municipioFiltro: this.municipioFiltro,
            nivelCumplimientoFiltro: this.nivelCumplimientoFiltro,
            categoriasFiltro: this.categoriasFiltro,
            estadosFiltro: this.estadosFiltro,
          }
        }
        this.$store.dispatch('admin/CARGAR_EMPRESAS',obj);
      }
    },
    updatevalues(campo,value,idempresa){
        let formu = {
            [campo]:value,
            idempresa:idempresa
        }
          let obj = {
            formulario: formu,
            productos: null,
            documentos: null,
            imagenlogo: null
        }

        // console.log(obj);
        // return;
        let app = this;
        return new Promise((resolve) => {
            app.$store.dispatch('formulario/GUARDAR_FORMULARIO',obj).then(function(resp) {
                if (!resp.ok) {             
                app.$q.notify({
                    color: 'negative',
                    textColor: 'white',
                    icon: 'cloud_done',
                    message: 'Error ',                
                    position:'center'
                })
                }else{
                // console.log(submitResult);
                    app.$q.notify({
                    color: 'green-4',
                    textColor: 'white',
                    icon: 'cloud_done',
                    message: 'Formulario Enviado',
                    position:'center'
                    })
                }
                app.$store.commit('formulario/CARGANDO',false);
                resolve(resp)
            })
        })
    },
    onToggleChange(value,evt){
      let data= {
        idempresa:evt.path[0].parentElement.firstChild.name!=null?evt.path[0].parentElement.firstChild.name:evt.path[1].parentElement.firstChild.name,
        activo:value
      }

      let app=this;
      this.$store.dispatch('admin/CAMBIAR_ESTADO_EMPRESA',data).then(function(resp) {
        if (!resp.ok) {             
          app.$q.notify({
            color: 'negative',
            textColor: 'white',
            icon: 'cloud_done',
            message: 'Error ',                
            position:'center'
          })
        }else{
          app.$q.notify({
            color: 'green-4',
            textColor: 'white',
            icon: 'cloud_done',
            message: 'Enviado',
            position:'center'
          })
        }
        app.$store.commit('admin/CARGANDO',false)
      })

    },
    toggleChange(value,evt){

    },
    openFormulario (empresa){
      this.$router.push({name: 'formulario', params: {prop:empresa}});
    },
    openModalImg(idempresa){
      this.$router.push({name: 'imgcarrusel', params: {idempresa:idempresa.idempresa,imgCarrusel:idempresa.imgcarrusel}});
    },
    openModalAdjunto(doc){
      if (doc.length >1) {        
        anexofile.forEach((element,key) => {
          anexofile[key].urlActual = null;
        });

        doc.forEach(element => {
          var indexaa =  anexofile.map(function(item) { return item.name; }).indexOf(element.ref);
          if (indexaa>=0) {          
            anexofile[indexaa].urlActual = element.urldocumento;
          }
        });

        this.$refs.modalAdjunto.documentos=anexofile
        this.$refs.modalAdjunto.dialog=true

      }
    },
    openPerfil (idEmpresa,empresa){
      this.$router.push({name: 'perfiladmin', params: {idEmpresa:idEmpresa,propperfil:empresa}});
    }
  }
}
const anexofile = [
  {
    name:'fFichaInscripcion',
    label:'Formato - Ficha de inscripción',
    doc:'ficha_inscripcion_nv_v2020.xlsx',
    icon: 'xlsx',
    urlActual:null
  },
  {
    name:'aListadoAsociados',
    label:'Anexo - Listado de asociados',
    doc:'anexo-listado_asociados.xlsx',
    icon: 'xlsx',
    urlActual:null
  },
  {
    name:'aCartaConsentimiento',
    label:'Anexo - Carta de consentimiento',
    doc:'carta_de_consentimiento_informado_v2020.docx',
    icon: 'docx',
    urlActual:null
  },
  {
    name:'aCartaIntencion',
    label:'Anexo - Carta de intención',
    doc:'carta-de-intencion-nodo--aliados.docx',
    icon: 'docx',
    urlActual:null
  },
  {
    name:'cExistenciaRepresentacionLegalVigente',
    label:'Certificado de existencia y representación legal vigente',
    urlActual:null
  },
  {
    name:'cDisponeEmpresa',
    label:'Certificaciones con las que dispone actualmente la empresa',
    urlActual:null
  },
  {
    name:'prActualEmpresa',
    label:'Permisos o registros con los que cuenta actualmente la empresa',
    urlActual:null
  },
  {
    name:'rutFacturacionDian',
    label:'RUT o resolución de facturación DIAN',
    urlActual:null
  },
  {
    name:'listadoAsociadosDiligenciado',
    label:'Listado de asociados diligenciado',
    urlActual:null
  },
  {
    name:'cartaConcentimientoInformadoFirma',
    label:'Carta de consentimiento informado diligenciada y firmada - Anexo 2',
    urlActual:null
  }
];
</script>

<style scoped>
/* .no-results{

} */
</style>