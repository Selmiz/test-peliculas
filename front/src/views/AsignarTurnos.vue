<template>
     <div class="container mt-3 asigna">

        <h2>Asignar Turno a Película</h2>

        <form action="">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                    <input type="text" v-model="pelicula.nombre" class="form-control" id="exampleFormControlInput1" placeholder="Nombre de Pelicula" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Fecha Publicación</label>
                <input type="date" v-model="pelicula.fecha_publicacion" class="form-control" id="exampleFormControlInput1" placeholder="Fecha Publicación" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Imagen</label><br>
                <img :src="'http://127.0.0.1:8000/storage/'+pelicula.imagen" width="200" height="200" class="img-fluid">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Seleccione un turno</label>
                <select v-model="elturno" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option value="0" selected>Seleccione un turno</option>
                    <option v-for="turno in turnos" :value="turno.id">{{ turno.turno }}</option>
                </select>

            </div>
            <div class="mb-3">
                <button type="button" @click="cancelar()" class="btn btn-danger cancelar">Cancelar</button>
                
                <button type="button" @click="actualizar(pelicula.id)" class="btn btn-success">Guardar</button>
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
            pelicula:[],
            turnos:[],
            id_turno:0,
            idpelicula:0,
            image:'',
            success:false,
            msg:''
        }
    },
    created: function(){
        this.idpelicula = this.$route.params.id;
        this.getPelicula(this.idpelicula);
    },
    methods: {
         subirImage(e){
            this.image = e.target.files[0];
        },
       async getPelicula(id){

            await axios.get('api/peliculas/asignaTurno/'+ id).then( respuesta =>{
                this.pelicula = respuesta.data.pelicula;
                this.turnos = respuesta.data.turnos;
                console.log(this.pelicula, this.turnos);
            })

        },
       actualizar(id_peli){
           
            let id_turno = this.elturno ;
            console.log('actu',id_peli, id_turno);

             axios.get('/api/peliculas/actualizaTurno/' + id_peli + '/'+ id_turno).then(respuesta =>{
                console.log(respuesta);
                this.success = respuesta.data.success;
                this.msg = respuesta.data.msg;
                this.$router.push('/peliculas'); 
            })


        },
        cancelar(){
            this.$router.push('/peliculas');
        }
    }
}

</script>

<style>
.asigna{
    width: 700px;
}
</style>