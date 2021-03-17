<template>
    <div class="q-pa-md" >
      <q-form
        @submit="onSubmit"
        @reset="onReset"
        class="q-gutter-md"
      >
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
                  <q-input v-model="formulario.descripcion.data" label="Descripcion" type="textarea" counter maxlength="500" :rules="formulario.descripcion.rules">
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
                  <div class="text-subtitle2">Descripcion</div>
              </div> -->
              <div class="col-12 col-md-9">
                  <!-- <q-input v-model="formulario.municipio.data" label="Municipio" type="text" counter maxlength="200" :rules="formulario.municipio.rules">
                  </q-input> -->
                   <!-- <q-select
                      v-model="formulario.municipio.data"
                      :options="optionsmunicipios"
                      :name="formulario.municipio.nombre"
                      :label="formulario.municipio.label"
                      color="primary"
                      clearable
                    > -->
                    <q-select                      
                      v-model="formulario.municipio.data"
                      :name="formulario.municipio.nombre"
                      :label="formulario.municipio.label"
                      :options="options"
                      emit-value
                      clearable
                    >
                    <template v-slot:no-option>
                      <q-item>
                        <q-item-section class="text-grey">
                          Sin Resultados
                        </q-item-section>
                      </q-item>
                    </template>
                    <template v-slot:option="scope">
                      <q-item
                        v-bind="scope.itemProps"
                        v-on="scope.itemEvents"
                      >
                        <q-item-section avatar>
                          <q-icon :name="scope.opt.icon" />
                        </q-item-section>
                        <q-item-section>
                          <q-item-label v-html="scope.opt.label" />
                          <!-- <q-item-label caption>{{ scope.opt.description }}</q-item-label> -->
                        </q-item-section>
                      </q-item>
                    </template>
                  </q-select>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Direccion</div>
              </div> -->
              <div class="col-12 col-md-9">
                  <q-input v-model="formulario.direccion.data" label="Direccion" type="text" counter maxlength="200" :dense="dense" :rules="formulario.direccion.rules">
                  <!-- <template v-slot:prepend>
                      <q-icon class="room" />
                  </template> -->
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
                  <EmpresaAvatar ref="child" v-bind:urlImg="formulario.imagenlogo.data"/>
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
              :options="this.$store.state.formulario.categoria.resp!=null?this.$store.state.formulario.categoria.resp.categorias:[]"
              @input="onchange"
              filled
              :rules="formulario.categoria.rules"
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
                :options="this.$store.state.formulario.categoria.resp!=null?this.$store.state.formulario.categoria.resp.subcategorias.filter(post => { return post.idcategoria == formulario.categoria.data.idcategoria}):[]"               
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
            <q-select v-if="formulario.subcategoria.data!=null && this.$store.state.formulario.categoria.resp.tiposubcategorias.filter(post => { return post.idsubcategoria == formulario.subcategoria.data.idsubcategoria}).length>0"
              :name="formulario.tiposubcategoria.nombre"
              :label="formulario.tiposubcategoria.label"
              transition-show="flip-up"
              transition-hide="flip-down"
              v-model="formulario.tiposubcategoria.data"
              option-label="nombre"
              option-value="idtiposubcategoria"
              :options="this.$store.state.formulario.categoria.resp!=null?this.$store.state.formulario.categoria.resp.tiposubcategorias.filter(post => { return post.idsubcategoria == formulario.subcategoria.data.idsubcategoria}):[]"
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
          <!-- {{this.$store.state.formulario.categoria.resp.tiposubcategorias}}
          {{this.$store.state.formulario.categoria.resp.tiposubcategorias.filter(post => { return post.idsubcategoria == formulario.subcategoria.data.idsubcategoria})}} -->
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
              <q-item class="row justify-center items-center">
                  <!-- <q-item-section avatar top>
                    <q-icon name="account_tree" color="black" size="34px" />
                  </q-item-section>

                  <q-item-section top class="col-2 gt-sm">
                    <q-item-label class="q-mt-sm">GitHub</q-item-label>
                  </q-item-section> -->

                  <q-item-section top>
                    <q-item-label lines="1">
                      <q-input v-model="formulario.productos[0].nombre" label="Nombrel del producto" type="text" :rules="[ val => val && val.length > 0 || 'Campo vacio']">
                      </q-input>
                    </q-item-label>
                    <q-item-label lines="1">
                      <q-input v-model="formulario.productos[0].descripcion" label="Descripcion" type="text" :rules="[ val => val && val.length > 0 || 'Campo vacio']">
                      </q-input>
                    </q-item-label>
                  </q-item-section>

                  <q-item-section top side>
                    <!-- <div class="text-grey-8 q-gutter-xs">
                      <q-btn class="gt-xs" size="12px" flat dense round icon="delete" />
                      <q-btn class="gt-xs" size="12px" flat dense round icon="done" />
                      <q-btn size="12px" flat dense round icon="more_vert" />
                    </div> -->
                  </q-item-section>
                </q-item>
                <q-separator spaced /> 
              <q-intersection
                v-for="(applicant, counter) in formulario.productos" v-bind:key="counter"
                transition="scale"
                leave="scale"
                >
                 <q-item v-if="counter>0" class="row justify-center items-center">
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
                <div class="text-h6">Anexo</div>
                <!-- <div class="text-subtitle2">by John Doe</div> -->
            </q-card-section>
            <q-separator />
            <q-card-section>
              <div class="row justify-center items-center">
                <q-uploader class="divuploader"
                    label="Formato - Ficha de inscripción"
                    auto-upload
                    max-files="1"
                    :factory="factoryFn"
                    accept=".xls , .xlsx, .docx, .pdf"                    
                    style="max-width: 600px"
                  />
              </div>
              <div class="row justify-center items-center">
                <q-uploader class="divuploader"
                    label="Anexo - Listado de asociados"
                    auto-upload
                    max-files="1"
                    :factory="factoryFn"
                    accept=".xls , .xlsx, .docx, .pdf"                    
                    style="max-width: 600px"
                  />
              </div>
              <div class="row justify-center items-center">
                <q-uploader class="divuploader"
                    label="Anexo - Carta de consentimiento"
                    auto-upload
                    max-files="1"
                    :factory="factoryFn"
                    accept=".xls , .xlsx, .docx, .pdf"                    
                    style="max-width: 600px"
                  />
              </div>
              <div class="row justify-center items-center">
                <q-uploader class="divuploader"
                    label="Anexo - Carta de intención"
                    auto-upload
                    max-files="1"
                    :factory="factoryFn"
                    accept=".xls , .xlsx, .docx, .pdf"                    
                    style="max-width: 600px"
                  />
              </div>
            </q-card-section>
          </q-card>
           <q-card class="my-card q-ma-md">
            <q-card-section>
                <div class="text-h6">Documentación que se debe anexar a la solicitud</div>
                <!-- <div class="text-subtitle2">by John Doe</div> -->
            </q-card-section>
            <q-separator />
            <q-card-section>
              <div class="row justify-center items-center">
                <q-uploader class="divuploader"
                    label="Certificado de existencia y representación legal vigente"
                    auto-upload
                    flat
                    bordered
                    max-files="1"
                    :factory="factoryFn"
                    accept=".xls , .xlsx, .docx, .pdf"
                    
                    style="max-width: 600px"
                  />
              </div>
              <div class="row justify-center items-center">
                <q-uploader class="divuploader"
                    label="Certificaciones con las que dispone actualmente la empresa"
                    auto-upload
                    flat
                    bordered
                    max-files="1"
                    :factory="factoryFn"
                    accept=".xls , .xlsx, .docx, .pdf"                    
                    style="max-width: 600px"
                  />
              </div>
              <div class="row justify-center items-center">
                <q-uploader class="divuploader"
                    label="Permisos o registros con los que cuenta actualmente la empresa"
                    auto-upload
                    flat
                    bordered
                    max-files="1"
                    :factory="factoryFn"
                    accept=".xls , .xlsx, .docx, .pdf"                    
                    style="max-width: 600px"
                  />
              </div>
              <div class="row justify-center items-center">
                <q-uploader class="divuploader"
                    label="RUT o resolución de facturación DIAN"
                    auto-upload
                    flat
                    bordered
                    max-files="1"
                    :factory="factoryFn"
                    accept=".xls , .xlsx, .docx, .pdf"                    
                    style="max-width: 600px"
                  />
              </div>
              <div class="row justify-center items-center">
                <q-uploader class="divuploader"
                    label="Listado de asociados diligenciado"
                    auto-upload
                    flat
                    bordered
                    max-files="1"
                    :factory="factoryFn"
                    accept=".xls , .xlsx, .docx, .pdf"                    
                    style="max-width: 600px"
                  />
              </div>
              <div class="row justify-center items-center">
                <q-uploader class="divuploader"
                    label="Carta de consentimiento informado diligenciada y firmada - Anexo 2"
                    auto-upload
                    flat
                    bordered
                    max-files="1"
                    :factory="factoryFn"
                    accept=".xls , .xlsx, .docx, .pdf"                    
                    style="max-width: 600px"
                  />
              </div>
            </q-card-section>
          </q-card>
            <div style="
                      display: flex;
                      flex-direction: row;
                      align-content: center;
                      justify-content: center;
                  ">
              <q-btn
                type="submit"
                size="22px"
                class="q-px-xl q-py-xs"
                color="primary"
                label="Enviar Formulario"
              />
              <!-- {{formulario.municipio}} -->
            <!-- <q-btn label="Reset" type="reset" color="primary" flat class="q-ml-sm" /> -->
          </div>
        </masonry>
            <!-- <q-toggle v-model="accept" label="I accept the license and terms" /> -->

          
        </q-form>
        <!-- {{this.$store.state.formulario.cargando}} -->
        <q-inner-loading :showing="this.$store.state.formulario.cargando">
          <q-spinner-hourglass size="5.5em" color="green" />
        </q-inner-loading>
        <!-- <q-btn
          size="35px"
          round
          icon="map"
          @click="uploadimg" 
        /> -->

    </div>
