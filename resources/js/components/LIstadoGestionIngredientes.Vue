<template>
    <div class="row">
        <div class="col-12 col-md-offset-2">
            <div class="row">
                <a href="#" v-on:click="crearIngrediente()" class="btn btn-primary">Crear Ingrediente</a>
            </div>
            <div class="row">

               <div class="col-sm-4"   v-for="tipoingrediente in listaingrediente"
                :key="tipoingrediente.id"
                :tipoingrediente="tipoingrediente">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ tipoingrediente.name }}</h5>
                            <a href="#" v-on:click="borrarIngrediente(tipoingrediente)" class="btn btn-danger">Borrar </a>
                        </div>
                    </div>
                </div>
            
                <div class="row" v-if="valor == 'editable'">
                     <div class="row g-9">
     <div class="col-6">
      <label class="col-form-label">Nombre </label>
     </div>
     </div>
                    <div class="row g-9">
     <div class="col-2">
      <input class="form-control"  v-model.lazy="ingredienteeditada.name">
     </div>
    <div class="col-2">

<button type="button" class="btn btn-success"v-on:click="salvaringrediente()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"></path>
</svg>
              </button>
              
        <button type="button" class="btn btn-secondary"v-on:click="eliminaringrediente()">
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
        this.getingrediente();
    },
    data(){
        return {
           listaingrediente:[],
           ingredienteeditada:[{
               name: '',
            }],
           valor: 'noeditable',
           creacion: 'no',
        }
    },
    methods: {
        getingrediente:  function(){
        var urllistarpizza  = 'controlingredientes';
            axios.get(urllistarpizza).then(response =>{
                this.listaingrediente = response.data
            });
        },
        editarIngrediente: function (tipopizza){
            
            let elemento = {
                id: tipopizza.id,
                name: tipopizza.name,
            };
            this.pizzaeditada = elemento;
            this.valor = 'editable';
            return '';
        },
        salvaringrediente: function(){
      
            if(this.creacion == 'si'){
                let valores = {
                    name: this.ingredienteeditada.name,
                };
                axios.post('controlingredientes', valores
                     ).then((response) => {
                             console.log (response);
                              let nuevapizza  = {
                                    id: response.data.id,
                                    name: response.data.name,
                                    }
                                    this.listaingrediente.push(nuevapizza);
                         });

            }else{

            let valores = {
                    name: this.ingredienteeditada.name,
                };
                axios.put('controlingredientes/'+this.ingredienteeditada.id, valores
                     ).then((response) => {
                             console.log (response);
                              let nuevapizza  = {
                                    id: response.data.id,
                                    name: response.data.name,
                                    }
                                    this.ingredientepizzas.forEach(element => {
                                        if(element.id === nuevapizza.id){
                                            element.name = nuevapizza.name;
                                        }
                                    });
                                    
                         });
            } 
            this.ingredienteeditada.name='';
            this.valor = 'noeditable';
            this.creacion = 'no';
            return '';
        },
        eliminaringrediente: function(){
            this.valor = 'noeditable';
            this.pizzaeditada.name='';
            this.creacion = 'no';
            return '';
        },
        crearIngrediente: function () {
            this.valor = 'editable';
            this.creacion = 'si';
                  
            return '';
        },
        borrarIngrediente: function(pizza){
            
            axios.delete('controlingredientes/'+ pizza.id,'').then((response) => {
                this.listaingrediente.filter((value, index) => {
                     if(value.id == pizza.id) {
                         this.listaingrediente.splice(index,1);
                     }
                });
            });
        },   
    },
}
</script>
