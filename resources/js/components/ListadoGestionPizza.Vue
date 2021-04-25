<template>
<div class="row">
    <div class="col-12 col-md-offset-2">
        <div class="row">
            <a href="#" v-on:click="crearPizza()" class="btn btn-primary">CrearPizza</a>
        </div>
        <div class="row">
            <div class="col-sm-4"   v-for="tipopizza in listapizzas"
                :key="tipopizza.id"
                :tipopizza="tipopizza">
                <div class="card">
                    <img v-bind:src="tipopizza.simagen" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ tipopizza.name }}</h5>
                        <p class="card-text">{{ tipopizza.ingredientes }}
                            <span class="badge bg-light text-dark">{{ tipopizza.precio }} Euros</span>
                        </p>        
                        <a href="#" v-on:click="editarPizza(tipopizza)" class="btn btn-primary">Editar </a>
                        <a href="#" v-on:click="borrarPizza(tipopizza)" class="btn btn-danger">Borrar </a>
                    </div>
                </div>
            </div>
            <div class="row" v-if="valor == 'editable'">
                <div class="row g-9">
                    <div class="col-6">
                        <label class="col-form-label">Nombre </label>
                    </div>
                    <div class="col-4">
                        <label  class="col-form-label" >Precio</label>
                    </div>
                    <div class="col-2">
                        <label  class="col-form-label" > Ingredientes</label>
                    </div>
                </div>
                <div class="row g-9">
                    <div class="col-2">
                        <input class="form-control"  v-model.lazy="pizzaeditada.name">
                    </div>
                    <div class="col-2">
                        <input type="hidden" v-bind:id="pizzaeditada.id">
                        <input type="text"  class="form-control" id="cantidad"  v-model.lazy="pizzaeditada.precio" >
                    </div>
                    <div class="col-6">
                        <input type="text"  class="form-control" v-model.lazy="pizzaeditada.ingredientes">  
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success"v-on:click="salvarpizza()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"></path>
                            </svg>
                        </button>
                        <button type="button" class="btn btn-secondary"v-on:click="eliminarpizza()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
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
           listapizzas:[],
           pizzaeditada:[{
               name: '',
               ingredientes: '',
               precio:'',
           }],
           valor: 'noeditable',
           creacion: 'no',
        }
    },
    methods: {
        getpizzas:  function(){
            var urllistarpizza  = 'listarpizza';
            axios.get(urllistarpizza).then(response =>{
                this.listapizzas = response.data
            });
        },
        editarPizza: function (tipopizza){
            
            let elemento = {
                id: tipopizza.id,
                name: tipopizza.name,
                precio: tipopizza.precio,
                ingredientes: tipopizza.ingredientes,
            };
            this.pizzaeditada = elemento;
            this.valor = 'editable';
            return '';
        },
        salvarpizza: function(){
      
            if(this.creacion == 'si'){
                let valores = {
                    name: this.pizzaeditada.name,
                    precio: this.pizzaeditada.precio,
                    imagen: '-',
                    ingredientes: this.pizzaeditada.ingredientes,
                };
                axios.post('controlpizzas', valores
                     ).then((response) => {
                             console.log (response);
                              let nuevapizza  = {
                                    id: response.data.id,
                                    name: response.data.name,
                                    imagen: response.data.imagen,
                                    ingredientes: response.data.ingredientes,
                                    precio: response.data.precio,
                                    }
                                    this.listapizzas.push(nuevapizza);
                         });

            }else{

            let valores = {
                    name: this.pizzaeditada.name,
                    precio: this.pizzaeditada.precio,
                    imagen: '-',
                    ingredientes: this.pizzaeditada.ingredientes,
                };
                axios.put('controlpizzas/'+this.pizzaeditada.id, valores
                     ).then((response) => {
                             console.log (response);
                              let nuevapizza  = {
                                    id: response.data.id,
                                    name: response.data.name,
                                    imagen: response.data.imagen,
                                    ingredientes: response.data.ingredientes,
                                    precio: response.data.precio,
                                    }
                                    this.listapizzas.forEach(element => {
                                        if(element.id === nuevapizza.id){
                                            element.name = nuevapizza.name;
                                            element.imagen = nuevapizza.imagen;
                                            element.ingredientes = nuevapizza.ingredientes;
                                            element.precio = nuevapizza.precio;
                                        }
                                    });
                                    
                         });
            } 
            this.pizzaeditada.name='';
            this.pizzaeditada.precio='';
            this.pizzaeditada.ingredientes='';
            this.valor = 'noeditable';
            this.creacion = 'no';
            return '';
        },
        eliminarpizza: function(){
            this.valor = 'noeditable';
            this.pizzaeditada.name='';
            this.pizzaeditada.precio='';
            this.pizzaeditada.ingredientes='';
            this.creacion = 'no';
            return '';
        },
        crearPizza: function () {
            this.valor = 'editable';
            this.creacion = 'si';
                  
            return '';
        },
        borrarPizza: function(pizza){
            
            axios.delete('controlpizzas/'+ pizza.id,'').then((response) => {
                this.listapizzas.filter((value, index) => {
                     if(value.id == pizza.id) {
                         this.listapizzas.splice(index,1);
                     }
                });
            });
        },   
    },
}
</script>
