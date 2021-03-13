<template>
  <FormularioNegocios v-bind:propformulario="datos"/>
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
        nombre: 'test',
        descripcion: 'test',
        email: 'test',
        tel: 'test',
        linkvideo: 'test',
        imagenlogo: 'test',
        categoria: 'test',
        subcategoria: 'test',
        tiposubcategoria: 'test'
      }
    }
  }
}
</script>
