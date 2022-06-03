<template>
    <div class="container mt-3">
        <div class="row">
            <div class="col-9">
                <h2>Agregar Turno</h2>
            </div>
            <div class="col-3 d-flex justify-content-end">
                <button @click="back()" type="button" class="btn btn-light nuevapeli"><i class="bi bi-arrow-left-short"></i> Regresar</button>
            </div>
        </div>
        <div v-if="success" class="alert alert-success" role="alert">
        {{ msg }}
        </div>
        <br><br>
        <form action="" class="formulario">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Turno</label>
                 <input type="datetime" v-model="turno" class="form-control" id="exampleFormControlInput1" placeholder="hh:ss:ii" >
            </div>
            <div class="mb-3">
               <div class="form-check">
                    <input v-model="estado" class="form-check-input" type="checkbox" id="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        ¿Activo?
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <button type="button" @click="guardar()" class="btn btn-success">Guardar</button>
            </div>
        </form>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return{
            turno: '',
            estado: '',
            success:false,
            msg:false
        }
    },
    methods:{
        guardar(){
            
            let data = new FormData();

            data.append('turno', this.turno);
            data.append('estado', this.estado);
              
             axios.post('/api/turnos', data).then(respuesta =>{
                console.log(respuesta.data);
                this.success = respuesta.data.success;
                this.msg = respuesta.data.msg;
                 this.turno= '';
                this.estado= false;
               
            })  
        },
        back(){
            this.$router.push('/turnos');
        }
    }
}
</script>

<style>
.formulario{
    width: 90%;
}
</style>