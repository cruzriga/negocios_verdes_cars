<template>
    <!-- <div class="q-pa-md"> -->            
        <q-card style="width: 735px">
            <q-tabs
                v-model="tab"
                dense
                class="text-grey"
                active-color="primary"
                indicator-color="primary"
                align="justify"
                narrow-indicator
            >
                <q-tab v-for="(img , count) in imgref" v-bind:key="count" :name="img.name" :label="'Imagen '+[count+1]" />

            </q-tabs>

            <q-separator />

            <q-tab-panels v-model="tab" animated >
                <q-tab-panel v-for="(img , count) in imgref" v-bind:key="count" :name="img.name">
                    <!-- <div class="text-h6">Imagen 1</div> -->
                    <q-btn v-on:click="navigate()" outline color="primary" >
                        <q-icon left size="3em" name="arrow_back" />
                        <div>Atras</div>
                    </q-btn>
                    <q-btn v-on:click="upload(tab)" outline color="primary" style="margin:10px">
                        <q-icon left size="3em" name="publish" />
                        <div>Subir Imagen</div>
                    </q-btn>
                    <!-- {{idempresa}} -->
                    <Img :ref="img.name" v-bind:urlImg="img.imgurl" v-bind:moveimg="true" v-bind:width="700" v-bind:height="350"/>
                </q-tab-panel>
            </q-tab-panels>
        </q-card>
    <!-- </div> -->
</template>

<script>
import Img from './../../../site/js/components/EmpresaAvatar'
const imgref = [
  {
    name:'img1Carrusel',
    imgurl:null
  },
  {
    name:'img2Carrusel',
    imgurl:null
  },
  {
    name:'img3Carrusel',
    imgurl:null
  },
  {
    name:'img4Carrusel',
    imgurl:null
  }
];
export default {
  name      : 'PaginaImg',
  components: {Img},
  props     : {
    idempresa  : {
      type: String
      // default: () => {}
    },
    imgCarrusel: null
  },
  data() {
    return {
      imgref         : imgref,
      tab            : 'img1Carrusel',
      dialog         : false,
      maximizedToggle: true,
      url            : null
    }
  },
  created() {
  },
  beforeMount() {
    this.imgref.forEach((element,key) => {
      this.imgref[key].imgurl = null
    });
    if (this.imgCarrusel) {
      this.imgCarrusel.forEach(element => {
        // console.log(element)
        var index = this.imgref.map(function (item) { return item.name; }).indexOf(element.ref);
        this.imgref[index].imgurl = element.urldocumento
      });
    }
  },
  methods: {
    navigate() {
      this.$router.go(-1);
    },
    upload(carrusel) {
      if (!this.$refs[carrusel][0].croppa.hasImage() || this.idempresa == null) {
        this.$q.notify({
                         color    : 'negative',
                         textColor: 'white',
                         icon     : 'cloud_done',
                         message  : 'Error ',
                         position : 'center'
                       })
        return
      }
      let app = this;

      this.$refs[carrusel][0].croppa.generateBlob((blob) => {
        var fd = new FormData()
        fd.append('img', blob, carrusel + ',' + carrusel + '.jpg')
        let obj = {
          idempresa: this.idempresa,
          file     : fd
        }
        // console.log(carrusel,carrusel+'.jpg');
        // return
        return new Promise((resolve) => {
          app.$store.dispatch('formulario/GUARDAR_FILE', obj).then(function (resp) {
            // app.onReset()
            if (!resp.ok) {
              app.$q.notify({
                              color    : 'negative',
                              textColor: 'white',
                              icon     : 'cloud_done',
                              message  : 'Error ',
                              position : 'center'
                            })
            } else {
              // console.log(submitResult);
              app.$q.notify({
                              color    : 'green-4',
                              textColor: 'white',
                              icon     : 'cloud_done',
                              message  : 'Formulario Enviado',
                              position : 'center'
                            })
            }
            app.$store.commit('formulario/CARGANDO', false);

            resolve(resp)
          })
        })
      })
    }
  }
}
</script>

<style scoped>

</style>