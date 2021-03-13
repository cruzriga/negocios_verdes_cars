<template>
  <div id="app-site-container">
    <FormularioNegocios v-bind:propformulario="datos"/>
  </div>
</template>

<script>
// import CamposForm from 'components/CamposForm'
import FormularioNegocios from './components/FormularioNegocios'

export default {
  name: 'FormSite',
  components: { FormularioNegocios },
  data () {
    return {
      datos: {
        nombreempresa: 'test',
        descripcion: 'test',
        email: 'test',
        telefono: 'test',
        linkvideo: 'test',
        imagenlogo: 'test',
        categoria:  { idcategoria: "2", nombre: "ECOPRODUCTOS INDUSTRIALES" },
        subcategoria: { idsubcategoria: "6", nombre: "Negocios para la restauración", idcategoria: "2" },
        tiposubcategoria: { idtiposubcategoria: "6", nombre: "Geotérmica", idsubcategoria: "1" },
      }
    }
  }
}
</script>
