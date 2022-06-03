<template>
    <div class="container mt-3">

        <h2>Editar Películas</h2>

        <form action="">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                    <input type="text" v-model="pelicula.nombre" class="form-control" id="exampleFormControlInput1" placeholder="Nombre de Pelicula">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Fecha Publicación</label>
                <input type="date" v-model="pelicula.fecha_publicacion" class="form-control" id="exampleFormControlInput1" placeholder="Fecha Publicación">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Imagen</label><br>
                <img :src="'http://127.0.0.1:8000/storage/'+pelicula.imagen" width="200" height="200" class="img-fluid">
                <input type="file" accept="image/*" class="form-control" v-on:change="subirImage( $event )" id="imagen" name="imagen" ref="myFileInput">
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

            const headers = { 
                "Authorization": 'Bearer ' +  localStorage.getItem('token'),
                "Accept": "application/json"
            };

            await axios.get('/api/peliculas/'+id+'/edit',{headers}).then( respuesta =>{
                this.pelicula= respuesta.data;
               // console.log(this.pelicula);
            })

        },
       actualizar(id){

            const headers = { 
                "Authorization": 'Bearer ' +  localStorage.getItem('token'),
                "Accept": "application/json"
            };
            
            let data = new FormData();

            data.append('name', this.pelicula.nombre);
            data.append('fec_pub', this.pelicula.fecha_publicacion);
            data.append('image', this.image);
            console.log('data',id, data);

            axios.post('/api/peliculas/'+id, data, {headers}).then(respuesta =>{
                //console.log(respuesta);
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
.cancelar{
    margin-right: 20px;
}

</style>