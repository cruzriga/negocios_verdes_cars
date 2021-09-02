<template>
    <!-- <div class="search-wrapper">
    </div> -->
	<div class="q-gutter-lg" style="min-height: calc(100vh - 172px)">
		<q-item-label  header>
			<q-toolbar class="text-primary" style="height: 50px">
				<q-input @keyup.enter="buscar"  v-model="search" placeholder="Buscar" color="teal" >
				<template v-slot:prepend>
					<q-icon v-if="search === ''" name="search" />
					<q-icon v-else name="clear" class="cursor-pointer" @click="search = ''" />
				</template>
				</q-input>
				<q-space/>
				<div>
					<span class="q-mr-md text-teal text-body2">
					{{this.$store.state.listado.ListaEmpresas.data.pagina+1}} - {{this.$store.state.listado.ListaEmpresas.data.total}}
					</span> <q-btn @click="backPage(-1)" flat round dense icon="arrow_back_ios"  color="teal"/> <q-btn @click="nextPage(1)" flat round dense icon="arrow_forward_ios" color="teal" />
				</div>
			</q-toolbar>
		</q-item-label>
		<template v-if = "items.length > 0">
		<div class="row items-center justify-center">
			<Card
			v-for="(value, index) in this.$store.state.listado.ListaEmpresas.data.empresas"
			v-bind:key="index"
			v-bind:prop="value"/>
		<!-- {{this.$store.state.listado.ListaEmpresas.data}} -->
		</div>
		</template>
	</div>

</template>

<script>
import Card from '../components/Card'
export default {
  name: 'ListaEmpresas',
  components: { Card },
  data(){
    return {
      items : [1],
      pagina:0,
      numlist: 50,
      search:''
    }
  }, 
  beforeMount() {
    this.AXIO_GET_EMPRESAS();
  },     
  methods: {
    buscar(){

      let obj = {
        buscar: this.search,
        campo: 'e.nombreempresa'
      }
      this.$store.dispatch('listado/BUSCAR_EMPRESAS',obj);
    },
    AXIO_GET_EMPRESAS() {
      let obj = {
        pagina: this.pagina,
        numlist: this.numlist
      }
      this.$store.dispatch('listado/CARGAR_EMPRESAS',obj);
    },
    backPage(n){
      let actual = this.$store.state.admin.empresas.data.pagina+1
      if(actual!=1){
        let obj = {
          pagina: this.$store.state.admin.empresas.data.pagina+n,
          numlist: this.$store.state.admin.empresas.data.numList
        }
        this.$store.dispatch('listado/CARGAR_EMPRESAS',obj);
      }
    },
    nextPage(n){
      let actual = this.$store.state.admin.empresas.data.pagina+1
      let total = this.$store.state.admin.empresas.data.total
      if(actual!=total){
        let obj = {
          pagina: this.$store.state.admin.empresas.data.pagina+n,
          numlist: this.$store.state.admin.empresas.data.numList
        }
        this.$store.dispatch('listado/CARGAR_EMPRESAS',obj);
      }
    },
    navigate() {
      this.$router.go(-1);
    }
  }

}
</script>

<style scoped>

</style>