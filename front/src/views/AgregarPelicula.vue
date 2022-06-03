<template>
    <div class="container mt-3">

        <div class="row">
                    <div class="col-9">
                        <h2>Agregar Película</h2>
                    </div>
                    <div class="col-3 d-flex justify-content-end">
                        <button @click="back()" type="button" class="btn btn-light nuevapeli"><i class="bi bi-arrow-left-short"></i> Regresar</button>
                    </div>
                </div>
        <div v-if="success" class="alert alert-success" role="alert">
        {{ msg }}
        </div>
        <form action="">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                 <input type="text" v-model="name" class="form-control" id="exampleFormControlInput1"  placeholder="Nombre de Pelicula" >
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Fecha Publicación</label>
                <input type="date" v-model="fec_pub" class="form-control" id="exampleFormControlInput1" placeholder="Fecha" >
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Imagen</label>
                <input type="file" accept="image/*" class="form-control" v-on:change="subirImage( $event )" id="imagen" name="imagen" placeholder="Fecha" ref="myFileInput" >
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
            name: '',
            fec_pub: '',
            image: '',
            success:false,
            msg:''
        }
    },
    methods:{
        subirImage(e){
            this.image = e.target.files[0];
        },
        guardar(){

            
            let data = new FormData();

            data.append('name', this.name);
            data.append('fec_pub', this.fec_pub);
            data.append('image', this.image);

            axios.post('/api/peliculas', data).then(respuesta =>{
                console.log(respuesta);
                this.success = respuesta.data.success;
                this.msg = respuesta.data.msg;
                this.name= '';
                this.fec_pub= '';
                this.image= '';
                this.$refs.myFileInput.value = '';
            })
        },
        back(){
            this.$router.push('/peliculas');
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