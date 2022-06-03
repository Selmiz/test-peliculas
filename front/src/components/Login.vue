<template>
    <div class="container sesion">
        <h4>Inicia Sesión</h4>
        
       <form action="">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Correo Electrónico</label>
                <input type="email" v-model="email" class="form-control " id="email" placeholder="correo@dominio.com">
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Contraseña</label>               
                <input type="password" v-model="password" class="form-control " id="inputPassword">
               
            </div>
            <br>
            <div class="mb-3 bot">
                <button type="button" @click="ingresar()" class="btn btn-primary btn-md ingresar">Ingresar</button>
            </div>
        </form>

    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'Login',
   data(){
        return{
            email:'',
            password:'',
            user:0,
        }
    },
    created: function(){

          this.cerrarsesion();
      },
    methods:{
        ingresar() {
             
            let data = new FormData();
            let resulta = '';
            let logueado = 0;

            data.append('email', this.email);
            data.append('password', this.password);
            let url = 'http://127.0.0.1:8000';

             axios.post('/api/login', data).then(respuesta =>{
                 resulta = respuesta.data;
                localStorage.setItem('token', resulta.token);
                console.log('token',resulta.token);                
                if (resulta.token) {
                    logueado = 1;
                }else{
                    logueado = 0;
                }
                console.log('logueado', logueado);
                localStorage.setItem('log', logueado);
                localStorage.setItem('url', url);
                this.$router.push('/home');
            });
        },
        cerrarsesion(){
            localStorage.setItem('token', ' ');
            localStorage.setItem('log', 0);
            

        }
    }
}

</script>

<style>

.auth-inner .sesion {
    background-color: lightblue;
    padding: 20px;
    border-radius: 20px;
    width: 500px;   
}
.sesion h4{
    text-align: center;
}

.bot{
    text-align: center;
}
.ingresar{
    width: 150px;
}

</style>