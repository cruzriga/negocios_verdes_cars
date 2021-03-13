<template>
    <div class="q-pa-md" style="width: 1000px">
        <masonry :cols="{default: 2, 1000: 2, 700: 1}" :gutter="10">
        <q-card class="my-card q-ma-md">
            <q-card-section>
            <div class="text-h6">Imagens de la Empresa</div>
            <!-- <div class="text-subtitle2">by John Doe</div> -->
            </q-card-section>
            <q-separator />
            <q-card-section cass="justify-center items-center">
            <div class="column items-center" style="">
                <div class="col">
                <div class="text-h6">Logo</div>
                </div>
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
        <q-card class="my-card q-ma-md">
            <q-card-section>
                <div class="text-h6">Informacion Empresa</div>
                <!-- <div class="text-subtitle2">by John Doe</div> -->
            </q-card-section>
            <q-separator />
            <q-card-section>
                <div class="row justify-center items-center">
                <div class="col-12 col-md-3">
                    <div class="text-subtitle2">Nombre</div>
                </div>
                <div class="col-12 col-md-9">
                    <q-input filled bottom-slots v-model="formulario.nombre.data" label="Nombre" counter maxlength="180" :dense="dense">
                    </q-input>
                </div>
                </div>
                <div class="row justify-center items-center">
                <div class="col-12 col-md-3">
                    <div class="text-subtitle2">Descripcion</div>
                </div>
                <div class="col-12 col-md-9">
                    <q-input filled bottom-slots v-model="formulario.descripcion.data" type="textarea" label="Descripcion" counter maxlength="200" :dense="dense">
                    </q-input>
                </div>
                </div>
                <div class="row justify-center items-center">
                <div class="col-12 col-md-3">
                    <div class="text-subtitle2">Telefono</div>
                </div>
                <div class="col-12 col-md-9">
                    <q-input filled bottom-slots v-model="formulario.descripcion.data" label="Telefono" counter maxlength="12" :dense="dense">
                    <template v-slot:before>
                        <q-icon name="fas fa-phone" />
                    </template>
                    </q-input>
                </div>
                </div>
                <div class="row justify-center items-center">
                <div class="col-12 col-md-3">
                    <div class="text-subtitle2">Direccion</div>
                </div>
                <div class="col-12 col-md-9">
                    <q-input filled bottom-slots v-model="formulario.descripcion.data" label="Direccion" counter maxlength="12" :dense="dense">
                    <template v-slot:before>
                        <q-icon name="fas fa-location-arrow" />
                    </template>
                    </q-input>
                </div>
                </div>
            </q-card-section>
            </q-card>
        <q-card class="my-card q-ma-md">
            <q-card-section>
                <div class="text-h6">Redes Socuales</div>
                <!-- <div class="text-subtitle2">by John Doe</div> -->
            </q-card-section>
            <q-separator />
            <q-card-section>
                <div class="row justify-center items-center">
                <div class="col-12 col-md-3">
                    <div class="text-subtitle2">Twitter</div>
                </div>
                <div class="col-12 col-md-9">
                    <q-input filled bottom-slots v-model="formulario.twitter" label="Twitter" :dense="dense">
                    <template v-slot:before>
                        <q-icon name="fab fa-twitter" />
                    </template>
                    </q-input>
                </div>
                </div>
                <div class="row justify-center items-center">
                <div class="col-12 col-md-3">
                    <div class="text-subtitle2">Facebook</div>
                </div>
                <div class="col-12 col-md-9">
                    <q-input filled bottom-slots v-model="formulario.facebook" label="Facebook" :dense="dense">
                    <template v-slot:before>
                        <q-icon name="fab fa-facebook-square" />
                    </template>
                    </q-input>
                </div>
                </div>
                <div class="row justify-center items-center">
                <div class="col-12 col-md-3">
                    <div class="text-subtitle2">Instragram</div>
                </div>
                <div class="col-12 col-md-9">
                    <q-input filled bottom-slots v-model="formulario.instagram" label="Instagram" :dense="dense">
                    <template v-slot:before>
                        <q-icon name="fab fa-instagram" />
                    </template>
                    </q-input>
                </div>
                </div>
                <div class="row justify-center items-center">
                <div class="col-12 col-md-3">
                    <div class="text-subtitle2">YouTube</div>
                </div>
                <div class="col-12 col-md-9">
                    <q-input filled bottom-slots v-model="formulario.youtube" label="YouTube" :dense="dense">
                    <template v-slot:before>
                        <q-icon name="fab fa-youtube" />
                    </template>
                    </q-input>
                </div>
                </div>
            </q-card-section>
        </q-card>
        <q-card class="my-card q-ma-md">
            <q-card-section>
                <div class="text-h6">Categoria</div>
                <!-- <div class="text-subtitle2">by John Doe</div> -->
            </q-card-section>
            <q-separator />
            <q-card-section>
              <q-input
                ref="filter"
                filled
                v-model="filter"
                label="Search - only filters labels that have also '(*)'"
              >
                <template v-slot:append>
                  <q-icon v-if="filter !== ''" name="clear" class="cursor-pointer" @click="resetFilter" />
                </template>
              </q-input>
                <q-tree
                  :nodes="propstree"
                  node-key="label"
                  :tick-strategy="tickStrategy"
                  :ticked.sync="ticked"
                  :selected.sync="selected"
                  :expanded.sync="expanded"
                  @lazy-load="onLazyLoad"
                  :filter-method="myFilterMethod"
                  :filter="filter"
                  default-expand-all
                />
            </q-card-section>
        </q-card>
        <q-card class="my-card q-ma-md">
            <q-card-section>
                <div class="row justify-center items-center">
                <div class="col-12 col-md-3">
                    <div class="text-h6">Productos</div>
                </div>
                <div class="col-12 col-md-9">
                    <q-icon size="2rem" color="primary" @click="addVisa" name="fas fa-plus-circle" />
                </div>
                </div>
            </q-card-section>
            <q-separator />
            <!-- <div>
                <q-btn @click="addVisa" label="Agregar Producto" color="primary"/>
            </div> -->
            <q-card-section>
                <q-intersection
                transition-hide="jump-up"
                v-for="(applicant, counter) in formulario.productos" v-bind:key="counter"
                transition="scale"
                leave="scale"
                >
                <div transition-show="jump-down" class="row justify-center items-center" >
                <div class="col-12 col-md-2">
                    <!-- <div v-if="counter+1==formulario.productos.length">
                    <q-icon size="2rem" color="primary" @click="addVisa" name="fas fa-plus-circle" />
                    </div>
                    <div v-else>
                    <q-icon size="2rem" color="red" @click="deleteVisa(counter)" name="fas fa-minus-circle" />
                    </div> -->
                    <q-icon style="margin: 0px 5px 17px 5px" size="2rem" color="red" @click="deleteVisa(counter)" name="fas fa-minus-circle" />
                </div>
                <div class="col-12 col-md-5">
                    <q-input class='productos'
                        filled
                        v-model="applicant.nombre"
                        label="Nombre"
                        lazy-rules
                        :rules="[ val => val && val.length > 0 || 'Campo vacio']"
                        />
                </div>
                <div class="col-12 col-md-5">
                    <q-input class='productos'
                        filled
                        v-model="applicant.descripcion"
                        label="Descripcion"
                        lazy-rules
                        :rules="[ val => val && val.length > 0 || 'Campo vacio']"
                        />
                </div>
                </div>
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
                <div class="col-12 col-md-3">
                    <q-icon color="primary" size="2rem" name="fas fa-file-excel" />
                </div>
                <div class="col-12 col-md-9">
                    <div class="text-subtitle2">Formulario 1</div>
                </div>
                </div>
                <div class="row justify-center items-center">
                <div class="col-12 col-md-3">
                    <q-icon color="primary" size="2rem" name="fas fa-file-excel" />
                </div>
                <div class="col-12 col-md-9">
                    <div class="text-subtitle2">Formulario 2</div>
                </div>
                </div>
                <div class="row justify-center items-center">
                <div class="col-12 col-md-3">
                    <q-icon color="primary" size="2rem" name="fas fa-file-excel" />
                </div>
                <div class="col-12 col-md-9">
                    <div class="text-subtitle2">Formulario 3</div>
                </div>
                </div>
            </q-card-section>
        </q-card>
        </masonry>
        <div>{{selected}}</div>
        {{ ticked }}
    </div>
