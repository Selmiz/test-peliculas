<template>
  <div id="app" class="app">
    <Nav></Nav>
    <div class="content">
      <div class="auth-inner">
        <router-view></router-view>
      </div>
    </div>
  </div>

</template>

<script>
  import Nav from './components/HeaderLogin.vue';
  
/* import Header from '@/components/Header.vue';
import Menu from '@/components/Menu.vue';
import Login from '@/components/Login.vue'; */



export default{
  components: {
    name: 'App',
    Nav
    
    /* Header,
    Menu,
    Login */
  }
}
</script>

<style>
nav {
  padding: 10px;
}

.content{
  width: 100%;
  height: 800px;
  display:flex;
  align-content: center;
  justify-content: center;
  align-items: center;
}
.auth-inner{
  width: 100%;
  height: 800px;
  
}

</style>
