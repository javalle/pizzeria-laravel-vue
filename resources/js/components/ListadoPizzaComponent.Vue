<template>
    <div class="row">
        <div class="col-8 col-md-offset-2">
            <div class="row">
                <pizza-component 
                v-for="tipopizza in listapizzas"
                :key="tipopizza.id"
                :tipopizza="tipopizza"
                @new="addpizza">
                </pizza-component>
            </div>

            <form v-on:submit.prevent="confirmarpedido()">
                <h2>Lista de Pedido</h2>
                <div class="row g-5">
     <div class="col-2">
      <label  class="col-form-label">PIzza</label>
     </div>
    <div class="col-2">
      <label  class="col-form-label">Unidades</label>
    </div>
    <div class="col-2">
      <label  class="col-form-label">PVP Unidad</label>  
    </div>
    <div class="col-2">
      <label class="col-form-label">Total</label>
    </div>
    <div class="col-2">
    </div>
  </div>
                <pedido-componente v-for="(lineapedido, index) in pedidopizza"
                    :key="lineapedido.id" 
                    :lineapedido="lineapedido"
                    @delete="eliminarlinea(index)"
                    @totalprecio='totalprecio=$event'>
                </pedido-componente>
                                <div class="row g-5">
     <div class="col-2">
      
     </div>
    <div class="col-4">
        <label class="col-form-label"><b>Total del pedido:</b></label>
    </div>
    <div class="col-2">
      <label class="col-form-label"> {{totalprecio | moneda}}</label>
    </div>
    <div class="col-2">
    </div>
  </div>
                <button type="submit"  class="btn btn-primary">Confirmar Pedido</button>
            </form>  
        </div>
    </div>
</template>

<script>
export default {
    created: function(){
        this.getpizzas();
    },
    data(){
        return {
            totalprecio:'',
            listapizzas:[],
            pedidopizza:[],
        }
    },
    nounted(){
        console.log('Component listadopieza mounted.')
    },
    methods: {
        addpizza(tipopizza){
            let elemento = {
                id: tipopizza.id,
                name: tipopizza.name,
                cantidad: 1,
                precio: tipopizza.precio,
                };
            this.pedidopizza.push(elemento);
       },
        confirmarpedido(){
            var urllistarpizza  = 'controlpedidos';
            axios.post(urllistarpizza,this.pedidopizza).then(response =>{
                this.pedidopizza = [];
                  alert('Pedido Confirmado');
            });
          
          },  
        eliminarlinea(index){
                    this.pedidopizza.splice(index,1);
         
        },
        getpizzas:  function(){
            var urllistarpizza  = 'listarpizza';
            axios.get(urllistarpizza).then(response =>{
                this.listapizzas = response.data
            });
        },
    },

    }
</script>
