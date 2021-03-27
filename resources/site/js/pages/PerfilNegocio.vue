<template>
<div class="q-pa-md">
  <div v-if="propperfilmutable">    
    <q-layout view="lHh Lpr lff" container style="height: calc(100vh - 200px);" class="shadow-2 rounded-borders">
      <q-header style="padding-bottom: 12px;padding-top: 12px;" class="bg-white text-primary">
        <q-toolbar>
          <q-toolbar-title size="30px" style="padding-left: 14px;color:#000000;font-weight: bolder;font-size: 30px;height: 29px;">{{propperfilmutable.nombreempresa}}</q-toolbar-title>
          <!-- <q-btn flat @click="drawer = !drawer" round dense icon="menu" /> -->
          <!-- <q-icon  style="font-size: 3em;" v-on:click="navigate()" name="arrow_back" /> -->
          <q-btn v-on:click="navigate()" outline color="primary" >
            <q-icon left size="3em" name="arrow_back" />
            <div>Atras</div>
          </q-btn>
          <!-- <q-btn style="margin-left: 15px;" v-on:click="navigate()" size="15px" class="q-px-xl q-py-xs" color="primary" label="Atras" /> -->
        </q-toolbar>
      </q-header>
<!-- volver,mas grande alineado a la inquierda, producto por fuera,pocentaje quitar
 lapiz , insertar imagenes editar en la tabla,nombre redes sociales, lista en los 
 productosmcumplimientos, video de youtube en el perfil -->
      <!-- carrucel, totulod el negocio a la izquierda,
      descriopcion video y porcentajes de complimientoo -->
      <!-- interpretacion seleccionar en el administrador -->
      <q-drawer
        v-model="drawer"
        show-if-above
        :width="250"
        :breakpoint="400"
      >
        <q-scroll-area style="height: calc(100% - 250px); margin-top: 250px; border-right: 1px solid #ddd">
          <q-list padding>
            <q-list>
              <q-item>
                <q-item-section class="perfilempresa">
                  <q-item-label>{{propperfilmutable.representantelegal}}</q-item-label>
                  <q-item-label caption>
                    <q-item>
                      <q-item-section style="height: 14px;" class="icono" avatar>
                        <q-icon style="font-size: 14px;" name="face" />
                      </q-item-section>
                      <q-item-section style="height: 14px;" class="titulo">Representante Legal</q-item-section>
                    </q-item>      
                  </q-item-label>
                </q-item-section>

                <!-- <q-item-section side top>
                  <q-item-label caption>5 min ago</q-item-label>
                  <q-icon name="star" color="yellow" />
                </q-item-section> -->
              </q-item>

              <q-separator spaced inset />
              <q-item>
                <q-item-section class="perfilempresa">
                  <q-item-label>{{propperfilmutable.telefono}}</q-item-label>
                  <q-item-label caption>
                    <q-item>
                      <q-item-section style="height: 14px;" class="icono" avatar>
                        <q-icon style="font-size: 14px;" name="call" />
                      </q-item-section>
                      <q-item-section style="height: 14px;" class="titulo">Telefono</q-item-section>
                    </q-item>      
                  </q-item-label>
                </q-item-section>

                <!-- <q-item-section side top>
                  <q-item-label caption>5 min ago</q-item-label>
                  <q-icon name="star" color="yellow" />
                </q-item-section> -->
              </q-item>

              <q-separator spaced inset />
              <q-item>
                <q-item-section class="perfilempresa">
                  <q-item-label>{{propperfilmutable.municipio}}</q-item-label>
                  <q-item-label caption>
                    <q-item>
                      <q-item-section style="height: 14px;" class="icono" avatar>
                        <q-icon style="font-size: 14px;" name="explore" />
                      </q-item-section>
                      <q-item-section style="height: 14px;" class="titulo">Municipio</q-item-section>
                    </q-item>      
                  </q-item-label>
                </q-item-section>

                <!-- <q-item-section side top>
                  <q-item-label caption>5 min ago</q-item-label>
                  <q-icon name="star" color="yellow" />
                </q-item-section> -->
              </q-item>

              <q-separator spaced inset />
              <q-item>
                <q-item-section class="perfilempresa">
                  <q-item-label>{{propperfilmutable.direccion}}</q-item-label>
                  <q-item-label caption>
                    <q-item>
                      <q-item-section style="height: 14px;" class="icono" avatar>
                        <q-icon style="font-size: 14px;" name="location_on" />
                      </q-item-section>
                      <q-item-section style="height: 14px;" class="titulo">Direccion</q-item-section>
                    </q-item>      
                  </q-item-label>
                </q-item-section>

                <!-- <q-item-section side top>
                  <q-item-label caption>5 min ago</q-item-label>
                  <q-icon name="star" color="yellow" />
                </q-item-section> -->
              </q-item>

              <q-separator spaced inset />
              <q-item>
                <q-item-section class="perfilempresa">
                  <q-item-label>{{propperfilmutable.email}}</q-item-label>
                  <q-item-label caption>
                    <q-item>
                      <q-item-section style="height: 14px;" class="icono" avatar>
                        <q-icon style="font-size: 14px;" name="mail" />
                      </q-item-section>
                      <q-item-section style="height: 14px;" class="titulo">Email</q-item-section>
                    </q-item>      
                  </q-item-label>
                </q-item-section>

                <!-- <q-item-section side top>
                  <q-item-label caption>5 min ago</q-item-label>
                  <q-icon name="star" color="yellow" />
                </q-item-section> -->
              </q-item>
              <div v-if="propperfilmutable.twitter">

                <q-separator spaced inset />
                <q-item>
                  <q-item-section class="perfilempresa">
                    <q-item-label>{{propperfilmutable.twitter}}</q-item-label>
                    <q-item-label caption>
                      <q-item>
                        <q-item-section style="height: 14px;" class="icono" avatar>
                          <q-icon style="font-size: 14px;" name="img:./../media/iconssvg/gorjeo.svg" />
                        </q-item-section>
                        <q-item-section style="height: 14px;" class="titulo">Twitter</q-item-section>
                      </q-item>      
                    </q-item-label>
                  </q-item-section>

                  <!-- <q-item-section side top>
                    <q-item-label caption>5 min ago</q-item-label>
                    <q-icon name="star" color="yellow" />
                  </q-item-section> -->
                </q-item>
              </div>
               <div v-if="propperfilmutable.facebook">

                <q-separator spaced inset />
                <q-item>
                  <q-item-section class="perfilempresa">
                    <q-item-label>{{propperfilmutable.facebook}}</q-item-label>
                    <q-item-label caption>
                      <q-item>
                        <q-item-section style="height: 14px;" class="icono" avatar>
                          <q-icon style="font-size: 14px;" name="img:./../media/iconssvg/facebook.svg" />
                        </q-item-section>
                        <q-item-section style="height: 14px;" class="titulo">Facebook</q-item-section>
                      </q-item>      
                    </q-item-label>
                  </q-item-section>

                  <!-- <q-item-section side top>
                    <q-item-label caption>5 min ago</q-item-label>
                    <q-icon name="star" color="yellow" />
                  </q-item-section> -->
                </q-item>
              </div>

              <div v-if="propperfilmutable.instagram">
                <q-separator spaced inset />
                <q-item>
                  <q-item-section class="perfilempresa">
                    <q-item-label>{{propperfilmutable.instagram}}</q-item-label>
                    <q-item-label caption>
                      <q-item>
                        <q-item-section style="height: 14px;" class="icono" avatar>
                          <q-icon style="font-size: 14px;" name="img:./../media/iconssvg/instagram.svg" />
                        </q-item-section>
                        <q-item-section style="height: 14px;" class="titulo">Instagram</q-item-section>
                      </q-item>      
                    </q-item-label>
                  </q-item-section>

                  <!-- <q-item-section side top>
                    <q-item-label caption>5 min ago</q-item-label>
                    <q-icon name="star" color="yellow" />
                  </q-item-section> -->
                </q-item>
              </div>

              <q-separator spaced inset />

            </q-list>
            <!-- <div class="column perfilempresa">
              <div class="col">                
                <q-item>
                  <q-item-section class="icono" avatar>
                    <q-icon name="face" />
                  </q-item-section>
                  <q-item-section class="titulo">Representante Legal</q-item-section>
                </q-item>               
              </div>
              <div class="col">
                <p>{{propperfilmutable.representantelegal}}</p>
              </div>
            </div>
            <div class="column perfilempresa">
              <div class="col">                
                <q-item>
                  <q-item-section class="icono" avatar>
                    <q-icon name="call" />
                  </q-item-section>
                  <q-item-section class="titulo">Telefono</q-item-section>
                </q-item>               
              </div>
              <div class="col"><p>{{propperfilmutable.telefono}}</p></div>
            </div>
            <div class="column perfilempresa">
              <div class="col">                
                <q-item>
                  <q-item-section class="icono" avatar>
                    <q-icon name="explore" />
                  </q-item-section>
                  <q-item-section class="titulo">Municipio</q-item-section>
                </q-item>               
              </div>
              <div class="col"><p>{{propperfilmutable.municipio}}</p></div>
            </div>
            <div class="column perfilempresa">
              <div class="col">                
                <q-item>
                  <q-item-section class="icono" avatar>
                    <q-icon name="location_on" />
                  </q-item-section>
                  <q-item-section class="titulo">Direccion</q-item-section>
                </q-item>               
              </div>
              <div class="col"><p>{{propperfilmutable.direccion}}</p></div>
            </div>
            <div class="column perfilempresa">
              <div class="col">                
                <q-item>
                  <q-item-section class="icono" avatar>
                    <q-icon name="mail" />
                  </q-item-section>
                  <q-item-section class="titulo">Email</q-item-section>
                </q-item>               
              </div>
              <div class="col"><p>{{propperfilmutable.email}}</p></div>
            </div>
            <div class="row perfilempresa">
              <div class="col" style="display: flex;justify-content: center;align-items: center;"><q-icon style="font-size: 2em;" name="img:./../media/iconssvg/gorjeo.svg" /></div>
              <div class="col" style="display: flex;justify-content: center;align-items: center;"><q-icon style="font-size: 2em;" name="img:./../media/iconssvg/facebook.svg" /></div>
              <div class="col" style="display: flex;justify-content: center;align-items: center;"><q-icon style="font-size: 2em;" name="img:./../media/iconssvg/instagram.svg" /></div>
              <div class="col" style="display: flex;justify-content: center;align-items: center;"><q-icon style="font-size: 2em;" name="img:./../media/iconssvg/youtube.svg" /></div>
            </div> -->
            <!-- <q-item v-ripple>
              <q-item-section avatar>
                <q-icon name="inbox" />
              </q-item-section>

              <q-item-section>
                
              </q-item-section>
              
            </q-item> -->
