<template>
    <div class="container container-task">
        <div class="row">
            <div class="col-md-6">
                <h2>Datos de Personas</h2>
                <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Edad</th>
                                <th scope="col">Genero</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="datos in arrayDatos" :key="datos.id">
                                <td v-text="datos.nombre"></td>
                                <td v-text="datos.apellido"></td>
                                <td v-text="datos.edad"></td>
                                <td v-text="datos.genero"></td>
                                <td>
                                    <button class="btn btn-primary" @click="UpdateDatos(datos)">Editar</button> 
                                    <button class="btn btn-danger" @click="deleteDatos(datos)">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="col-md-6">
                  <h2>Lista de Personas</h2>
                <div class="form-group">
                    <label>Nombre</label>
                    <input v-model="nombre" type="text" class="form-control">
                    <label>Apellido</label>
                    <input v-model="apellido" type="text" class="form-control">
                    <label>Edad</label>
                    <input v-model="edad" type="number" class="form-control">
                    <label>Genero</label>
                    <select v-model="genero" class="form-control">
                        <option>Seleccione un Genero</option>
                        <option>Masculino</option>
                        <option>Femenino</option>
                    </select>
                </div>
                <div class="container-buttons">
                    <button v-if="update == 0" @click="saveDatos()" class="btn btn-success">Agregar</button>
                    <button v-if="update != 0" @click="updateDatos()" class="btn btn-warning">Actualizar</button>
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
                nombre:"",
                apellido:"", 
                edad:"",
                genero:"", 
                update:0, 
                arrayDatos:[], 
            }
        },
        methods:{
            getDatos(){
                let me =this;
                let url = '/persona' 
                axios.get(url).then(function (response) {
                    me.arrayDatos = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            saveDatos(){
                let me =this;
                let url = '/persona/guardar' 
                axios.post(url,{ 
                    'nombre':this.nombre,
                    'apellido':this.apellido,
                    'edad':this.edad,
                    'genero':this.genero,
                }).then(function (response) {
                    me.getDatos();
                    me.clear();
                })
                .catch(function (error) {
                    console.log(error);
                });   

            },
            updateDatos(){
                let me = this;
                axios.put('/persona/actualizar',{
                    'id':this.update,
                    'nombre':this.nombre,
                    'apellido':this.apellido,
                    'edad':this.edad,
                    'genero':this.genero,
                }).then(function (response) {
                   me.getDatos();
                   me.clear();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            UpdateDatos(data){ 
                this.update = data.id
                let me =this;
                let url = '/persona/buscar?id='+this.update;
                axios.get(url).then(function (response) {
                    me.nombre= response.data.nombre;
                    me.apellido= response.data.apellido;
                    me.edad= response.data.edad;
                    me.genero=response.data.genero;

                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            deleteDatos(data){
                let me =this;
                let task_id = data.id
                if (confirm('¿Seguro que deseas borrar esta Prueba?')) {
                    axios.delete('/persona/borrar/'+task_id
                    ).then(function (response) {
                        me.getPrueba();
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
                }
            },
            clear(){
                this.nombre = "";
                this.apellido = "";
                this.edad = "";
                this.genero="";
                this.update = 0;
            }
        },
        mounted() {
           this.getDatos();
        }
    }
</script>
