<template>
    <q-dialog v-model="dialog">
      <q-card>
        <q-card-section>
          <div class="text-h6">Terms of Agreement</div>
        </q-card-section>

        <q-separator />

        <q-card-section style="max-height: 50vh" class="scroll">
            <div class="q-pa-md">

                <div class="row">
                    <div class="col-12 col-md"><Img ref="img1" v-bind:moveimg="true" v-bind:width="600" v-bind:height="350"/></div>
                </div>
                <div class="row">                    
                    <div class="col-12 col-md"><Img ref="img2" v-bind:moveimg="true" v-bind:width="600" v-bind:height="350"/></div>
                </div>
                <div class="row">                    
                    <div class="col-12 col-md"><Img ref="img3" v-bind:moveimg="true" v-bind:width="600" v-bind:height="350"/></div>
                </div>
                <div class="row">                    
                    <div class="col-12 col-md"><Img ref="img4" v-bind:moveimg="true" v-bind:width="600" v-bind:height="350"/></div>
                </div>

            </div>
        </q-card-section>

        <q-separator />

        <q-card-actions align="right">
          <q-btn flat label="Decline" color="primary" v-close-popup />
          <q-btn flat label="Accept" color="primary" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
</template>

<script>
import Img from './../../../site/js/components/EmpresaAvatar'
export default {
    name: 'ModalImg',
    components:{Img},
    data() {
        return {
            dialog: false,
            maximizedToggle: true
        }
    },
}
</script>

<style scoped>

</style>