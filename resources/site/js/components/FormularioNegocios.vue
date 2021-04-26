<template>
    <div class="q-pa-md" >
      <q-form
        @submit="onSubmit"
        @reset="onReset"
        class="q-gutter-md"
      >
                <!-- <a @click.prevent="addfiletest">Trigger A's method</a> -->
      <!-- {{formulario.idempresa}} -->
      <masonry :cols="{default: 2, 1000: 2, 700: 1}" :gutter="10">
        <q-card class="my-card q-ma-md">
          <q-card-section>
              <div class="text-h6">Informacion de la empresa</div>
              <!-- <div class="text-subtitle2">by John Doe</div> -->
          </q-card-section>
          <q-separator />
          <q-card-section> 
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Nombre</div>
              </div> -->
              <div class="col-12 col-md-9" style="width: 100%;">
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
              <div class="col-12 col-md-9" style="width: 100%;">
                  <q-input v-model="formulario.representantelegal.data" label="Representante Legal" type="text" counter maxlength="200" :rules="formulario.representantelegal.rules">
                  </q-input>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Descripcion</div>
              </div> -->
              <div class="col-12 col-md-9" style="width: 100%;">
                  <q-input v-model="formulario.descripcion.data" :label="formulario.descripcion.label" type="textarea" counter maxlength="500" :rules="formulario.descripcion.rules"
                    :hint="formulario.descripcion.hint"
                  >
                  </q-input>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Telefono</div>
              </div> -->
              <div class="col-12 col-md-9" style="width: 100%;">
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
              <div class="col-12 col-md-9" style="width: 100%;">
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
                    <template v-slot:prepend>
                      <q-icon name="explore" />
                    </template>
                </q-select>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Direccion</div>
              </div> -->
              <div class="col-12 col-md-9" style="width: 100%;">
                  <q-input v-model="formulario.direccion.data" label="Direccion" type="text" counter maxlength="200" :dense="dense" :rules="formulario.direccion.rules">
                  <template v-slot:prepend>
                      <q-icon name="location_on" />
                  </template>
                  </q-input>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Twitter</div>
              </div> -->
              <div class="col-12 col-md-9" style="width: 100%;">
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
              <div class="col-12 col-md-9" style="width: 100%;">
                  <q-input v-model="formulario.twitter.data" label="Twitter" :dense="dense" :rules="formulario.twitter.rules">
                    <template v-slot:prepend>
                        <!-- <q-icon name="fab fa-twitter-square" /> -->
                        <q-icon name="img:media/iconssvg/gorjeo.svg" />
                    </template>
                  </q-input>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Facebook</div>
              </div> -->
              <div class="col-12 col-md-9" style="width: 100%;">
                  <q-input v-model="formulario.facebook.data" label="Facebook" :dense="dense" :rules="formulario.facebook.rules">
                  <template v-slot:prepend>
                      <!-- <q-icon name="facebook" /> -->
                      <q-icon name="img:media/iconssvg/facebook.svg" />
                  </template>
                  </q-input>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">Instragram</div>
              </div> -->
              <div class="col-12 col-md-9" style="width: 100%;">
                  <q-input v-model="formulario.instagram.data" label="Instagram" :dense="dense" :rules="formulario.instagram.rules">
                  <template v-slot:prepend>
                      <!-- <q-icon name="fab fa-instagram" /> -->
                      <q-icon name="img:media/iconssvg/instagram.svg" />
                  </template>
                  </q-input>
              </div>
            </div>
            <div class="row justify-center items-center">
              <!-- <div class="col-12 col-md-3">
                  <div class="text-subtitle2">YouTube</div>
              </div> -->
              <div class="col-12 col-md-9" style="width: 100%;">
                <q-input v-model="formulario.linkvideo.data" label="Link Video YouTube" :dense="dense" :rules="formulario.twitter.rules">
                <template v-slot:prepend>
                    <!-- <q-icon name="ondemand_video" /> -->
                    <q-icon name="img:media/iconssvg/youtube.svg" />
                </template>
                </q-input>
              </div>
            </div>
          </q-card-section>
        </q-card>
        <q-card class="my-card q-ma-md">
          <q-card-section>
            <div class="text-h6">Logo</div>
            <!-- <div class="text-subtitle2">by John Doe</div> -->
          </q-card-section>
          <q-separator />
          <q-card-section cass="justify-center items-center">
            <div class="column items-center" style="">
              <!-- {{formulario.imagenlogo.data}} -->
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
                <div class="text-h6">Clasificación del negocio</div>
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
                :options="this.$store.state.formulario.categoria!=null?this.$store.state.formulario.categoria.categorias:[]"
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
                  :options="this.$store.state.formulario.categoria!=null?this.$store.state.formulario.categoria.subcategorias.filter(post => { return post.idcategoria == formulario.categoria.data.idcategoria}):[]"               
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
              <!-- <q-select v-if="formulario.subcategoria.data!=null && typeof this.$store.state.formulario.categoria.tiposubcategorias.filter(post => { return post.idsubcategoria == formulario.subcategoria.data.idsubcategoria}).length === 'undefined'" -->
              <q-select v-if="formulario.subcategoria.data!=null && this.$store.state.formulario.categoria.tiposubcategorias.filter(post => { return post.idsubcategoria == formulario.subcategoria.data.idsubcategoria}).length >1 "
                :name="formulario.tiposubcategoria.nombre"
                :label="formulario.tiposubcategoria.label"
                transition-show="flip-up"
                transition-hide="flip-down"
                v-model="formulario.tiposubcategoria.data"
                option-label="nombre"
                option-value="idtiposubcategoria"
                :options="this.$store.state.formulario.categoria!=null?this.$store.state.formulario.categoria.tiposubcategorias.filter(post => { return post.idsubcategoria == formulario.subcategoria.data.idsubcategoria}):[]"
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
            <!-- {{this.$store.state.formulario.categoria.tiposubcategorias}}
            {{this.$store.state.formulario.categoria.tiposubcategorias.filter(post => { return post.idsubcategoria == formulario.subcategoria.data.idsubcategoria})}} -->
            </q-card-section>
          </q-card>        
          <q-card class="my-card q-ma-md">
          </q-card>
        <q-card class = "my-card q-ma-md">
          <q-card-section>
            <div class = "row fit justify-between">
              <span class = "text-h6">Productos</span>
              <q-btn size = "" outline rounded label = "Agregar" no-caps color = "teal" @click = "addVisa" icon = "add"/>
            </div>
          </q-card-section>
          <q-separator/>
          <!-- <div>
              <q-btn @click="addVisa" label="Agregar Producto" color="primary"/>
          </div> -->
          <q-card-section class="q-pa-none">
            <!-- <q-separator spaced />  -->
            <!-- Wrapping only one DOM element, defined by QBtn -->
            <q-list bordered separator>
              <q-item
                  v-for = "(applicant, counter) in formulario.productos.filter(post => { return post.activo == 1})" v-bind:key = "counter"
                  class = "row justify-center items-center">
                <q-item-section top>
                  <q-item-label lines = "1">
                    <q-input v-model = "applicant.nombre" label = "Nombrel del producto" type = "text" :rules = "[ val => val && val.length > 0 || 'Campo vacio']"

                    >
                    </q-input>
                  </q-item-label>
                  <q-item-label lines = "1">
                    <q-input v-model = "applicant.descripcion" label = "Descripción" type = "text" :rules = "[ val => val && val.length > 0 || 'Campo vacio']">
                    </q-input>
                  </q-item-label>
                  <q-item-label class = "text-right">
                    <q-btn outline rounded color = "negative" v-if = "counter>=1" @click = "deleteVisa(counter)" icon = "delete" label = "Eliminar" no-caps/>
                  </q-item-label>
                </q-item-section>
              </q-item>
            </q-list>
          </q-card-section>
        </q-card>
          <q-card class="my-card q-ma-md">
          </q-card>
          <q-card class="my-card q-ma-md">
            <q-card-section>
                <div class="text-h6">Formatos & formularios</div>
                <!-- <div class="text-subtitle2">by John Doe</div> -->
            </q-card-section>
            <q-separator />
            <q-card-section>
              <div v-for="(item, count) in anexofile" v-bind:key="count" class="row justify-center items-center">
                <q-uploader
                  ref="qUploader"
                  class="divuploader"
                  :label="item.label"                      
                  :name="item.name"
                  max-files="1"
                  accept=".xls , .xlsx, .docx, .doc, .pdf"                    
                  style="max-width: 700px"
                  @removed="removeFiele"
                  @uploaded="uploadedFile"
                  @start="startFile"
                  @added="addedFile"                     
                  >
                   <template v-slot:header="scope">
                    <div class="row no-wrap items-center q-pa-sm q-gutter-xs">

                      <q-spinner v-if="scope.isUploading" class="q-uploader__spinner" />
                      <div class="col">
                        <div class="q-uploader__title">{{item.label}}</div>
                        <div class="q-uploader__subtitle">{{ scope.uploadSizeLabel }} 
                          <!-- / {{ scope.uploadProgressLabel }} -->
                          </div>
                      </div>
                      <div v-if="item.urlActual!=null">
                        <a style="margin-right: 20px;" rel="noopener noreferrer" target="_blank"  id="btn-1615192830423" :href="base_url+item.urlActual" class="sppb-btn sppb-btn-round">
                          <q-icon size="1.4rem" :name="'img:media/iconssvg/'+item.urlActual.split('.').pop()+'.svg'"/>
                        </a>
                      </div>
                      <a style="margin-right: 20px;" rel="noopener noreferrer" target="_blank"  id="btn-1615192830423" :href="base_url+'media/attachments/2021/03/08/'+item.doc" class="sppb-btn  sppb-btn-round">
                        <q-icon size="1.4rem"  :name="'img:'+base_url+'media/iconssvg/'+item.icon+'.svg'">
                            <q-tooltip>
                              Descargar formato para diligenciar
                            </q-tooltip>
                        </q-icon>
                      </a>
                      <q-btn v-if="scope.canAddFiles" type="a" icon="add_box" round dense flat>
                        <q-uploader-add-trigger />
                        <q-tooltip>Buscar archivo</q-tooltip>
                      </q-btn>
                      <!-- <q-btn v-if="scope.canUpload" icon="cloud_upload" @click="scope.upload" round dense flat >
                        <q-tooltip>Upload Files</q-tooltip>
                      </q-btn> -->

                      <q-btn v-if="scope.isUploading" icon="clear" @click="scope.abort" round dense flat >
                        <q-tooltip>Cancelar subida</q-tooltip>
                      </q-btn>
                    </div>
                  </template>
                  <template v-slot:list="scope">
                    <q-list separator>

                      <q-item v-for="file in scope.files" :key="file.name">
                        <q-item-section>
                          <q-item-label class="full-width ellipsis">
                            {{ file.name }}
                          </q-item-label>

                          <!-- <q-item-label caption>
                            Status: {{ file.__status }}
                          </q-item-label> -->

                          <q-item-label caption>
                            {{ file.__sizeLabel }}
                             <!-- / {{ file.__progressLabel }} -->
                          </q-item-label>
                        </q-item-section>

                        <q-item-section
                          v-if="file.__img"
                          thumbnail
                          class="gt-xs"
                        >
                          <img :src="file.__img.src">
                        </q-item-section>

                        <q-item-section top side>
                          <q-btn
                            class="gt-xs"
                            size="12px"
                            flat
                            dense
                            round
                            color="red"
                            icon="delete"
                            @click="scope.removeFile(file)"
                          />
                        </q-item-section>
                      </q-item>

                    </q-list>
                  </template>
                </q-uploader>
              </div>
            </q-card-section>
          </q-card>
           <q-card class="my-card q-ma-md">
            <q-card-section>
                <div class="text-h6">Documentación </div>
                <!-- <div class="text-subtitle2">by John Doe</div> -->
            </q-card-section>
            <q-separator />
            <q-card-section>
              <div v-for="(item, count) in anexarfile" v-bind:key="count" class="row justify-center items-center">
                <q-uploader
                  ref="qUploader"
                  class="divuploader"
                  :label="item.label"                      
                  :name="item.name"
                  max-files="1"
                  accept=".xls , .xlsx, .docx, .doc, .pdf"                    
                  style="max-width: 700px"
                  @removed="removeFiele"
                  @uploaded="uploadedFile"
                  @start="startFile"
                  @added="addedFile"                     
                  >
                  <template v-slot:header="scope">
                    <div class="row no-wrap items-center q-pa-sm q-gutter-xs">
                      <!-- <q-btn v-if="scope.queuedFiles.length > 0" icon="clear_all" @click="scope.removeQueuedFiles" round dense flat >
                        <q-tooltip>Clear All</q-tooltip>
                      </q-btn> -->
                      <!-- <q-btn v-if="scope.uploadedFiles.length > 0" icon="done_all" @click="scope.removeUploadedFiles" round dense flat >
                        <q-tooltip>Remove Uploaded Files</q-tooltip>
                      </q-btn> -->
                      <q-spinner v-if="scope.isUploading" class="q-uploader__spinner" />
                      <div class="col">
                        <div class="q-uploader__title">{{item.label}}</div>
                        <div class="q-uploader__subtitle">{{ scope.uploadSizeLabel }} 
                          <!-- / {{ scope.uploadProgressLabel }} -->
                          </div>
                      </div>
                      <q-btn v-if="scope.canAddFiles" type="a" icon="add_box" round dense flat>
                        <q-uploader-add-trigger />
                        <q-tooltip>Buscar archivo</q-tooltip>
                      </q-btn>
                      <!-- <q-btn v-if="scope.canUpload" icon="cloud_upload" @click="scope.upload" round dense flat >
                        <q-tooltip>Upload Files</q-tooltip>
                      </q-btn> -->

                      <q-btn v-if="scope.isUploading" icon="clear" @click="scope.abort" round dense flat >
                        <q-tooltip>Cancelar</q-tooltip>
                      </q-btn>
                    </div>
                  </template>
                  <template v-slot:list="scope">
                    <q-list separator>

                      <q-item v-for="file in scope.files" :key="file.name">
                        <q-item-section>
                          <q-item-label class="full-width ellipsis">
                            {{ file.name }}
                          </q-item-label>

                          <!-- <q-item-label caption>
                            Status: {{ file.__status }}
                          </q-item-label> -->

                          <q-item-label caption>
                            {{ file.__sizeLabel }}
                             <!-- / {{ file.__progressLabel }} -->
                          </q-item-label>
                        </q-item-section>

                        <q-item-section
                          v-if="file.__img"
                          thumbnail
                          class="gt-xs"
                        >
                          <img :src="file.__img.src">
                        </q-item-section>

                        <q-item-section top side>
                          <q-btn
                            class="gt-xs"
                            size="12px"
                            flat
                            dense
                            round
                            color="red"
                            icon="delete"
                            @click="scope.removeFile(file)"
                          />
                        </q-item-section>
                      </q-item>

                    </q-list>
                  </template>
                </q-uploader>
              </div>
            </q-card-section>
          </q-card>
        </masonry>
            <!-- <q-toggle v-model="accept" label="I accept the license and terms" /> -->

          <div class="col-12">
            <q-btn
                outline
                rounded
                type="submit"
                size=""
                class="full-width"
                color="teal"
                label="Enviar Formulario"
            />
          </div>
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
              icon: 'img:media/iconospng/Flag_of_Albania.png'
          },
          {
              label: 'Barrancas',
              value: 'Barrancas',
              icon: 'img:media/iconospng/Flag_of_Barrancas.png'
          },
          {
              label: 'Dibulla',
              value: 'Dibulla',
              icon: 'img:media/iconospng/Flag_of_Dibulla.png'
          },
          {
              label: 'Distracción',
              value: 'Distracción',
              icon: 'img:media/iconospng/Flag_of_Distracción.png'
          },
          {
              label: 'El Molino',
              value: 'El Molino',
              icon: 'img:media/iconospng/Flag_of_El_Molino.png'
          },
          {
              label: 'Fonseca',
              value: 'Fonseca',
              icon: 'img:media/iconospng/Flag_of_Fonseca.png'
          },
          {
              label: 'Hatonuevo',
              value: 'Hatonuevo',
              icon: 'img:media/iconospng/Flag_of_Hatonuevo.png'
          },
          {
              label: 'La Jagua del Pilar',
              value: 'La Jagua del Pilar',
              icon: 'img:media/iconospng/Flag_of_La_Jagua_del_Pilar.png'
          },
          {
              label: 'Maicao',
              value: 'Maicao',
              icon: 'img:media/iconospng/Flag_of_Maicao.png'
          },
          {
              label: 'Manaure',
              value: 'Manaure',
              icon: 'img:media/iconospng/Flag_of_Manaure.png'
          },
          {
              label: 'Riohacha',
              value: 'Riohacha',
              icon: 'img:media/iconospng/Flag_of_Riohacha.png'
          },
          {
              label: 'San Juan del Cesar',
              value: 'San Juan del Cesar',
              icon: 'img:media/iconospng/Flag_of_San_Juan_del_Cesar.png'
          },
          {
              label: 'Uribia',
              value: 'Uribia',
              icon: 'img:media/iconospng/Flag_of_Uribia.png'
          },
          {
              label: 'Urumita',
              value: 'Urumita',
              icon: 'img:media/iconospng/Flag_of_Urumita.png'
          },
          {
              label: 'Villanueva',
              value: 'Villanueva',
              icon: 'img:media/iconospng/Flag_of_Villanueva.png'
          }
];
const anexofile = [
  {
    name:'fFichaInscripcion',
    label:'Formato - Ficha de inscripción',
    doc:'ficha_inscripcion_nv_v2020.xlsx',
    icon: 'xlsx',
    urlActual:null
  },
  {
    name:'aListadoAsociados',
    label:'Anexo - Listado de asociados',
    doc:'anexo-listado_asociados.xlsx',
    icon: 'xlsx',
    urlActual:null
  },
  {
    name:'aCartaConsentimiento',
    label:'Anexo - Carta de consentimiento',
    doc:'carta_de_consentimiento_informado_v2020.docx',
    icon: 'docx',
    urlActual:null
  },
  {
    name:'aCartaIntencion',
    label:'Anexo - Carta de intención',
    doc:'carta-de-intencion-nodo--aliados.docx',
    icon: 'docx',
    urlActual:null
  }
];
const anexarfile = [
  {
    name:'cExistenciaRepresentacionLegalVigente',
    label:'Certificado de existencia y representación legal vigente',
    urlActual:null
  },
  {
    name:'cDisponeEmpresa',
    label:'Certificaciones con las que dispone actualmente la empresa',
    urlActual:null
  },
  {
    name:'prActualEmpresa',
    label:'Permisos o registros con los que cuenta actualmente la empresa',
    urlActual:null
  },
  {
    name:'rutFacturacionDian',
    label:'RUT o resolución de facturación DIAN',
    urlActual:null
  },
  {
    name:'listadoAsociadosDiligenciado',
    label:'Listado de asociados diligenciado',
    urlActual:null
  },
  {
    name:'cartaConcentimientoInformadoFirma',
    label:'Carta de consentimiento informado diligenciada y firmada - Anexo 2',
    urlActual:null
  }
]
export default {
  name: 'FormularioNegocios',
  components: { EmpresaAvatar},
  props: {
    propformulario: {
      type: Object
      // default: () => {}
    },
    admiurl: {
      type: Boolean,
      default: false
    }
  },
  // computed: {
  //   ...mapState({
  //     categoria: state => state.categoria,
  //   })
  // },
  
  data () {
    return {
      base_url,
      anexofile:anexofile,
      anexarfile:anexarfile,
      formData: new FormData(),
      documentos: [],
      selected: [],
      ticked: [],
      expanded: [],
      filter: null,
      step: 1,
      url: 'https://78.media.tumblr.com/tumblr_m39nv7PcCU1r326q7o1_500.png',
      lorem: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
      formulario: {   
        idempresa:null,    
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
          label: 'Describe tu empresa',
          hint: "Menciona el impacto ambiental positivo que genera tu empresa",
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
          nombre: 'Sector',
          type: null,
          data: null,
          label: 'Sector',
          rules: [ val => val && val.length > 0 || 'Campo vacio']
        },
        tiposubcategoria: {
          nombre: 'Subsector',
          type: null,
          data: null,
          label: 'Subsector'
        },
        productos: [
          {
            idproducto:null,
            nombre: null,
            descripcion: null,
            urlimagen: null,
            activo: 1
          }
        ]
      },
      options: optionsmunicipios,
      submitResult: null,
      dense: false,
      accept: false
    }
  },
  beforeMount() {
  },
  mounted(){    
    this.$store.commit('formulario/CARGANDO',true)
    this.AXIO_GET_CATEGORIAS()   
    if (this.propformulario != null) {
      const interval = setInterval(() => {
        if (this.$refs.qUploader) {
          // this.loaddoc();          
          this.verificarProps();
          clearInterval(interval)
        }
      }, 500)
    }
    this.$store.commit('formulario/CARGANDO',false)
  },
  methods: {
    addedFile(file){
      // console.log(file)
      // console.log(this.$refs)
    },
    uploadedFile(info){
      console.log('Uploaded')
    },
    startFile(){ 
      console.log('Start')
    },
    removeFiele(file){
      // console.log(file)
      // get index of object with id:37
      var removeIndex = this.documentos.map(function(item) { return item.id; }).indexOf(file[0].lastModified);

      // remove object
      this.documentos.splice(removeIndex, 1);
      // console.log(this.documentos);
    },
    loaddoc(documentos){
      let files = [];
      let file = Object;
      // let type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
      documentos.forEach(element => {
         file = {
          id:element.iddocumentos,
          size: element.size,
          type: element.name.split('.').pop(),
          ref:element.ref,
          name: element.name,
          url: element.urldocumento,
          __proto__:{
            src: element.urldocumento
          }
        };
        files.push(file);
      });
      this.addfile(files)
    },
    addfile(file){
      // console.log(this.$refs)
      // console.log(this.$refs.qUploader)
       this.$refs.qUploader.forEach(element => {
        var indexa =  anexofile.map(function(item) { return item.name; }).indexOf(element.$attrs.name);
        var indexaa =  anexarfile.map(function(item) { return item.name; }).indexOf(element.$attrs.name);
        var index =  file.map(function(item) { return item.ref; }).indexOf(element.$attrs.name);
        if (indexa>=0 && index>=0) {
          // console.log(anexofile[indexa])
          // console.log( file[index])
          anexofile[indexa].urlActual = file[index].__proto__.src;
        }
        if (indexaa>=0 && index>=0) {
          // anexarfile[indexaa].urlActual = file[index].__proto__.src;
        }
        if (index>=0) {
          element.addFiles([file[index]]);
        }
      });
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
      // console.log('propformulario');
      // console.log(this.propformulario);
      // console.log(this.formulario.nombreempresa.data);
      // console.log('propformulario');
      if (this.propformulario != null) {
        Object.entries(this.propformulario).forEach(([key, value]) => {
            // console.log(key+' : '+value);
            if(this.formulario[key]!=null){
              // console.log( this.formulario[key].data);
              if (key!=='productos') {
                this.formulario[key].data = value
              }
            }
            if (key=='idempresa') {
              this.formulario[key]=value
            }
            if (key=='productos' && value!=null && value!=false) {
              // console.log(value)
              this.formulario[key]=value
            }
        })
        if (this.propformulario.documentos) {          
          this.loaddoc(this.propformulario.documentos);
        }
      }      
      // console.log(this.formulario)
    },
    addVisa () {
      // console.log('asdasd')
      this.formulario.productos.push({
        idproducto:null,
        nombre: null,
        descripcion: null,
        urlimagen: null,
        activo: 1
      })
    },
    deleteVisa (counter) {
      if (this.formulario.productos[counter].idproducto==null) {
        this.formulario.productos.splice(counter, 1);        
      }else{
        this.formulario.productos[counter].activo = 0;
      }
      console.log(this.formulario.productos);
    },
    onSubmit (evt) {
      const app = this;
      if (!this.$refs.child.croppa.hasImage()) {
        console.log('No')
        app.$q.notify({
          color: 'negative',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Seleccione un Logo',
          position:'center'
        })
        return
      }
      var submitResult = {}
      Object.entries(this.formulario).forEach(([key, value]) => {
        // console.log(key+' : '+value)
        if (key!='idempresa' ) {          
          if (value.data!='' && value.data!=null) {
            if(key=='categoria' || key=='subcategoria' || key=='tiposubcategoria'){
              submitResult['id'+key] = value.data['id'+key]==''?null:value.data['id'+key]
            }else{
              submitResult[key] = value.data==''?null:value.data
            }
          }
        }
        if (key=='idempresa'&&value!=null) {
          submitResult[key]=value;
        }
      })
      // console.log(submitResult)
      // return
      let docFiles=[]
      let doc
      this.$refs.qUploader.forEach(element => {
        if (element.files[0]!=null && element.files[0].lastModified!=null) {          
          doc = element.files[0]
          doc.ref = element.$attrs.name;
          docFiles.push(doc);
          // console.log(element.$attrs.name)
        }
      });
      
      // console.log(docFiles); return
      // console.log(this.$refs.qUploader.value)
      let formDataDocument = new FormData();
      // console.log(docFiles.length)
      if (docFiles.length>0) {        
        for (let i = 0; i < docFiles.length; i++) {
          formDataDocument.append('documentos['+i+']', docFiles[i],docFiles[i].ref+','+docFiles[i].name);
        }
      }else{
        formDataDocument = null
      }
      // console.log(this.formulario.productos)
      // return
      this.$refs.child.croppa.generateBlob((blob) => {
        var img = new FormData()
        // // var doc = new FormData()
        // console.log(blob)
        // this.documentos.push(files[0]);
        img.append('imagenLogo', blob,'imagenLogo,imagennamelogo.jpg')
        // doc.append('documentos', this.documentos)
        let obj = {
          formulario: submitResult,
          productos: this.formulario.productos,
          documentos: formDataDocument,
          imagenlogo: img,
          admiurl:admiurl
        }
        // console.log(obj);
        // return;
        return new Promise((resolve) => {
          app.$store.dispatch('formulario/GUARDAR_FORMULARIO',obj).then(function(resp) {
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
     
    },
    onReset () {
      Object.entries(this.formulario).forEach(([key, value]) => {
        if (value.data!='' && value.data!=null) {
            this.formulario[key].data = null
        }
      })
      this.formulario.productos = [
          {
            idproducto:null,
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
