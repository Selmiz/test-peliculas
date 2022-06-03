<template>
    <div class="row">
        <div class="col-2">
            <Menu></Menu>
        </div>
        <div class="col contenido">
            <div class="row">
                <div class="col-9">
                    <h2>Películas</h2>
                </div>
                <div class="col-3 d-flex flex-row-end">
                    <button @click="agregar()" type="button" class="btn btn-light nuevapeli"><i class="bi bi-plus-square" ></i> Nueva Película</button>
                </div>
            </div>
            <div v-if="success" class="alert alert-success" role="alert">
            {{ msg }}
            </div>
                <br>
                <div class="pelicus mt-3">
                <table class="table table-hover table-bordered table-sm" >
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>F. Publicación</th>
                            <th style="text-align:center;">Estado</th>
                            <th style="text-align:center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="pelicula in peliculas">
                            <td>{{ pelicula.id }}</td>
                            <td>{{ pelicula.nombre }}</td>
                            <td>{{ pelicula.fecha_publicacion }}</td>
                            <td v-if="pelicula.estado == true" style="text-align:center;">Activo</td>
                            <td v-if="pelicula.estado == false" style="text-align:center;">Inactivo</td>
                            <td style="text-align: center;">
                                <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" @click="editar(pelicula.id)" class="btn"><i class="bi bi-pencil-square"></i></button>
                                    <button type="button" @click="asignar(pelicula.id)" class="btn"><i class="bi bi-list"></i></button>
                                    <button type="button" @click="cambiaestado(pelicula.id)" class="btn">
                                        <i v-if="pelicula.estado == true" class="bi bi-lock-fill"></i> 
                                        <i v-else class="bi bi-unlock-fill"></i>
                                    </button>
                                    <button type="button" @click="eliminar(pelicula.id)" class="btn"><i class="bi bi-trash3"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>      
</template>

<script>
import axios from 'axios';
import Menu from '@/components/Menu.vue';
export default {
    data(){
        return{
            peliculas:[],
            success:false,
            msg:''
        }
    },
    components: {
        Menu
    },
    created: function(){

        this.getPeliculas();
        this.validaUsuario();
    },
    methods: {
        agregar(){
            this.$router.push('/agregar-pelicula');
        },
       async  getPeliculas(){
           this.success=false;
           this.msg = '';
           let headers = {
               'Accept': 'application/json',
               'Authorization': 'Bearer ' +  localStorage.getItem('token')
           }
            await axios.get('/api/peliculas', { headers }).then( respuesta =>{
                this.peliculas= respuesta.data.peliculas;
            })
        },
        editar(id){
           // console.log('edita', id);
            this.$router.push({ name:'editar-pelicula', params: { id: id } });
        },
        asignar(id){
            this.$router.push({ name:'asignar-turno', params: { id: id } });
        },
        cambiaestado(id){

            axios.get('/api/peliculas/estado/' + id).then( respuesta =>{            
                this.success = respuesta.data.success;
                this.msg = respuesta.data.msg;
                console.log('estado', this.success);
                 this.getPeliculas();
            })
        },
        eliminar(id){
            
            axios.delete('/api/peliculas/' + id ).then(respuesta =>{
               
                this.success = respuesta.data.success;
                this.msg = respuesta.data.msg;
                 this.getPeliculas();
            })
        },
        validaUsuario(){
          this.user = localStorage.getItem('log');          
          console.log('peli',this.user);
          if (this.user == 0) {
               this.$router.push('/home');
          }
        }
    }
}
</script>

<style>

table{
    width: 100%;
}
.nuevapeli{
    background-color: lightblue;
}
.contenido{
    margin-top: 10px;
}
.pelicus{
    width: 90%;
}

</style>