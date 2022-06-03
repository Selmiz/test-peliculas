import { createRouter, createWebHashHistory } from 'vue-router'

import Home from '../components/HelloWorld.vue';
import Login from '../components/Login.vue';
import Peliculas from '../views/Peliculas.vue'

import Turnos from '../views/Turnos.vue'
import AgregarPelicula from '../views/AgregarPelicula.vue'
import EditarPelicula from '../views/EditarPelicula.vue'
import AsignarTurno from '../views/AsignarTurnos.vue'
import AgregarTurno from '../views/AgregarTurno.vue'
import EditarTurno from '../views/EditarTurno.vue'

const routes = [
  {
    path: '/',
    component: Login
  },
  {
    path: '/login',
    component: Login
  },
  {
    path: '/home',
    component: Home
  },

  { 
    path: '/peliculas',
    name: 'peliculas',
    component: Peliculas
 },
  {
    path: '/agregar-pelicula',
    name: 'agregar-pelicula',
    component: AgregarPelicula
  },
  {
    path: '/editar-pelicula/:id',
    name: 'editar-pelicula',
    component: EditarPelicula
  },
  {
    path: '/asignar-turno/:id',
    name: 'asignar-turno',
    component: AsignarTurno
  },
  {
    path: '/turnos',
    name: 'turnos',
    component: Turnos
  },
  {
    path: '/agregar-turno',
    name: 'agregar-turno',
    component: AgregarTurno
  },
  {
    path: '/editar-turno',
    name: 'editar-turno',
    component: EditarTurno
  }
]

const router = createRouter({

  history: createWebHashHistory(),
  routes
})

export default  router
