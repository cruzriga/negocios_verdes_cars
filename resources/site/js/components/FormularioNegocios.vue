<template>
    <div class="q-pa-md" >
        <masonry :cols="{default: 2, 1000: 2, 700: 1}" :gutter="10">
        <q-card class="my-card q-ma-md">
          <q-card-section>
              <div class="text-h6">Informacion Empresa</div>
              <!-- <div class="text-subtitle2">by John Doe</div> -->
          </q-card-section>
          <q-separator />
          <q-card-section>     
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Nombre</div>
              </div> -->
              <div class="col-12 col-md-9">
                  <q-input v-model="formulario.nombreempresa.data" label="Nombre De la Empresa" type="text" counter maxlength="200" :rules="formulario.nombreempresa.rules">
                  </q-input>
                  <!-- <q-input v-model="formulario.nombre.data" label="Nombre" counter maxlength="180" :dense="dense">
                  </q-input> -->
              </div>
            </div>                
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Descripcion</div>
              </div> -->
              <div class="col-12 col-md-9">
                  <q-input v-model="formulario.representantelegal.data" label="Representante Legal" type="text" counter maxlength="200" :rules="formulario.representantelegal.rules">
                  </q-input>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Descripcion</div>
              </div> -->
              <div class="col-12 col-md-9">
                  <q-input v-model="formulario.descripcion.data" label="Descripcion" type="textarea" counter maxlength="200" :rules="formulario.descripcion.rules">
                  </q-input>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Telefono</div>
              </div> -->
              <div class="col-12 col-md-9">
                  <q-input v-model="formulario.telefono.data" label="Telefono" counter maxlength="12" :dense="dense" :rules="formulario.telefono.rules">
                  <template v-slot:prepend>
                      <q-icon name="call" />
                  </template>
                  </q-input>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Direccion</div>
              </div> -->
              <div class="col-12 col-md-9">
                  <q-input v-model="formulario.direccion.data" label="Direccion" type="text" counter maxlength="12" :dense="dense" :rules="formulario.direccion.rules">
                  <template v-slot:prepend>
                      <q-icon class="location_on" />
                  </template>
                  </q-input>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Descripcion</div>
              </div> -->
              <div class="col-12 col-md-9">
                  <q-input v-model="formulario.municipio.data" label="Municipio" type="text" counter maxlength="200" :rules="formulario.municipio.rules">
                  </q-input>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Twitter</div>
              </div> -->
              <div class="col-12 col-md-9">
                  <q-input v-model="formulario.email.data" label="Email" :dense="dense" :rules="formulario.email.rules">
                    <template v-slot:prepend>
                        <!-- <q-icon name="fab fa-twitter-square" /> -->
                        <q-icon name="mail" />
                    </template>
                  </q-input>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Twitter</div>
              </div> -->
              <div class="col-12 col-md-9">
                  <q-input v-model="formulario.twitter.data" label="Twitter" :dense="dense" :rules="formulario.twitter.rules">
                    <template v-slot:prepend>
                        <!-- <q-icon name="fab fa-twitter-square" /> -->
                        <q-icon name="img:./../media/iconssvg/gorjeo.svg" />
                    </template>
                  </q-input>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Facebook</div>
              </div> -->
              <div class="col-12 col-md-9">
                  <q-input v-model="formulario.facebook.data" label="Facebook" :dense="dense" :rules="formulario.facebook.rules">
                  <template v-slot:prepend>
                      <!-- <q-icon name="facebook" /> -->
                      <q-icon name="img:./../media/iconssvg/facebook.svg" />
                  </template>
                  </q-input>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Instragram</div>
              </div> -->
              <div class="col-12 col-md-9">
                  <q-input v-model="formulario.instagram.data" label="Instagram" :dense="dense" :rules="formulario.instagram.rules">
                  <template v-slot:prepend>
                      <!-- <q-icon name="fab fa-instagram" /> -->
                      <q-icon name="img:./../media/iconssvg/instagram.svg" />
                  </template>
                  </q-input>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">YouTube</div>
              </div> -->
              <div class="col-12 col-md-9">
                <q-input v-model="formulario.linkvideo.data" label="Link Video YouTube" :dense="dense" :rules="formulario.twitter.rules">
                <template v-slot:prepend>
                    <!-- <q-icon name="ondemand_video" /> -->
                    <q-icon name="img:./../media/iconssvg/youtube.svg" />
                </template>
                </q-input>
              </div>
            </div>
          </q-card-section>
        </q-card>
        <q-card class="my-card q-ma-md">
          <q-card-section>
            <div class="text-h6">Imagens de la Empresa</div>
            <!-- <div class="text-subtitle2">by John Doe</div> -->
          </q-card-section>
          <q-separator />
          <q-card-section cass="justify-center items-center">
            <div class="column items-center" style="">
                <!-- <div class="col">
                  <div class="text-h6">Logo</div>
                </div> -->
                <div class="col">
                <EmpresaAvatar ref="child"/>
                </div>
                <!-- <div class="col">
                One of three rows
                </div> -->
            </div>
                <!-- <q-icon size="2rem" color="primary" @click="uploadimg" name="fas fa-plus-circle" /> -->
          </q-card-section>
        </q-card>       
        <q-card class="my-card q-ma-md"></q-card>
        <q-card class="my-card q-ma-md">
          <q-card-section>
              <div class="text-h6">Categoria</div>
              <!-- <div class="text-subtitle2">by John Doe</div> -->
          </q-card-section>
          <q-separator />
          <q-card-section>
            <q-select
              :name="formulario.categoria.nombre"
              :label="formulario.categoria.label"
              transition-show="flip-up"
              transition-hide="flip-down"
              v-model="formulario.categoria.data"
              option-label="nombre"
              option-value="idcategoria"
              :options="this.$store.state.categoria.resp.categorias"
              @input="onchange"
              filled
            >
              <template v-if="formulario.categoria.data!=null" v-slot:append>
                <q-icon name="cancel" @click.stop="nullselect" class="cursor-pointer" />
              </template>
            </q-select>
            <q-intersection
              transition-hide="jump-up"
              transition="scale"
              leave="scale"
              >
              <q-select v-if="formulario.categoria.data!=null"
                :name="formulario.subcategoria.nombre"
                :label="formulario.subcategoria.label"
                transition-show="flip-up"
                transition-hide="flip-down"                
                v-model="formulario.subcategoria.data"
                option-label="nombre"
                option-value="idsubcategoria"
                :options="this.$store.state.categoria.resp.subcategorias.filter(post => { return post.idcategoria == formulario.categoria.data.idcategoria})"               
                @input="onchange"
                filled
              >
              <template v-slot:option="scope">
                  <q-item
                    v-bind="scope.itemProps"
                    v-on="scope.itemEvents"
                  >
                    <!-- <q-item-section avatar>
                      <q-icon :name="scope.opt.icon" />
                    </q-item-section> -->
                    <q-item-section>
                      <q-item-label v-html="scope.opt.nombre" />
                      <q-item-label caption>{{ formulario.categoria.data!=null?formulario.categoria.data.nombre:'' }}</q-item-label>
                    </q-item-section>
                  </q-item>
                </template>
              </q-select>
            </q-intersection>
            <q-select v-if="formulario.subcategoria.data!=null && this.$store.state.categoria.resp.tiposubcategorias.filter(post => { return post.idsubcategoria == formulario.subcategoria.data.idsubcategoria}).length>0"
              :name="formulario.tiposubcategoria.nombre"
              :label="formulario.tiposubcategoria.label"
              transition-show="flip-up"
              transition-hide="flip-down"
              v-model="formulario.tiposubcategoria.data"
              option-label="nombre"
              option-value="idtiposubcategoria"
              :options="this.$store.state.categoria.resp.tiposubcategorias.filter(post => { return post.idsubcategoria == formulario.subcategoria.data.idsubcategoria})"
              filled
            >
            <template v-slot:option="scope">
                <q-item
                  v-bind="scope.itemProps"
                  v-on="scope.itemEvents"
                >
                  <!-- <q-item-section avatar>
                    <q-icon :name="scope.opt.icon" />
                  </q-item-section> -->
                  <q-item-section>
                    <q-item-label v-html="scope.opt.nombre" />
                    <q-item-label caption>{{ formulario.categoria.data.nombre+' - '+formulario.subcategoria.data.nombre }}</q-item-label>
                  </q-item-section>
                </q-item>
              </template>
            </q-select>
          <!-- {{this.$store.state.categoria.resp.tiposubcategorias}}
          {{this.$store.state.categoria.resp.tiposubcategorias.filter(post => { return post.idsubcategoria == formulario.subcategoria.data.idsubcategoria})}} -->
          </q-card-section>
        </q-card>        
        <q-card class="my-card q-ma-md">
        </q-card>
        <q-card class="my-card q-ma-md">
            <q-card-section>
                <div class="row justify-center items-center">
                <div class="col-12 col-md-3">
                    <div class="text-h6">Productos</div>
                </div>
                <div class="col-12 col-md-9">
                    <q-icon size="2rem" color="primary" @click="addVisa" name="add" />
                </div>
                </div>
            </q-card-section>
            <q-separator />
            <!-- <div>
                <q-btn @click="addVisa" label="Agregar Producto" color="primary"/>
            </div> -->
            <q-card-section>           
              <!-- <q-separator spaced />    -->
              <q-intersection
                transition-hide="jump-up"
                v-for="(applicant, counter) in formulario.productos" v-bind:key="counter"
                transition="scale"
                leave="scale"
                >
                 <q-item class="row justify-center items-center">
                  <!-- <q-item-section avatar top>
                    <q-icon name="account_tree" color="black" size="34px" />
                  </q-item-section>

                  <q-item-section top class="col-2 gt-sm">
                    <q-item-label class="q-mt-sm">GitHub</q-item-label>
                  </q-item-section> -->

                  <q-item-section top>
                    <q-item-label lines="1">
                      <q-input v-model="applicant.nombre" label="Nombrel del producto" type="text" :rules="[ val => val && val.length > 0 || 'Campo vacio']">
                      </q-input>
                    </q-item-label>
                    <q-item-label lines="1">
                      <q-input v-model="applicant.descripcion" label="Descripcion" type="text" :rules="[ val => val && val.length > 0 || 'Campo vacio']">
                      </q-input>
                    </q-item-label>
                  </q-item-section>

                  <q-item-section top side>
                    <q-icon style="margin: 0px 5px 17px 5px" size="2rem" color="red" @click="deleteVisa(counter)" name="delete" />
                    <!-- <div class="text-grey-8 q-gutter-xs">
                      <q-btn class="gt-xs" size="12px" flat dense round icon="delete" />
                      <q-btn class="gt-xs" size="12px" flat dense round icon="done" />
                      <q-btn size="12px" flat dense round icon="more_vert" />
                    </div> -->
                  </q-item-section>
                </q-item>      
                <q-separator spaced />      
              </q-intersection>
            </q-card-section>
        </q-card>
        <q-card class="my-card q-ma-md">
        </q-card>
        <q-card class="my-card q-ma-md">
          <q-card-section>
              <div class="text-h6">Descargar Formularios</div>
              <!-- <div class="text-subtitle2">by John Doe</div> -->
          </q-card-section>
          <q-separator />
          <q-card-section>
              <div class="row justify-center items-center">
              <div class="col-12 col-md-2">
                  <q-icon color="primary" size="2rem" name="attach_file" />
              </div>
              <div class="col-12 col-md-10">
                  <div class="text-subtitle2">Formulario 1</div>
              </div>
              </div>
              <div class="row justify-center items-center">
              <div class="col-12 col-md-2">
                  <q-icon color="primary" size="2rem" name="attach_file" />
              </div>
              <div class="col-12 col-md-10">
                  <div class="text-subtitle2">Formulario 2</div>
              </div>
              </div>
              <div class="row justify-center items-center">
              <div class="col-12 col-md-2">
                  <q-icon color="primary" size="2rem" name="attach_file" />
              </div>
              <div class="col-12 col-md-10">
                  <div class="text-subtitle2">Formulario 3</div>
              </div>
              </div>
          </q-card-section>
        </q-card>
        
        </masonry>
    </div>
