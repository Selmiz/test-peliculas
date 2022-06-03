import { createApp } from 'vue'
import App from './App.vue'
import router from './router/index'

import axios from 'axios'
axios.defaults.baseURL = 'http://127.0.0.1:8000/';
axios.defaults.headers.common['Authorization'] = 'Bearer ' +  localStorage.getItem('token');
createApp(App).use(router).mount('#app')
