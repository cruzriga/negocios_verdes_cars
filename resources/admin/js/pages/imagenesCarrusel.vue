<template>
    <!-- <div class="q-pa-md"> -->
            <q-card>
                <q-tabs
                    v-model="tab"
                    dense
                    class="text-grey"
                    active-color="primary"
                    indicator-color="primary"
                    align="justify"
                    narrow-indicator
                >
                    <q-tab name="img1" label="Imagen 1" />
                    <q-tab name="img2" label="Imagen 2" />
                    <q-tab name="img3" label="Imagen 3" />
                    <q-tab name="img4" label="Imagen 4" />
                </q-tabs>

                <q-separator />

                <q-tab-panels v-model="tab" animated>
                    <q-tab-panel name="img1">
                        <!-- <div class="text-h6">Imagen 1</div> -->
                        <q-btn v-on:click="upload(tab)" outline color="primary" style="margin:10px">
                            <q-icon left size="3em" name="publish" />
                            <div>Subir Imagen</div>
                        </q-btn>
                        <!-- {{idempresa}} -->
                        <Img ref="img1" v-bind:moveimg="true" v-bind:width="700" v-bind:height="350"/>
                    </q-tab-panel>

                    <q-tab-panel name="img2">
                        <!-- <div class="text-h6">Imagen 2</div> -->
                        <q-btn v-on:click="upload(tab)" outline color="primary" style="margin:10px">
                            <q-icon left size="3em" name="publish" />
                            <div>Subir Imagen</div>
                        </q-btn>
                        <Img ref="img2" v-bind:moveimg="true" v-bind:width="700" v-bind:height="350"/>
                    </q-tab-panel>

                    <q-tab-panel name="img3">
                        <!-- <div class="text-h6">Imagen 3</div>                         -->
                        <q-btn v-on:click="upload(tab)" outline color="primary" style="margin:10px">
                            <q-icon left size="3em" name="publish" />
                            <div>Subir Imagen</div>
                        </q-btn>
                        <Img ref="img3" v-bind:moveimg="true" v-bind:width="700" v-bind:height="350"/>
                    </q-tab-panel>
                    
                    <q-tab-panel name="img4">
                        <!-- <div class="text-h6">Imagen 4</div>                         -->
                        <q-btn v-on:click="upload(tab)" outline color="primary" style="margin:10px">
                            <q-icon left size="3em" name="publish" />
                            <div>Subir Imagen</div>
                        </q-btn>
                        <Img ref="img4" v-bind:moveimg="true" v-bind:width="700" v-bind:height="350"/>
                    </q-tab-panel>
                </q-tab-panels>
            </q-card>
    <!-- </div> -->
</template>

<script>
import Img from './../../../site/js/components/EmpresaAvatar'
export default {
    name: 'PaginaImg',
    components:{Img},
    props: {
        idempresa: {
            type: Number
            // default: () => {}
        }
    },
    data() {
        return {
            tab: 'img1',
            dialog: false,
            maximizedToggle: true
        }
    },
    methods: {
    upload(carrusel) {
        // console.log(this.$refs[carrusel].croppa)
        // return
        // console.log(carrusel)
      if (!this.croppa.hasImage()) {
        alert('No Imagen')
        return
      }
        let app = this;          
      
      this.$refs[carrusel].croppa.generateBlob((blob) => {
          console.log(blob)
          return
        var fd = new FormData()
        fd.append('img', blob, carrusel+'imgCarrusel,'+carrusel+'imgCarrusel.jpg')
        let obj = {
            idempresa: this.idempresa,
            file: fd
        }
        console.log(obj);
        return
        return new Promise((resolve) => {
            app.$store.dispatch('formulario/GUARDAR_FILE',obj).then(function(resp) {
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
                app.$router.go(-1);
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