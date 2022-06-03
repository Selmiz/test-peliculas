<template>
    <div class="row">
        <div class="col-2">
            <Menu></Menu>
        </div>
        <div class="col contenido">
            <div class="row">
                <div class="col-9">
                    <h2>Turnos</h2>
                </div>
                <div class="col-3 d-flex flex-row-end">
                    <button @click="agregar()" type="button" class="btn btn-light nuevapeli"><i class="bi bi-plus-square" ></i> Nuevo Turno</button>
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
                            <th>Turno</th>
                            <th style="text-align:center;">Estado</th>
                            <th style="text-align:center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="turno in turnos">
                            <td>{{ turno.id }} </td>
                            <td>{{ turno.turno }} </td>
                            <td v-if="turno.estado == true" style="text-align:center;">Activo</td>
                            <td v-if="turno.estado == false" style="text-align:center;">Inactivo</td>
                            <td style="text-align: center;">
                                <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" @click="editar(turno.id)" class="btn"><i class="bi bi-pencil-square"></i></button>
                                    <button type="button" @click="cambiaestado(turno.id)" class="btn">
                                        <i v-if="turno.estado == true" class="bi bi-lock-fill"></i> 
                                        <i v-else class="bi bi-unlock-fill"></i>
                                    </button>
                                    <button type="button" @click="eliminar(turno.id)" class="btn"><i class="bi bi-trash3"></i></button>
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
            turnos:[],
            success:false,
            msg:''
        }
    },
    components: {
        Menu
    },
    created: function(){

        this.getTurnos();
    },
    methods: {
        agregar(){
            this.$router.push('/agregar-turno');
        },
        async  getTurnos(){

            let headers = {
               'Accept': 'application/json',
               'Authorization': 'Bearer ' +  localStorage.getItem('token')
            }

           this.success=false;
           this.msg = '';
            await axios.get('/api/turnos', {headers} ).then( respuesta =>{
                 this.turnos= respuesta.data.turnos; 
                console.log(respuesta.data.turnos);
            })
        },
        editar(id){
           // console.log('edita', id);
            this.$router.push({ name:'editar-turno', params: { id: id } });
        },
        asignar(id){
            this.$router.push({ name:'asignar-turno', params: { id: id } });
        },
        cambiaestado(id){

            axios.get('/api/turnos/estado/' + id).then( respuesta =>{            
                this.success = respuesta.data.success;
                this.msg = respuesta.data.msg;
                console.log('estado', this.success);
                 this.getTurnos();
            })
        },
        eliminar(id){
           
            axios.delete('/api/turnos/' + id ).then(respuesta =>{
               
                this.success = respuesta.data.success;
                this.msg = respuesta.data.msg;
                 this.getTurnos();
            })

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