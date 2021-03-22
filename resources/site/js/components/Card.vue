<template>
  <div class="q-pa-md row items-start q-gutter-md">
    <q-card class="my-card" flat bordered>
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
      expanded: false,
      lorem: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
    }
  }
}
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 300px
  height: 550px
.img-def
  width: 90%
</style>
