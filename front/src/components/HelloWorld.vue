<template>
    <div class="row">
        <div class="col-2">
            <Menu></Menu>
        </div>
        <div class="col-10 contenidoheader">
          <br><br><br>
           <img v-if="user == 1" :src="'http://127.0.0.1:8000/storage/inicio.png'" width="700" height="700" class="img-fluid image">
            <div class="inisesion" v-if="user == 0">
              <h6>No has Iniciado Sesión</h6>
              <router-link to="/login" class="list-group-item list-group-item-action">
              Iniciar Sesion
              </router-link>
            </div>
        </div>
    </div>     
     <div class="container">
       <br>
        <h4>BIENVENIDO</h4>
    </div> 
   

</template>

<script>
import axios from 'axios';
import Header from './Header.vue';
import Menu from '@/components/Menu.vue';

export default {
    name: "Home",
    components: { Header, Menu },
    data(){
        return{
           user: 0
        }
    },
    created: function(){

          this.validaUsuario();
      },
      methods:{
        validaUsuario(){
          this.user = localStorage.getItem('log');
        }
      }
    
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

.contenidoheader{
  text-align: center;
  color: gray;
}

.inisesion h5{
  text-align: center;
  width: 400px;
   text-decoration: none;
}

</style>
