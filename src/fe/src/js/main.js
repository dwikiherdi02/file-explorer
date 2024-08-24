import { createApp } from 'vue'
import App from './App.vue'
import { createWebHistory , createRouter } from 'vue-router'

// Import our custom CSS
import '../scss/styles.scss'

// Import only the Bootstrap components we need
import { Popover } from 'bootstrap';

// Import pages
import HomePage from '../pages/HomePage.vue'
import FolderPage from '../pages/FolderPage.vue'
const routes = [
  { path: '/', component: HomePage },
  { path: '/f/:folder', component: FolderPage },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

createApp(App)
  .use(router)
  .mount('#app')

// Create an example popover
document.querySelectorAll('[data-bs-toggle="popover"]')
  .forEach(popover => {
    new Popover(popover)
  })
