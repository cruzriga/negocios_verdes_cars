<template>
  <div id="app-admin-container">
    <q-layout view="hHh lpR fFf"  container>

      <q-header elevated class="bg-white text-grey">
        <q-toolbar>
          <q-toolbar-title>
            Negocios verdes Corpoguajira
          </q-toolbar-title>
          <q-tabs>
            <q-route-tab to="/" icon="eco" name="Negocios" label="Negocios" />
            <q-route-tab to="/categorias" icon="list" name="Categorias" label="Categorias" />
            <q-route-tab to="/archivos" icon="attach_file" name="Archivos" label="Archivos" />
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
