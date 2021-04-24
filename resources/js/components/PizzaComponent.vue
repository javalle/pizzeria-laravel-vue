<template>
    <div class="col-sm-4">
   <div class="card">
     <img v-bind:src="tipopizza.simagen" class="card-img-top" alt="...">
        <div class="card-body">
        <h5 class="card-title">{{ tipopizza.name }}</h5>
        <p class="card-text">{{ tipopizza.ingredientes }}
            <span class="badge bg-light text-dark">{{ tipopizza.precio }} Euros</span>
        </p>        
        <a href="#" v-on:click="sumarpedido(tipopizza.id,tipopizza.name,tipopizza.precio)" class="btn btn-primary">Pedir {{ tipopizza.id }} </a>
    </div>
  </div>
  </div>
</template> 

<script>
    export default {
        props: ['tipopizza'],
        data(){
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            sumarpedido(idpizza,name,precio){

            let tipopizza = {
                id: idpizza,
                name: name,
                precio: precio,
            };
            this.$emit('new',tipopizza);
            }
        },
    }
</script>