</template>

<script>

import EmpresaAvatar from './EmpresaAvatar'

export default {
  name: 'FormularioNegocios',
  components: { EmpresaAvatar },
  props: {
    propformulario: {
      type: Object,
      default: () => {}
    }
  },
  beforeMount() {
    this.verificarProps();
    this.agregarCategorias();
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
        nombre: {
          nombre: 'nombre',
          type: 'text',
          data: null,
          label: 'Nombre de la Empresa',
          rules: null
        },
        descripcion: {
          nombre: 'descripcion',
          type: 'textarea',
          data: null,
          label: 'Descripcion',
          rules: null
        },
        email: {
          nombre: 'email',
          type: 'email',
          data: null,
          label: 'Email',
          rules: [v => !v || /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail debe ser valido']
        },
        tel: {
          nombre: 'telefono',
          type: 'tel',
          data: null,
          label: 'Telefono',
          rules: null
        },
        linkvideo: {
          nombre: 'linkvideo',
          type: 'text',
          data: null,
          label: 'Link Video',
          rules: null
        },
        imagenlogo: {
          nombre: 'imagenlogo',
          type: 'file',
          data: null,
          label: 'Imagen logo',
          rules: null,
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
      categoriaOptions: [
        {
          label: 'BIENES Y SERVICIOS SOSTENIBLES PROVENIENTES DE LOS RECURSOS NATURALES',
          value: '1',
          description: 'BIENES Y SERVICIOS SOSTENIBLES PROVENIENTES DE LOS RECURSOS NATURALES'
        },
        {
          label: 'ECOPRODUCTOS INDUSTRIALES',
          value: '2',
          description: 'ECOPRODUCTOS INDUSTRIALES'
        },
        {
          label: 'MERCADO DE CARBONO RELACIONADO CON CAMBIO CLIMÁTICO',
          value: '3',
          description: 'MERCADO DE CARBONO RELACIONADO CON CAMBIO CLIMÁTICO'
        }
      ],
      subcategoriaOptions1: [
        {
          idcategoria: '1',
          label: 'NEGOCIOS PARA LA RESTAURACIÓN',
          value: '1',
          description: 'NEGOCIOS PARA LA RESTAURACIÓN'
        },
        {
          idcategoria: '1',
          label: 'AGROSISTEMAS SOSTENIBLES',
          value: '2',
          description: 'AGROSISTEMAS SOSTENIBLES'
        },
        {
          idcategoria: '1',
          label: 'BIOCOMERCIO',
          value: '3',
          description: 'BIOCOMERCIO'
        }
      ],
      subcategoriaOptions2: [
        {
          idcategoria: '2',
          label: 'CONSTRUCCIÓN SOSTENIBLE',
          value: '1',
          description: 'CONSTRUCCIÓN SOSTENIBLE'
        },
        {
          idcategoria: '2',
          label: 'SECTOR: APROVECHAMIENTO Y VALORACIÓN DE RESIDUOS',
          value: '2',
          description: 'SECTOR: APROVECHAMIENTO Y VALORACIÓN DE RESIDUOS'
        },
        {
          idcategoria: '2',
          label: 'FUENTES NO CONVENCIONALES DE ENERGÍA RENOVABLE',
          value: '3',
          description: 'FUENTES NO CONVENCIONALES DE ENERGÍA RENOVABLE'
        },
        {
          idcategoria: '2',
          label: 'OTROS BIENES Y SERVICIOS VERDES SOSTENIBLES',
          value: '4',
          description: 'OTROS BIENES Y SERVICIOS VERDES SOSTENIBLES'
        }
      ],
      subcategoriaOptions3: [
        {
          idcategoria: '3',
          label: 'MERCADO VOLUNTARIO Y SECTOR MERCADO REGULADO',
          value: '1',
          description: 'MERCADO VOLUNTARIO Y SECTOR MERCADO REGULADO'
        }
      ],
      subcategoriaOptions13: [
        {
          idsubcategoria: '1',
          label: 'No Maderables',
          value: '1',
          description: 'No Maderables'
        },
        {
          idsubcategoria: '1',
          label: 'Maderables',
          value: '2',
          description: 'Maderables'
        },
        {
          idsubcategoria: '1',
          label: 'Ecoturismo',
          value: '3',
          description: 'Ecoturismo'
        }
      ],
      subcategoriaOptions23: [
        {
          idsubcategoria: '2',
          label: 'Energía Solar',
          value: '1',
          description: 'Energía Solar'
        },
        {
          idsubcategoria: '2',
          label: 'Eólica',
          value: '2',
          description: 'Eólica'
        },
        {
          idsubcategoria: '2',
          label: 'Geotérmica',
          value: '3',
          description: 'Geotérmica'
        },
        {
          idsubcategoria: '2',
          label: 'Biomasa',
          value: '4',
          description: 'Biomasa'
        },
        {
          idsubcategoria: '2',
          label: 'Mareomotriz',
          value: '5',
          description: 'Mareomotriz'
        },
        {
          idsubcategoria: '2',
          label: 'Pequeñas Centrales Hidroeléctricas',
          value: '6',
          description: 'Pequeñas Centrales Hidroeléctricas'
        }
      ],
      categoria: [
        {
          label: 'BIENES Y SERVICIOS SOSTENIBLES PROVENIENTES DE LOS RECURSOS NATURALES',
          value: '1',
          description: 'BIENES Y SERVICIOS SOSTENIBLES PROVENIENTES DE LOS RECURSOS NATURALES'
        },
        {
          label: 'ECOPRODUCTOS INDUSTRIALES',
          value: '2',
          description: 'ECOPRODUCTOS INDUSTRIALES'
        },
        {
          label: 'MERCADO DE CARBONO RELACIONADO CON CAMBIO CLIMÁTICO',
          value: '3',
          description: 'MERCADO DE CARBONO RELACIONADO CON CAMBIO CLIMÁTICO'
        }
      ],
      subcategoria: [
        {
          idcategoria: '1',
          label: 'NEGOCIOS PARA LA RESTAURACIÓN',
          value: '1',
          description: 'NEGOCIOS PARA LA RESTAURACIÓN'
        },
        {
          idcategoria: '1',
          label: 'AGROSISTEMAS SOSTENIBLES',
          value: '2',
          description: 'AGROSISTEMAS SOSTENIBLES'
        },
        {
          idcategoria: '1',
          label: 'BIOCOMERCIO',
          value: '3',
          description: 'BIOCOMERCIO'
        },
        {
          idcategoria: '2',
          label: 'CONSTRUCCIÓN SOSTENIBLE',
          value: '1',
          description: 'CONSTRUCCIÓN SOSTENIBLE'
        },
        {
          idcategoria: '2',
          label: 'SECTOR: APROVECHAMIENTO Y VALORACIÓN DE RESIDUOS',
          value: '2',
          description: 'SECTOR: APROVECHAMIENTO Y VALORACIÓN DE RESIDUOS'
        },
        {
          idcategoria: '2',
          label: 'FUENTES NO CONVENCIONALES DE ENERGÍA RENOVABLE',
          value: '3',
          description: 'FUENTES NO CONVENCIONALES DE ENERGÍA RENOVABLE'
        },
        {
          idcategoria: '2',
          label: 'OTROS BIENES Y SERVICIOS VERDES SOSTENIBLES',
          value: '4',
          description: 'OTROS BIENES Y SERVICIOS VERDES SOSTENIBLES'
        },
        {
          idcategoria: '3',
          label: 'MERCADO VOLUNTARIO Y SECTOR MERCADO REGULADO',
          value: '1',
          description: 'MERCADO VOLUNTARIO Y SECTOR MERCADO REGULADO'
        }
      ],
      tiposubcategoria: [
        {
          idcategoria: '1',
          idsubcategoria: '3',
          label: 'No Maderables',
          value: '1',
          description: 'No Maderables'
        },
        {
          idcategoria: '1',
          idsubcategoria: '3',
          label: 'Maderables',
          value: '2',
          description: 'Maderables'
        },
        {
          idcategoria: '1',
          idsubcategoria: '3',
          label: 'Ecoturismo',
          value: '3',
          description: 'Ecoturismo'
        },
        {
          idcategoria: '2',
          idsubcategoria: '3',
          label: 'Energía Solar',
          value: '1',
          description: 'Energía Solar'
        },
        {
          idcategoria: '2',
          idsubcategoria: '3',
          label: 'Eólica',
          value: '2',
          description: 'Eólica'
        },
        {
          idcategoria: '2',
          idsubcategoria: '3',
          label: 'Geotérmica',
          value: '3',
          description: 'Geotérmica'
        },
        {
          idcategoria: '2',
          idsubcategoria: '3',
          label: 'Biomasa',
          value: '4',
          description: 'Biomasa'
        },
        {
          idcategoria: '2',
          idsubcategoria: '3',
          label: 'Mareomotriz',
          value: '5',
          description: 'Mareomotriz'
        },
        {
          idcategoria: '2',
          idsubcategoria: '3',
          label: 'Pequeñas Centrales Hidroeléctricas',
          value: '6',
          description: 'Pequeñas Centrales Hidroeléctricas'
        }
      ],
      submitResult: null,
      dense: false,
      propstree: [],
      tickStrategy: 'leaf-filtered'
    }
  },
  methods: {
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
  max-width: 1100px
  .text-subtitle2
    margin: 0px 0px 15px 5px
.row > div
  padding: 5px 10px
  height: 100%
.row + .row
  margin-top: 1rem
</style>
