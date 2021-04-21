<template>
   <div class="card" style="width: 18rem;">
     <img v-bind:src="tipopizza.simagen" class="card-img-top" alt="...">
        <div class="card-body">
        <h5 class="card-title">{{ tipopizza.name }}</h5>
        <p class="card-text">{{ tipopizza.ingredientes }}</p>
        <a href="#" v-on:click="sumarpedido(tipopizza.id,tipopizza.name)" class="btn btn-primary">Pedir {{ tipopizza.id }} </a>
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
            sumarpedido(idpizza,name){

            let tipopizza = {
                id: idpizza,
                name: name,
            };
            this.$emit('new',tipopizza);
            }
        },
    }
</script>
