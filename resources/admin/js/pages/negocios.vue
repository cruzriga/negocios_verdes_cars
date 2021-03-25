<template>
  <q-page >
    <!-- <div> {{this.$store.state.admin.empresas.data[0]}}</div> -->
    <!-- <div v-for="(empresa, count) in this.$store.state.admin.empresas.data" v-bind:key="count">
      <div>{{counter}} : {{applicant}}</div>
    </div>     -->
    <!-- <div class="hello">
        <button @click="openFormulario">F</button>
    </div> -->
    <q-list bordered class="rounded-borders fit"  >
      <q-item-label  header>
        <q-toolbar class="text-primary" style="height: 50px">
          <q-input class="GPL__toolbar-input" dense standout="bg-primary" v-model="search" placeholder="Buscar">
            <template v-slot:prepend>
              <q-icon v-if="search === ''" name="search" />
              <q-icon v-else name="clear" class="cursor-pointer" @click="search = ''" />
            </template>
          </q-input>
          <q-space/>
          <div>
             <span class="q-mr-md"> {{this.$store.state.admin.empresas.data.pagina+1}} - {{this.$store.state.admin.empresas.data.total}} </span> <q-btn @click="nextPage(-1)" flat round dense icon="arrow_back_ios" class=""/> <q-btn @click="nextPage(1)" flat round dense icon="arrow_forward_ios" />
          </div>
        </q-toolbar>
      </q-item-label>
      <template v-if = "items.length > 0">
      <div v-for="(empresa, count) in this.$store.state.admin.empresas.data.empresas" v-bind:key="count">
        <!-- {{empresa}} -->
        <q-separator spaced/>
        <q-item>
          <q-item-section avatar top>
            <div>
              <q-toggle
                false-value="0"
                true-value="1"
                v-model="empresa.activo"
                :key="empresa.idempresa"
                :name="empresa.idempresa"
                :ref="'activo'+empresa.idempresa"
                color="green"
                icon="check"
                @input="onToggleChange"
              />
            </div>

          </q-item-section>

          <q-item-section top>
            <q-item-label lines = "1">
              <span class = "q-mt-xs text-body2 text-weight-bold text-uppercase">{{empresa.nombreempresa}}</span>
            </q-item-label>
            <q-item-label lines="1">  <span class = "text-grey-8"> <q-icon name="date_range"/> 00 / 00 / 0000 00:00 MM</span></q-item-label>
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
            </q-item-label>
            <q-item-label lines = "1" class = "q-mt-xs text-body2 text-weight-bold text-uppercase">
              {{empresa.categoria.nombre}} > {{empresa.subcategoria.nombre}} > {{empresa.tiposubcategoria.nombre}}
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

          <!-- <q-item-section side style="align-items: center;">
            <q-item-label lines = "1" >            
                <q-icon  @click="openFormulario(empresa)" name="edit" class="text-primary" style="font-size: 32px;" />
            </q-item-label>
          </q-item-section> -->

          <!-- <q-item-section top side>
            <div class = "text-grey-8 q-gutter-xs">
              <q-btn v-if="false" class = "gt-xs" size = "12px" flat dense round icon = "delete"/>
              <q-btn v-if="false" class = "gt-xs" size = "12px" flat dense round icon = "mode"/>
              <q-btn size = "12px" flat dense round icon = "more_vert"/>
            </div>
          </q-item-section> -->
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
    <ModalImg ref="modalimg"/>
  </q-page>
</template>

<script>
import ModalImg from './../components/Modal'
export default {
  name: 'Negocios',
  components:{ ModalImg },
  data(){
    return {
      debug: false,
      id: 0,
      msg: 'Hey Nic Raboy',
      search:'',
      online: false,
      items : [1],
      adic: 60,
      cump : 80,
      pagina:0,
      numlist: 50,
      labeladic:this.adic,
      labelcump:this.cump
    }
  },
  beforeMount () {
    let obj = {
      pagina: this.pagina,
      numlist: this.numlist
    }
    this.$store.dispatch('admin/CARGAR_EMPRESAS',obj);
  },
  methods: {
    nextPage(n){
      let obj = {
        pagina: this.$store.state.admin.empresas.data.pagina+n,
        numlist: this.$store.state.admin.empresas.data.numList
      }
      this.$store.dispatch('admin/CARGAR_EMPRESAS',obj);
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
      // console.log(value)
      // console.log(evt)
      // console.log(evt.path[0].parentElement.firstChild.name) 
      // console.log(evt.path.find(element => element > 'div.q-toggle__thumb.absolute.flex.flex-center.no-wrap'));
      // evt.path.forEach((element,key) => {
      //   console.log(element)
      //   console.log(key)
      // });
      // var removeIndex = this.documentos.map(function(item) { return item.id; }).indexOf(file[0].lastModified);
      // console.log(removeIndex)
      let data= {
        idempresa:evt.path[0].parentElement.firstChild.name!=null?evt.path[0].parentElement.firstChild.name:evt.path[1].parentElement.firstChild.name,
        activo:value
      }
      // console.log(data)
      // return
      let app=this;
      this.$store.dispatch('admin/CAMBIAR_ESTADO_EMPRESA',data).then(function(resp) {
        // app.onReset()            
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
      // return new Promise((resolve) => {
      //   resolve(resp)
      // }) 
      // [0].parentElement.firstChild.name
    },
    toggleChange(value,evt){
      // console.log(value)
      // console.log(evt)
    },
    openFormulario (empresa){
      this.$router.push({name: 'formulario', params: {prop:empresa}});
    },
    openModalImg(idempresa){
      this.$router.push({name: 'imgcarrusel', params: {idempresa:idempresa.idempresa,imgCarrusel:idempresa.imgcarrusel}});
      // this.$refs.modalimg.dialog=true
      // console.log(this.$refs.modalimg.dialog);
    }
  }
}
</script>

<style scoped>
/* .no-results{

} */
</style>