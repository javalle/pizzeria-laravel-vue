<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <pizza-component 
                v-for="tipopizza in listapizzas"
                :key="tipopizza.id"
                :tipopizza="tipopizza"
                @new="addpizza">
            </pizza-component>
            <form v-on:submit.prevent="confirmarpedido()">
                <h2>Lista de Pedido</h2>
                <pedido-componente v-for="lineapedido in pedidopizza"
                    :key="lineapedido.id" 
                    :lineapedido="lineapedido"
                    @new="eliminarlinea">
                </pedido-componente>
                <button type="submit"  class="btn btn-primary">Confirmar Pedido234</button>
            </form>  
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            listapizzas:[{
                'id':  1,
                'name': 'Peperoni',
                'imagen': '',
                'ingredientes': 'queso, tomate, atun, peperoni'
            }],
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
                cantidad: 1
                };
            this.pedidopizza.push(elemento);
       },
        confirmarpedido(){
            alert('Confirmar pedido')
          },  
        eliminarlinea(id){
            for( var i=0; i< this.pedidopizza.length;i++){
                var elemento = this.pedidopizza[i];
                if(elemento.id == id){
                    this.pedidopizza.splice(i,1);
                }
            }
        }
        
    },
    }
</script>
