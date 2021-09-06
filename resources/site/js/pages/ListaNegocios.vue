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

        <!-- Filtro de Categorías -->
        <q-select v-model="categoriaSeleccionada" @input="AXIO_GET_EMPRESAS" :options="categorias"  label="Filtrar por categorías" style="min-width: 350px; max-width:600px;" class="q-pl-lg text-primary" color="teal">
          <template v-slot:no-option>
            <q-item>
              <q-item-section class="text-grey">Seleccione un filtro </q-item-section>
            </q-item>
          </template>
          <template v-slot:append v-if="categoriaSeleccionada.value != null">
            <q-icon name="cancel" @click.stop="categoriaSeleccionada = {
              label: 'Seleccionar categoría',
              value: null,
            }" class="cursor-pointer" />
          </template>
        </q-select>
        <!-- /Filtro de Categorías -->

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
import {mapGetters} from "vuex";
import Card from '../components/Card'
export default {
  name: 'ListaEmpresas',
  components: { Card },
  data(){
    return {
      items : [1],
      pagina:0,
      numlist: 50,
      search:'',
      categoriaSeleccionada: {
        label: 'Seleccionar categoría',
        value: null,
      },
    }
  }, 
  beforeMount() {
    this.AXIO_GET_EMPRESAS();
  },
  computed: {
    categorias() {
      return this.$store.state.listado.ListaEmpresas.data.categorias.map((c) => {
                  return { value: c.idcategoria, label: c.nombre }
              });
    }
  },    
  methods: {
    buscar(){

      let obj = {
        buscar: this.search,
        campo: 'e.nombreempresa'
      }
      this.$store.dispatch('listado/BUSCAR_EMPRESAS',obj);
    },
    async AXIO_GET_EMPRESAS() {
      console.log('Categoria seleccionada: ', this.categoriaSeleccionada.value)
      let obj = {
        pagina: this.pagina,
        numlist: this.numlist,
        categoria: this.categoriaSeleccionada.value
      }
      await this.$store.dispatch('listado/CARGAR_EMPRESAS',obj);
    },
    backPage(n){
      let actual = this.$store.state.admin.empresas.data.pagina+1;
      if(actual!=1){
        let obj = {
          pagina: this.$store.state.admin.empresas.data.pagina+n,
          numlist: this.$store.state.admin.empresas.data.numList,
          categoria: this.categoriaSeleccionada.value
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
          numlist: this.$store.state.admin.empresas.data.numList,
          categoria: this.categoriaSeleccionada.value
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