<!-- 
            <q-item active clickable v-ripple>
              <q-item-section avatar>
                <q-icon name="star" />
              </q-item-section>

              <q-item-section>
                Star
              </q-item-section>
            </q-item>

            <q-item clickable v-ripple>
              <q-item-section avatar>
                <q-icon name="send" />
              </q-item-section>

              <q-item-section>
                Send
              </q-item-section>
            </q-item>

            <q-item clickable v-ripple>
              <q-item-section avatar>
                <q-icon name="drafts" />
              </q-item-section>

              <q-item-section>
                Drafts
              </q-item-section>
            </q-item> -->
          </q-list>
        </q-scroll-area>
        
          <q-img class="absolute-top" style="height: 250px"
            :src="propperfilmutable.imagenlogo"
            :ratio="1"
          />
      </q-drawer>

      <q-page-container>
        <q-page padding>
          <div v-if="propperfilmutable.imgcarrusel" class="q-pa-md">
            <q-carousel
              swipeable
              animated
              v-model="slide"
              thumbnails
              infinite
            >
              <q-carousel-slide  v-for="(img , count) in propperfilmutable.imgcarrusel" v-bind:key="count"  :name="count" :img-src="img.urldocumento" />
              <!-- <q-carousel-slide :name="2" img-src="https://cdn.quasar.dev/img/parallax1.jpg" />
              <q-carousel-slide :name="3" img-src="https://cdn.quasar.dev/img/parallax2.jpg" />
              <q-carousel-slide :name="4" img-src="https://cdn.quasar.dev/img/quasar.jpg" /> -->
            </q-carousel>
          </div>
          <div v-else class="q-pa-md">
            <q-carousel
              swipeable
              animated
              v-model="slide"
              thumbnails
              infinite
            >
              <q-carousel-slide :name="1" img-src="https://cdn.quasar.dev/img/mountains.jpg" />
              <q-carousel-slide :name="2" img-src="https://cdn.quasar.dev/img/parallax1.jpg" />
              <q-carousel-slide :name="3" img-src="https://cdn.quasar.dev/img/parallax2.jpg" />
              <q-carousel-slide :name="4" img-src="https://cdn.quasar.dev/img/quasar.jpg" />
            </q-carousel>
          </div>
          <p>
            {{propperfilmutable.descripcion}}
          </p>
          <div class="row">
            <div class="col-6">
              <div class="q-pa-md">
                <q-video
                  :ratio="16/9"
                  :src="'https://www.youtube.com/embed/'+video_id+'?rel=0'"
                />
              </div>
            </div>
            <div class="col-6" style="padding: 16px;justify-content: center;display: flex;" >
              
              <div class="row" style="padding-left: 16px;">
                <q-item-section side style="align-items: center;" top>
                  <q-item-label lines = "1" >
                    <span class = "q-mt-xs text-weight-bold ">Cump</span>
                  </q-item-label >
                  <q-item-label lines = "1" >
                    <q-knob
                      v-model="propperfilmutable.cumplimiento"
                      show-value
                      size="150px"
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
                      v-model="propperfilmutable.adic"
                      show-value
                      size="150px"
                      color="teal"
                      track-color="grey-3"
                      readonly
                    />
                  </q-item-label>
                </q-item-section>
              </div>
              
            </div>
          </div>
          <!-- <div class="q-pa-md">
            <q-markup-table separator="cell">
              <thead>
                <tr>
                  <th class="text-left">Producto</th>
                  <th class="text-left">Descripcion</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(producto , count) in propperfilmutable.productos" v-bind:key="count">
                  <td class="text-left">{{producto.nombre}}</td>
                  <td class="text-left">{{producto.descripcion}}</td>
                </tr>
              </tbody>
            </q-markup-table>
          </div> -->
           <q-list bordered padding>
            <q-item-label header>Productos</q-item-label>
            <q-separator spaced />

            <div v-for="(producto , count) in propperfilmutable.productos" v-bind:key="count">
              <q-item >
                <q-item-section>
                  <!-- <q-item-label overline>OVERLINE</q-item-label> -->
                  <q-item-label>{{producto.nombre}}</q-item-label>
                  <q-item-label caption>{{producto.descripcion}}</q-item-label>
                </q-item-section>

                <q-item-section side top>
                  <q-item-label caption>5 min ago</q-item-label>
                </q-item-section>
              </q-item>
              <q-separator v-if="propperfilmutable.productos.length!=count+1" spaced />
            </div>
          </q-list>
          <!-- <p>
            {{propperfil}}
          </p> -->
          <!-- <p v-for="n in 15" :key="n">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit nihil praesentium molestias a adipisci, dolore vitae odit, quidem consequatur optio voluptates asperiores pariatur eos numquam rerum delectus commodi perferendis voluptate?
          </p> -->
        </q-page>
      </q-page-container>
    </q-layout>
  </div>
    <q-inner-loading :showing="this.$store.state.listado.cargando">
      <q-spinner-hourglass size="5.5em" color="green" />
    </q-inner-loading>
  </div>