</template>

<script>

import EmpresaAvatar from './EmpresaAvatar'
// import { mapState } from 'vuex'
const optionsmunicipios = [
          {
              label: 'Albania',
              value: 'Albania',
              icon: 'img:./../media/iconospng/Flag_of_Albania.png'
          },
          {
              label: 'Barrancas',
              value: 'Barrancas',
              icon: 'img:./../media/iconospng/Flag_of_Barrancas.png'
          },
          {
              label: 'Dibulla',
              value: 'Dibulla',
              icon: 'img:./../media/iconospng/Flag_of_Dibulla.png'
          },
          {
              label: 'Distracción',
              value: 'Distracción',
              icon: 'img:./../media/iconospng/Flag_of_Distracción.png'
          },
          {
              label: 'El Molino',
              value: 'El Molino',
              icon: 'img:./../media/iconospng/Flag_of_El_Molino.png'
          },
          {
              label: 'Fonseca',
              value: 'Fonseca',
              icon: 'img:./../media/iconospng/Flag_of_Fonseca.png'
          },
          {
              label: 'Hatonuevo',
              value: 'Hatonuevo',
              icon: 'img:./../media/iconospng/Flag_of_Hatonuevo.png'
          },
          {
              label: 'La Jagua del Pilar',
              value: 'La Jagua del Pilar',
              icon: 'img:./../media/iconospng/Flag_of_La_Jagua_del_Pilar.png'
          },
          {
              label: 'Maicao',
              value: 'Maicao',
              icon: 'img:./../media/iconospng/Flag_of_Maicao.png'
          },
          {
              label: 'Manaure',
              value: 'Manaure',
              icon: 'img:./../media/iconospng/Flag_of_Manaure.png'
          },
          {
              label: 'Riohacha',
              value: 'Riohacha',
              icon: 'img:./../media/iconospng/Flag_of_Riohacha.png'
          },
          {
              label: 'San Juan del Cesar',
              value: 'San Juan del Cesar',
              icon: 'img:./../media/iconospng/Flag_of_San_Juan_del_Cesar.png'
          },
          {
              label: 'Uribia',
              value: 'Uribia',
              icon: 'img:./../media/iconospng/Flag_of_Uribia.png'
          },
          {
              label: 'Urumita',
              value: 'Urumita',
              icon: 'img:./../media/iconospng/Flag_of_Urumita.png'
          },
          {
              label: 'Villanueva',
              value: 'Villanueva',
              icon: 'img:./../media/iconospng/Flag_of_Villanueva.png'
          }
];
export default {
  name: 'FormularioNegocios',
  components: { EmpresaAvatar},
  props: {
    propformulario: {
      type: Object
      // default: () => {}
    }
  },
  // computed: {
  //   ...mapState({
  //     categoria: state => state.categoria,
  //   })
  // },
  beforeMount() {
    this.AXIO_GET_CATEGORIAS()
    this.verificarProps();
    // this.agregarCategorias();
  },
  data () {
    return {
      documentos: [],
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
          rules: [v => !v || /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail debe ser valido', v => v && v.length > 0 || 'Campo vacio']
        },
        twitter: {
          nombre: 'twitter',
          type: 'text',
          data: null,
          label: 'Twitter',
          rules: null
        },
        facebook: {
          nombre: 'facebook',
          type: 'text',
          data: null,
          label: 'Facebook',
          rules: null
        },
        instagram: {
          nombre: 'instagram',
          type: 'text',
          data: null,
          label: 'Instagram',
          rules: null
        },
        linkvideo: {
          nombre: 'linkvideo',
          type: 'text',
          data: null,
          label: 'Link Video YouTube',
          rules: null
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
          label: 'Categoria',
          rules: [ val => val && val != null || 'Campo vacio']
        },
        subcategoria: {
          nombre: 'subcategoria',
          type: null,
          data: null,
          label: 'Sub Categoria',
          rules: [ val => val && val.length > 0 || 'Campo vacio']
        },
        tiposubcategoria: {
          nombre: 'tipesubcategoria',
          type: null,
          data: null,
          label: 'Tipo Sub Categoria'
        },
        productos: [
          {
            nombre: null,
            descripcion: null,
            urlimagen: null
          }
        ]
      },
      options: optionsmunicipios,
      submitResult: null,
      dense: false,
      accept: false
    }
  },
  methods: {
    factoryFn (files) {
      let formData = new FormData();
      formData.append('documentos', files[0]);
      // this.$store.dispatch('formulario/GUARDAR_DOC',formData).then(function(resp) {
      //     console.log(resp)
      // })
      const app = this;
      return new Promise((resolve) => {
        app.$store.dispatch('formulario/GUARDAR_DOC',formData).then(function(resp) {
          app.documentos.push({
            urldocumento:resp.resp.url,
            imgnombre:resp.resp.imgnombre,
            tmpnombre:resp.resp.tmpnombre
          });
          resolve(resp)
        })  
      })
    },
    AXIO_GET_CATEGORIAS() {
      this.$store.dispatch('formulario/CARGAR_CATEGORIA');
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
    onclick(node) {
      console.log(node)
    },
    verificarProps() {
      console.log('propformulario');
      console.log(this.propformulario);
      console.log(this.formulario.nombreempresa.data);
      console.log('propformulario');
      if (this.propformulario != null) {
        Object.entries(this.propformulario).forEach(([key, value]) => {
            console.log(key+' : '+value);
            if(this.formulario[key]!=null){
              console.log( this.formulario[key].data);
              if (key=='productos') {
                this.formulario[key]=value
              }else{
                this.formulario[key].data = value
              }
            }
            
        })
      }
    },
    uploadimg () {
      if (!this.$refs.child.croppa.hasImage()) {
        console.log('no image to upload')
        return
      }
      var submitResult = {}    
      Object.entries(this.formulario).forEach(([key, value]) => {
        if (value.data!='' && value.data!=null) {
          if(key=='categoria' || key=='subcategoria' || key=='tiposubcategoria'){
              submitResult['id'+key] = value.data['id'+key]==''?null:value.data['id'+key]
          }else{
            submitResult[key] = value.data==''?null:value.data
          }
        }if(key=='productos'){
          submitResult[key]=value
        }
      })
      // console.log(this.formulario.productos);
      // console.log(submitResult);
      // let obj = {
      //   prop1: null,
      //   prop2: null,
      //   prop3: this.formulario.productos
      // }
      // return new Promise((resolve) => {
      //   this.$store.dispatch('formulario/GUARDAR_PRODUCTOS',obj).then(function(resp) {
      //     resolve(resp)
      //   })  
      // })
      this.$refs.child.croppa.generateBlob((blob) => {
        var fd = new FormData()
        fd.append('file', blob, 'logoEmpresa.jpg')
        let obj = {
          prop1: fd,
          prop2: submitResult,
          prop3: this.formulario.productos,
          prop4: this.documentos
        }
        return new Promise((resolve) => {
          this.$store.dispatch('formulario/GUARDAR_IMG',obj).then(function(resp) {
            resolve(resp)
          })  
        })
      })      
    },
    addVisa () {
      this.formulario.productos.push({
        nombre: null,
        descripcion: null,
        urlimagen: null
      })
    },
    deleteVisa (counter) {
      this.formulario.productos.splice(counter, 1);
    },
    onSubmit (evt) {
      const app = this;
      if (!this.$refs.child.croppa.hasImage()) {
        console.log('No')
        return
      }
      var submitResult = {}    
      Object.entries(this.formulario).forEach(([key, value]) => {
        if (value.data!='' && value.data!=null) {        
          if(key=='categoria' || key=='subcategoria' || key=='tiposubcategoria'){
              submitResult['id'+key] = value.data['id'+key]==''?null:value.data['id'+key]
          }else{
            submitResult[key] = value.data==''?null:value.data
          }
        }
      })
      // console.log(submitResult)
      // console.log(this.documentos)
      // return
      this.$refs.child.croppa.generateBlob((blob) => {
        var fd = new FormData()
        fd.append('file', blob, 'filename.jpg')
        let obj = {
          prop1: fd,
          prop2: submitResult,
          prop3: this.formulario.productos,
          prop4: this.documentos
        }
        return new Promise((resolve) => {
          app.$store.dispatch('formulario/GUARDAR_IMG',obj).then(function(resp) {
            // app.onReset()
            resolve(resp)
          })  
        })
      })           
      console.log(submitResult);
        this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Submitted'
        })
    },
    onReset () {
      Object.entries(this.formulario).forEach(([key, value]) => {
        if (value.data!='' && value.data!=null) {
            this.formulario[key].data = null
        }
      })
      this.formulario.productos = [
          {
            nombre: null,
            descripcion: null,
            urlimagen: null
          }
        ];
      this.documentos = [];
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
.divuploader
  width: 100%
</style>
