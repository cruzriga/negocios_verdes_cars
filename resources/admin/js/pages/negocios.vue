<template>
  <q-page >
    <!-- <div> {{this.$store.state.empresas.resp.data}}</div> -->
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
             <span class="q-mr-md"> 1 - 25 de 100 </span> <q-btn flat round dense icon="arrow_back_ios" class=""/> <q-btn flat round dense icon="arrow_forward_ios" />
          </div>
        </q-toolbar>
      </q-item-label>

      <template v-if = "items.length > 0">
        <template v-for = "n in 20">
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
        </template>
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
  </q-page>
</template>

<script>
export default {
  name: 'Negocios',
  data(){
    return {
      search:'',
      online: false,
      items : [1],
      adic: 60,
      cump : 80,
    }
  },
  beforeMount () {
    this.$store.dispatch('CARGAR_EMPRESAS');
  },
  methods: {
  }
}
</script>

<style scoped>
    .no-results{

    }
</style>