</template>

<script>

import EmpresaAvatar from './EmpresaAvatar'
// import { mapState } from 'vuex'

export default {
  name: 'FormularioNegocios',
  components: { EmpresaAvatar},
  props: {
    propformulario: {
      type: Object,
      default: () => {}
    }
  },
  // computed: {
  //   ...mapState({
  //     categoria: state => state.categoria,
  //   })
  // },
  beforeMount() {
    this.AXIO_GET_CATEGORIAS()
    // this.verificarProps();
    // this.agregarCategorias();
  },
  data () {
    return {
      selected: [],
      ticked: [],
      expanded: [],
      filter: null,
      step: 1,
      url: 'https://78.media.tumblr.com/tumblr_m39nv7PcCU1r326q7o1_500.png',
      lorem: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
      formulario: {       
        nombreempresa: {
          nombre: 'nombreempresa',
          type: 'text',
          data: null,
          label: 'Nombre de la empresa',
          rules: [ val => val && val.length > 0 || 'Campo vacio']
        },
        representantelegal: {
          nombre: 'representantelegal',
          type: 'text',
          data: null,
          label: 'Representante legal',
          rules: [ val => val && val.length > 0 || 'Campo vacio']
        },
        descripcion: {
          nombre: 'descripcion',
          type: 'text',
          data: null,
          label: 'Descripción',
          rules: [ val => val && val.length > 0 || 'Campo vacio']
        },
        telefono: {
          nombre: 'telefono',
          type: 'tel',
          data: null,
          label: 'Telefono',
          rules: [ val => val && val.length > 0 || 'Campo vacio']
        },
        direccion: {
          nombre: 'direccion',
          type: 'text',
          data: null,
          label: 'Dirección',
          rules: [ val => val && val.length > 0 || 'Campo vacio']
        },
        municipio: {
          nombre: 'municipio',
          type: 'text',
          data: null,
          label: 'Municipio',
          rules: [ val => val && val.length > 0 || 'Campo vacio']
        },
        email: {
          nombre: 'email',
          type: 'email',
          data: null,
          label: 'Email',
          rules: [v => !v || /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail debe ser valido']
        },
        twitter: {
          nombre: 'twitter',
          type: 'text',
          data: null,
          label: 'Twitter',
          rules: [ val => val && val.length > 0 || 'Campo vacio']
        },
        facebook: {
          nombre: 'facebook',
          type: 'text',
          data: null,
          label: 'Facebook',
          rules: [ val => val && val.length > 0 || 'Campo vacio']
        },
        instagram: {
          nombre: 'instagram',
          type: 'text',
          data: null,
          label: 'Instagram',
          rules: [ val => val && val.length > 0 || 'Campo vacio']
        },
        linkvideo: {
          nombre: 'linkvideo',
          type: 'text',
          data: null,
          label: 'Link Video YouTube',
          rules: [ val => val && val.length > 0 || 'Campo vacio']
        },
        imagenlogo: {
          nombre: 'imagenlogo',
          type: 'file',
          data: null,
          label: 'Imagen logo',
          rules: [ val => val && val.length > 0 || 'Campo vacio'],
          style: 'max-width: 770px',
          formatos: '.png, .jpg, image/*'
        },
        categoria: {
          nombre: 'categoria',
          type: null,
          data: null,
          label: 'Categoria'
        },
        subcategoria: {
          nombre: 'subcategoria',
          type: null,
          data: null,
          label: 'Sub Categoria'
        },
        tiposubcategoria: {
          nombre: 'tipesubcategoria',
          type: null,
          data: null,
          label: 'Tipo Sub Categoria'
        },
        productos: [
          {
            nombre: '',
            descripcion: '',
            tipo: ''
          }
        ]
      },
      submitResult: null,
      dense: false,
      propstree: [],
      tickStrategy: 'leaf-filtered'
    }
  },
  methods: {
    AXIO_GET_CATEGORIAS() {
      this.$store.dispatch('CARGAR_CATEGORIA');
    },
    onchange(value){
      if(value.idsubcategoria!=null){
        this.formulario.tiposubcategoria.data = null
      }
      if(value.idcategoria!=null&&value.idsubcategoria==null){
        this.formulario.tiposubcategoria.data = null
        this.formulario.subcategoria.data = null
      }
    },
    nullselect () {
      this.formulario.categoria.data = null
      this.formulario.subcategoria.data = null
      this.formulario.tiposubcategoria.data = null
    },
    resetFilter () {
      this.filter = ''
      this.$refs.filter.focus()
    },
    myFilterMethod (node, filter) {
      const filt = filter.toLowerCase()
      return node.label && node.label.toLowerCase().indexOf(filt) > -1
    },
    onclick(node) {
      console.log(node)
    },
    onLazyLoad ({ node, key, done, fail }) {
    //  var params = { parentId: node.id, userId: this.UserInfo.userId, type: 1 }
     console.log(node)
   },
    agregarCategorias() {
      this.categoria.forEach((value, key) => {
        var filtrosubcategoria = this.subcategoria.filter(subcategoria => subcategoria.idcategoria === value.value)
        var addtree = []
        filtrosubcategoria.forEach((valuesub, key) => {
          var filtrotiposubcategoria = this.tiposubcategoria.filter(tiposubcategoria => tiposubcategoria.idsubcategoria === valuesub.value && tiposubcategoria.idcategoria === value.value)
          addtree.push({
              label: valuesub.label,
              value: valuesub.value,
              handler: (node) => this.onclick(node),
              idcategoria: valuesub.idcategoria,
              children: filtrotiposubcategoria
            })
        })
        this.propstree.push({
          label: value.label,
          value: value.value,
          handler: (node) => this.onclick(node),
          children: addtree
        })
      })
    },
    verificarProps() {
      if (this.propformulario != null) {
        // Object.entries(this.formulario).forEach(([key, value]) => {
        //     console.log(key + ' ' + value); // "a 5", "b 7", "c 9"
        // })
        Object.entries(this.propformulario).forEach(([key, value]) => {
            // console.log(key + ' ' + value) // "a 5", "b 7", "c 9"
            this.formulario[key].data = value
        })
      }
    },
    uploadimg () {
      console.log(this.$refs.child.croppa.hasImage())
      console.log(this.$refs.child.croppa)
    },
    addVisa () {
      this.formulario.productos.push({
        nombre: '',
        descripcion: '',
        tipo: ''
      })
    },
    deleteVisa (counter) {
      this.formulario.productos.splice(counter, 1);
    },
    onSubmit (evt) {
      console.log('@submit - do something here', evt)
      evt.target.submit()
      if (this.accept !== true) {
        this.$q.notify({
          color: 'red-5',
          textColor: 'white',
          icon: 'warning',
          message: 'You need to accept the license and terms first'
        })
      } else {
        this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Submitted'
        })
        const formData = new FormData(evt.target)
        const submitResult = []

        for (const [name, value] of formData.entries()) {
          submitResult.push({
            name,
            value
          })
        }
        console.log(submitResult)
        this.submitResult = submitResult
      }
    },
    onReset () {
      // this.name = null
      // this.age = null
      // this.accept = false
      // this.$refs.name.resetValidation()
      // this.$refs.age.resetValidation()
    }
  }
}
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  .text-subtitle2
    margin: 0px 0px 15px 5px
  .text-h6
    font-size: 1.25rem !important
    font-weight: bold !important
    line-height: 2rem !important
    letter-spacing: 0.0125em !important
.row > div
  padding: 5px 10px
  height: 100%
.row + .row
  margin-top: 1rem
</style>
