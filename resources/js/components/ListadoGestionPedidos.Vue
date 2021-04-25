<template>
    
<table class="table">
  <thead>
    <tr>
      <th scope="col">Ticket</th>
      <th scope="col">Cliente</th>
      <th scope="col">Pizza</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Creado</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="tipopedido in listaingrediente"
                :key="tipopedido.id">
      <th scope="row">{{ tipopedido.id }}</th>
      <td>{{ tipopedido.name }}</td>
      <td>{{ tipopedido.cantidad }}</td>
      <td>{{ tipopedido.create_at }}</td>
    </tr>
  </tbody>
</table>
</template>
<script>
export default {
    data(){
        return {
           listapedidos:[],
        }
    },
    created: function(){
        this.getpedidos();
    },
      methods: {
        getpedidos:  function(){
            var urllistarpizza  = 'controlpedidos ';
            axios.get(urllistarpizza).then(response =>{
                this.listapedidos = response.data
            });
        },
      }
}
</script>