<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-dark" >
    <div class="container-fluid">
      <router-link to="/home" class="home">
        <h3 class="titulo"><i class="bi bi-film"></i> Evaluación Osp</h3>          
        </router-link>        
      <div class="collapse navbar-collapse d-flex flex-row-reverse" id="navbarSupportedContent">
          <ul class="navbar-nav">
          <li class="nav-item">
            <router-link v-if="user == 0" to="/login" class="list-group-item list-group-item-action inisesion">Iniciar Sesion</router-link>
                        
            <div v-if="user == 1" class="collapse navbar-collapse d-flex flex-row-reverse" id="navbarSupportedContent">
              <ul class="navbar-nav mb-2 mb-lg-0">    
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <label class="user">Admin
                    <i class="bi bi-person-fill"></i> </label>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li>
                      <router-link v-if="user == 1" to="/login" class="list-group-item list-group-item-action inisesion">Cerrar Sesión</router-link>
                    </li>         
                  </ul>
                </li>                
              </ul>
            </div>

          </li>          
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
    export default {

      name:'Nav',
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
          console.log('',this.user);
        }
      }

    }
</script>

<style>
  .titulo{
    color: white;
    text-decoration: none;
  }
  .home{
    text-decoration: none;
  }
  .inisesion{
    color: white !important;
    background-color: black;
  }
  .inisesion:hover{
    color:black !important;
    background-color: lightgray;
  }

</style>