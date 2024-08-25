<script setup>
// Images
import { onMounted, ref } from 'vue'

// Stores
import { useNavigationStore } from '../stores/navigation'

const navigationStore = useNavigationStore()

const onLoad = ref(0)

const listNavigations = ref([])

const load = async () => {
  onLoad.value = 1
  
  const [results, errors] = await navigationStore.list();

  listNavigations.value = results

  onLoad.value = 0
}

onMounted(async () => {
  await load()
})

</script>

<template>
  <aside class="sidebar border-0 col-md-3 col-lg-2 py-2 bg-white">
    <div class="offcanvas-md offcanvas-end bg-white" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bolder" id="sidebarMenuLabel">File Explorer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
          aria-label="Close"></button>
      </div>
      <div class="offcanvas-body d-md-flex flex-column p-0 overflow-y-auto">
        <ul class="nav nav-pills flex-column mb-auto">

          <li v-if="onLoad == 0" v-for="list in listNavigations" class="nav-item">
            <router-link :to="{ name: 'to_folder', query: { rid: list.id } }" class="nav-link gap-2">
              <span class="icon">
                <img :src="list.image" :alt="list.name">
              </span>
              <span class="text">
                {{ list.name }}
              </span>
            </router-link>
          </li>
          
          <li v-if="onLoad == 1" v-for="n in 4" class="nav-item placeholder-glow mb-2"> 
            <a class="nav-link gap-2 placeholder" href="#">
              <span class="icons placeholder"></span>
              <span class="text placeholder"></span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <RouterLink class="nav-link gap-2" to="/f/documents">
              <span class="icon">
                <img :src="imgDocument" alt="Document">
              </span>
              <span class="text">
                Documents
              </span>
            </RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link gap-2" to="/f/music">
              <span class="icon">
                <img :src="imgMusic" alt="Music">
              </span>
              <span class="text">
                Music
              </span>
            </RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link gap-2" to="/f/pictures">
              <span class="icon">
                <img :src="imgPicture" alt="Picture">
              </span>
              <span class="text">
                Pictures
              </span>
            </RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link gap-2" to="/f/videos">
              <span class="icon">
                <img :src="imgVideo" alt="Video">
              </span>
              <span class="text">
                Videos
              </span>
            </RouterLink>
          </li> -->
        </ul>
      </div>
    </div>
  </aside>
</template>