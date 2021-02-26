<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 col-xs-12">
        <h2>Listas de Datos de Personas</h2>
        <table class="table text-center table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">Documento</th>
              <th scope="col">Nombre</th>
              <th scope="col">Apellido</th>
              <th scope="col">Edad</th>
              <th scope="col">Genero</th>
              <th scope="col">Telefono</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="persona in arrayPersona" :key="persona.id">
              <td v-text="persona.documento"></td>
              <td v-text="persona.nombre"></td>
              <td v-text="persona.apellido"></td>
              <td v-text="persona.edad"></td>
              <td v-text="persona.telefono"></td>
              <td v-text="persona.genero"></td>
              <td>
                <button class="btn btn-primary" @click="loadUpdate(persona)">Editar
                </button>
                <button class="btn btn-danger" @click="deletePersona(persona)">Eliminar
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-6 col-xs-12">
        <h2>Formulario Datos de Personas</h2>
        <div class="form-group">
          <label>Documento</label>
          <input v-model="documento" type="number" max="10" min="1" class="form-control"/>
          <label>Nombre</label>
          <input v-model="nombre" type="text" class="form-control" />
          <label>Apellido</label>
          <input v-model="apellido" type="text" class="form-control" />
          <label>Edad</label>
          <input v-model="edad" type="number" min="1" class="form-control" />
          <label>Telefono</label>
          <input v-model="telefono" max="10" type="number" class="form-control"/>
          <label>Genero</label>
          <select v-model="genero" class="form-control">
            <option selected>Seleccione un Genero</option>
            <option>Masculino</option>
            <option>Femenino</option>
          </select>
        </div>
        <div class="container-buttons">
          <button v-if="update == 0" @click="savePersona()" class="btn btn-success">Agregar</button>
          <button v-if="update != 0" @click="updatePersona()" class="btn btn-warning">Actualizar</button>
          <button v-if="update != 0" @click="clear()" class="btn">Atrás</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data(){
            return{
                documento:"",
                nombre:"", 
                apellido:"", 
                edad:"",
                telefono:"",
                genero:"", 
                update:0, 
                arrayPersona:[], 
            }
        },
        methods:{
            getPersona(){
                let datos =this;
                let url = '/persona' 
                axios.get(url).then(function (response) {
                    datos.arrayPersona = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            savePersona(){
                let datos =this;
                let url = '/persona/guardar'
                axios.post(url,{ 
                    'documento':this.documento,
                    'nombre':this.nombre,
                    'apellido':this.apellido,
                    'edad':this.edad,
                    'telefono':this.telefono,
                    'genero':this.genero,
                }).then(function (response) {
                    datos.getPersona();
                    datos.clear();
                })
                .catch(function (error) {
                    console.log(error);
                });   

            },
            updatePersona(){
                let datos = this;
                axios.put('/persona/actualizar',{
                    'id':this.update,
                    'documento':this.documento,
                    'nombre':this.nombre,
                    'apellido':this.apellido,
                    'edad':this.edad,
                    'telefono':this.telefono,
                    'genero':this.genero,
                }).then(function (response) {
                   datos.getPersona();
                   datos.clear();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadUpdate(data){ 
                this.update = data.id
                let datos =this;
                let url = '/persona/buscar?id='+this.update;
                axios.get(url).then(function (response) {
                    datos.documento=response.data.documento;
                    datos.nombre= response.data.nombre;
                    datos.apellido=response.data.apellido;
                    datos.edad=response.data.edad;
                    datos.telefono=response.data.telefono;
                    datos.genero=response.data.genero; 
                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            deletePersona(data){
                let datos =this;
                let persona_id = data.id
                if (confirm('¿Seguro que deseas eliminar esta Persona?')) {
                    axios.delete('/persona/borrar/'+persona_id
                    ).then(function (response) {
                        datos.getPersona();
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
                }
            },
            clear(){
                this.documento="";
                this.nombre= "";
                this.apellido="";
                this.edad="";
                this.telefono="";
                this.genero="";
                this.update = 0;
            }
        },
        mounted() {
           this.getPersona();
        }
}
</script>