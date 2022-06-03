<template>
    <div class="d-flex align-items-start menu">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <br>
            <h6 class="titlemenu">MENÚ</h6>
            <hr>
            <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" type="button" role="tab" aria-selected="true">
                <router-link to="/peliculas">Peliculas</router-link>
            </button>
            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" type="button" role="tab"  aria-selected="false">
                <router-link to="/turnos">Turnos</router-link>
            </button>
        </div>
    </div>


   <!--  <nav class="menu">
        <ul class="pl-0">
            <li >
                <router-link to="/peliculas">Peliculas</router-link>
            </li>
            <li >
                <router-link to="/turnos">Turnos</router-link>
            </li>
        </ul>
    </nav> -->

</template>

<style>
.menu{
    width: 150px;
    height: 100vh;
    box-sizing: content-box;
    display: inline-block;
    border: 1px solid lightgray;
}
.nav-link{
    margin-bottom: 10px;
    width: 150px !important;
    text-align: center;
    width: 100%;
}
.nav-link.active{
    color: white !important;
    background-color: lightblue !important; 
}

.nav-link a{
    color: black !important;
    width: 100%;
    text-decoration: none;
}

.titlemenu{
    margin: 0;
    text-align: center;
    vertical-align: middle;
    color: lightblue;
}

</style>