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
              <span class = "text-grey-8"> <q-icon name="date_range"/> 00 / 00 / 0000 00:00 MM</span>
            </q-item-label>
            <q-item-label caption lines = "1">
              {{empresa.descripcion}}             
            </q-item-label>
            <q-item-label caption lines = "1" class="row">
              <div><q-icon name="face" /> {{empresa.representantelegal}} </div> <div>| <q-icon name="gps_fixed" /> {{empresa.municipio}}</div> <div>| <q-icon name="phone" /> {{empresa.telefono}}</div>   <div>| <q-icon name="mail" /> {{empresa.email}}</div>
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
                  v-model="cump"
                  show-value
                  size="50px"
                  color="teal"
                  track-color="grey-3"
                  readonly

              />
            </q-item-label>
          </q-item-section>

          <q-item-section side style="align-items: center;" top>
            <q-item-label lines = "1" >
              <span class = "q-mt-xs text-weight-bold ">Adic</span>
            </q-item-label >
            <q-item-label lines = "1" >
              <q-knob
                  v-model="adic"
                  show-value
                  size="50px"
                  color="teal"
                  track-color="grey-3"
                  readonly
              />
            </q-item-label>
          </q-item-section>

          <q-item-section side style="align-items: center;" top>
            <q-item-label lines = "1" >
              <span class = "q-mt-xs text-weight-bold ">Interpretación</span>
            </q-item-label >
            <q-item-label lines = "1" >
              <q-chip class = "text-uppercase">
                AVANZADO
              </q-chip>
            </q-item-label>
          </q-item-section>

          <q-item-section side style="align-items: center;">
            <q-item-label lines = "1" >            
                <q-icon  @click="openFormulario(empresa)" name="edit" class="text-primary" style="font-size: 32px;" />
            </q-item-label>
          </q-item-section>

          <q-item-section top side>
            <div class = "text-grey-8 q-gutter-xs">
              <q-btn v-if="false" class = "gt-xs" size = "12px" flat dense round icon = "delete"/>
              <q-btn v-if="false" class = "gt-xs" size = "12px" flat dense round icon = "mode"/>
              <q-btn size = "12px" flat dense round icon = "more_vert"/>
            </div>
          </q-item-section>
        </q-item>
      </div>
        <!-- <template v-for = "n in 20">
          <q-separator spaced/>
          <q-item>
            <q-item-section avatar top>
              <div>
                <q-toggle
                    v-model="online"
                    color="green"
                    icon="check"
                />
              </div>

            </q-item-section>

            <q-item-section top>
              <q-item-label lines = "1">
                <span class = "q-mt-xs text-body2 text-weight-bold text-uppercase">Nombre de negocio verde</span>
                <span class = "text-grey-8"> <q-icon name="date_range"/> 00 / 00 / 0000 00:00 MM</span>
              </q-item-label>
              <q-item-label caption lines = "1">
                orem ipsum dolor sit amet consectetur adipiscing elit maecenas ante, odio sem erat neque congue tempor felis pulvinar conubia est, varius tortor posuere purus urna dictum in fames. Aenean sagittis senectus donec consequat etiam, mauris phasellus fermentum neque pellentesque commodo, aptent sociosqu vulputate laoreet. Fringilla eleifend a convallis pulvinar sociis semper, fames at himenaeos facilisi risus malesuada senectus, sociosqu magna nullam aliquam euismod.
              </q-item-label>
              <q-item-label caption lines = "1" class="row">
                <div><q-icon name="face" /> Representante Legal </div> <div>| <q-icon name="gps_fixed" /> Municipio</div> <div>| <q-icon name="phone" /> 939393</div>   <div>| <q-icon name="mail" /> examplee@emial</div>
              </q-item-label>
              <q-item-label lines = "1" class = "q-mt-xs text-body2 text-weight-bold text-uppercase">
                Categoria > Sub categoria > tipo
              </q-item-label>
            </q-item-section>
            <q-item-section side style="align-items: center;" top>
              <q-item-label lines = "1" >
                <span class = "q-mt-xs text-weight-bold ">Cump</span>
              </q-item-label >
              <q-item-label lines = "1" >
                <q-knob
                    v-model="cump"
                    show-value
                    size="50px"
                    color="teal"
                    track-color="grey-3"
                    readonly

                />
              </q-item-label>
            </q-item-section>

            <q-item-section side style="align-items: center;" top>
              <q-item-label lines = "1" >
                <span class = "q-mt-xs text-weight-bold ">Adic</span>
              </q-item-label >
              <q-item-label lines = "1" >
                <q-knob
                    v-model="adic"
                    show-value
                    size="50px"
                    color="teal"
                    track-color="grey-3"
                    readonly
                />
              </q-item-label>
            </q-item-section>

            <q-item-section side style="align-items: center;" top>
              <q-item-label lines = "1" >
                <span class = "q-mt-xs text-weight-bold ">Interpretación</span>
              </q-item-label >
              <q-item-label lines = "1" >
                <q-chip class = "text-uppercase">
                  AVANZADO
                </q-chip>
              </q-item-label>
            </q-item-section>

            <q-item-section top side>
              <div class = "text-grey-8 q-gutter-xs">
                <q-btn v-if="false" class = "gt-xs" size = "12px" flat dense round icon = "delete"/>
                <q-btn v-if="false" class = "gt-xs" size = "12px" flat dense round icon = "mode"/>
                <q-btn size = "12px" flat dense round icon = "more_vert"/>
              </div>
            </q-item-section>
          </q-item>
        </template> -->
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
  </q-page>
</template>

<script>
export default {
  name: 'Negocios',
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
      numlist: 15
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
    }
  }
}
</script>

<style scoped>
/* .no-results{

} */
</style>