</template>

<script>
export default {
  name: 'Perfil',
  props: {
    propperfil: {
      type: Object,
      default: null
    }
  },
  data () {
    return {
      slide: 1,
      autoplay: true,
      idEmpresa: 0,
      drawer: false,
      video_id:null,
      propperfilmutable:null
    }
  },
  created() {
    this.idEmpresa = this.$route.params.idEmpresa;
    this.propperfilmutable = this.propperfil
    console.log(this.propperfil);
    if (this.propperfil==null) {      
     this.cargarempresa(this.idEmpresa);
    }else{
      this.video_id = this.propperfilmutable.linkvideo.split('v=')[1];
      var ampersandPosition = this.video_id.indexOf('&');
      if(ampersandPosition != -1 && this.propperfilmutable.linkvideo!=null) {
        this.video_id = this.video_id.substring(0, ampersandPosition);
      }else{
        this.video_id='rfD-UKuod18'
      }
      this.propperfilmutable.cumplimiento=parseInt(this.propperfilmutable.cumplimiento)
      this.propperfilmutable.adic=parseInt(this.propperfilmutable.adic)
    }
  },
  beforeMount(){
  },
  methods: {
    async cargarempresa(idempresa){
      this.propperfilmutable = await this.buscar(idempresa);
      this.video_id = this.propperfilmutable.linkvideo.split('v=')[1];
      var ampersandPosition = this.video_id.indexOf('&');
      if(ampersandPosition != -1 && this.propperfilmutable.linkvideo!=null) {
        this.video_id = this.video_id.substring(0, ampersandPosition);
      }else{
        this.video_id='rfD-UKuod18'
      }
      this.propperfilmutable.cumplimiento=parseInt(this.propperfilmutable.cumplimiento)
      this.propperfilmutable.adic=parseInt(this.propperfilmutable.adic)
      console.log(this.propperfilmutable);
      return 
    },
    buscar(idempresa){   
      let obj = {
        buscar: idempresa,
        campo: 'e.idempresa'
      }
      return this.$store.dispatch('listado/BUSCAR_EMPRESAS',obj);
    },
    navigate() {
      // this.$router.go(-1);
       this.$router.push({path: '/'})
    }
  }
}
</script>

<style lang="sass" scoped>

</style>