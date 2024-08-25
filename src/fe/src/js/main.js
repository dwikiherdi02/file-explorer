import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { createWebHistory , createRouter } from 'vue-router'

import App from './App.vue'

// Import our custom CSS
import '../scss/styles.scss'

// Import only the Bootstrap components we need
import { Popover } from 'bootstrap';

const pinia = createPinia()

// Import pages
import HomePage from '../pages/HomePage.vue'
import FolderPage from '../pages/FolderPage.vue'
const routes = [
  { name:'home', path: '/', component: HomePage },
  { name:'to_folder', path: '/f', component: FolderPage },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

createApp(App)
  .use(pinia)
  .use(router)
  .mount('#app')

// Create an example popover
document.querySelectorAll('[data-bs-toggle="popover"]')
  .forEach(popover => {
    new Popover(popover)
  })
