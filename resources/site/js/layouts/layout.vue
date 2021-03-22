<template>
  <div id="app-site-container">
    <q-layout view="hHh lpR fFf"  container>

      <q-header elevated class="bg-white text-grey">
        <q-toolbar>
          <q-toolbar-title>

          </q-toolbar-title>
          <q-tabs>
            <q-route-tab to="/" icon="eco" name="Negocios" label="Lista" />
            <q-route-tab to="/registrar" icon="assignment_ind" name="Categorias" label="Inscribete" />
          </q-tabs>
        </q-toolbar>


      </q-header>

      <q-page-container style="height: calc(100vh - 100px); overflow-y: auto">
        <q-page style="padding: 20px">
          <slot></slot>
        </q-page>
      </q-page-container>

    </q-layout>
  </div>
</template>

<script>
export default {
  data(){
      return {
        tab: 'Negocios',
        menuList : [
          {
            icon: 'inbox',
            label: 'Negocios Verdes',
            separator: true
          },
          {
            icon: 'send',
            label: 'Categorias',
            separator: false
          }
        ]
      }
  }
}
</script>

<style scoped>
  #app-admin-container, .full-main {
    height: calc(100vh - 150px);
    overflow: hidden;
  }

</style>
