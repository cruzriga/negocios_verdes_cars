<template>
  <div class="q-pa-md row items-start q-gutter-md">
    <q-card class="my-card" flat bordered @click="openPerfil(prop.idempresa,prop)">
      <div v-if="prop.imagenlogo != null">
        <div v-if="prop.imagenlogo != ''">
          <q-img
            class="rounded-borders"
            :src="prop.imagenlogo"
            style="max-width: 300px; height: 300px;"
          />
        </div>
        <div v-else>
          <q-card-section horizontal class="flex flex-center">
            <q-img class="img-def"
              src="../assets/imagenes/def.png"
              style="max-width: 300px; height: 300px;"
              contain
            />
          </q-card-section>
        </div>
      </div>
      <div v-else>
        <q-card-section class="flex flex-center">
          <q-img class="img-def"
            src="../assets/imagenes/def.png"
            style="max-width: 300px; height: 300px;"
            contain 
          />
        </q-card-section>
      </div>
      <q-card-section>
        <div class="text-green-10">{{prop.categoria.nombre}}</div>
        <div class="text-green-7">{{prop.subcategoria.nombre}}</div>
        <div class="text-green-5">{{prop.tiposubcategoria.nombre}}</div>
        <div class="text-h5 q-mt-sm q-mb-xs">{{prop.nombreempresa}}</div>
        <div class="text-caption text-grey">
          {{prop.descripcion.substring(0,100)+"..."}}
        </div>
      </q-card-section>
      <q-card-section style="padding-top: 0;">
        <div class="row" style="padding-left: 16px;">
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
        </div>
      </q-card-section>
      <!-- <q-slide-transition>
        <div v-show="expanded">
          <q-separator />
          <q-card-section class="text-subitle2">
            {{ lorem }}
          </q-card-section>
        </div>
      </q-slide-transition> -->
    </q-card>
  </div>
</template>

<script>
export default {
  name: 'Card',
  props: {
    prop: {
      type: Object
    }
  },
  data () {
    return {
      adic: 60,
      cump : 80,
      expanded: false,
      lorem: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
    }
  },
  methods:{    
    openPerfil (idEmpresa,empresa){
      this.$router.push({name: 'perfil', params: {idEmpresa:idEmpresa,propperfil:empresa}});
    }
  }
}
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 300px
  height: 640px
.img-def
  width: 90%
</style>
