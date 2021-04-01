<template>
     <q-dialog
      v-model="dialog"
    >
      <q-card style="width: 350px; max-width: 80vw;">
        <q-card-section>
          <div class="text-h6">Adjuntos</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
            <!-- {{documentos}} -->
            <div class="q-pa-md" style="max-width: 350px">
                <q-list v-for="(item, count) in documentos" v-bind:key="count" bordered >
                    <a v-if="item.urlActual!=null" target="_blank" :href="'../'+item.urlActual" >
                        <q-item clickable v-ripple>
                            <q-item-section avatar>
                                <q-icon size="2rem" :name="'img:media/iconssvg/'+item.urlActual.split('.').pop()+'.svg'"/>
                            </q-item-section>

                            <q-item-section>{{item.label}}</q-item-section>
                        </q-item>
                    </a>
                </q-list>
                <!-- <q-list v-for="(item, counta) in documentosa" v-bind:key="counta" bordered>
                    <a v-if="item.urlActual!=null" target="_blank" :href="'../'+item.urlActual" >
                        <q-item clickable v-ripple>
                            <q-item-section avatar>
                                <q-icon size="2rem" :name="'img:media/iconssvg/'+item.urlActual.split('.').pop()+'.svg'"/>
                            </q-item-section>

                            <q-item-section>{{item.label}}</q-item-section>
                        </q-item>
                    </a>
                </q-list> -->
            </div>
        </q-card-section>

        <q-card-actions align="right" class="bg-white text-teal">
          <q-btn flat label="OK" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
</template>

<script>

export default {
    name: 'ModalAdjunto',
    data() {
        return {
            dialog: false,
            documentos:null,
            // documentosa:null,
            maximizedToggle: true
        }
    },
    created(){
        // documentos.forEach(element => {
        //     // var index =  file.map(function(item) { return item.ref; }).indexOf(element.$attrs.name);
        //     console.log(element)
        // });
    }
}
</script>

<style scoped>

</style>