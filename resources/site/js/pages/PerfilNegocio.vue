<template>
<div class="q-pa-md">
    <q-layout view="lHh Lpr lff" container style="height: calc(100vh - 200px);" class="shadow-2 rounded-borders">
      <q-header class="bg-white text-primary">
        <q-toolbar>
          <q-toolbar-title size="20px" class="text-center">{{propperfil.nombreempresa}}</q-toolbar-title>
          <!-- <q-btn flat @click="drawer = !drawer" round dense icon="menu" /> -->
          <q-icon  style="font-size: 3em;" v-on:click="navigate()" name="arrow_back" />
          <!-- <q-btn style="margin-left: 15px;" v-on:click="navigate()" size="15px" class="q-px-xl q-py-xs" color="primary" label="Atras" /> -->
        </q-toolbar>
      </q-header>

      <q-drawer
        v-model="drawer"
        show-if-above
        :width="250"
        :breakpoint="400"
      >
        <q-scroll-area style="height: calc(100% - 250px); margin-top: 250px; border-right: 1px solid #ddd">
          <q-list padding>
            <div class="column perfilempresa">
              <div class="col">                
                <q-item>
                  <q-item-section class="icono" avatar>
                    <q-icon name="face" />
                  </q-item-section>
                  <q-item-section class="titulo">Representante Legal</q-item-section>
                </q-item>               
              </div>
              <div class="col">
                <p>{{propperfil.representantelegal}}</p>
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
              <div class="col"><p>{{propperfil.telefono}}</p></div>
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
              <div class="col"><p>{{propperfil.municipio}}</p></div>
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
              <div class="col"><p>{{propperfil.direccion}}</p></div>
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
              <div class="col"><p>{{propperfil.email}}</p></div>
            </div>
            <div class="row perfilempresa">
              <div class="col" style="display: flex;justify-content: center;align-items: center;"><q-icon style="font-size: 2em;" name="img:./../media/iconssvg/gorjeo.svg" /></div>
              <div class="col" style="display: flex;justify-content: center;align-items: center;"><q-icon style="font-size: 2em;" name="img:./../media/iconssvg/facebook.svg" /></div>
              <div class="col" style="display: flex;justify-content: center;align-items: center;"><q-icon style="font-size: 2em;" name="img:./../media/iconssvg/instagram.svg" /></div>
              <div class="col" style="display: flex;justify-content: center;align-items: center;"><q-icon style="font-size: 2em;" name="img:./../media/iconssvg/youtube.svg" /></div>
            </div>
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
            :src="propperfil.imagenlogo"
            :ratio="1"
          />
      </q-drawer>

      <q-page-container>
        <q-page padding>
          <p>
            {{propperfil.descripcion}}
          </p>
          <div class="q-pa-md">
            <q-markup-table separator="cell">
              <thead>
                <tr>
                  <th class="text-left">Producto</th>
                  <th class="text-left">Descripcion</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(producto , count) in propperfil.productos" v-bind:key="count">
                  <td class="text-left">{{producto.nombre}}</td>
                  <td class="text-left">{{producto.descripcion}}</td>
                </tr>
              </tbody>
            </q-markup-table>
          </div>
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
</template>

<script>
export default {
  name: 'Perfil',
  props: {
    propperfil: {
      type: Object
    }
  },
  data () {
    return {
      idEmpresa: 0,
      drawer: false
    }
  },
  created() {
    this.idEmpresa = this.$route.params.idEmpresa;
    console.log(this.propperfil);
  },
  methods: {
    navigate() {
      this.$router.go(-1);
    }
  }
}
</script>

<style lang="sass" scoped>

</style>