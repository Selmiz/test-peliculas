<template>
    <div class="container mt-3">

        <h2>Editar Turno</h2>

        <form action="">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Turno</label>
                    <input type="datetime" v-model="turno.turno" class="form-control" id="exampleFormControlInput1" placeholder="HH:ss:ii">
            </div>
            <div class="mb-3">
                <button type="button" @click="cancelar()" class="btn btn-danger cancelar">Cancelar</button>
                
                <button type="button" @click="actualizar(turno.id)" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props:{
      
    },
    data(){
        return{
            turno:[],
            idturno:0,
            success:false,
            msg:''
        }
    },
    created: function(){
        this.idturno = this.$route.params.id;
        this.getTurno(this.idturno);
    },
    methods: {
       async getTurno(id){
           
           await axios.get('/api/turnos/'+ id ).then( respuesta =>{
               this.turno= respuesta.data;
             console.log('id',respuesta);
        })

        },
       actualizar(id){
            
            let data = new FormData();

            data.append('turno', this.turno.turno);
           
            axios.post('/api/turnos/'+id, data).then(respuesta =>{
                console.log(respuesta.data);
                this.success = respuesta.data.success;
                this.msg = respuesta.data.msg;
                this.$router.push('/turnos');
            })


        },
        cancelar(){
            this.$router.push('/turnos');
        }
    }
}

</script>

<style>
.cancelar{
    margin-right: 20px;
}

</style>