<script setup>
// Images
import imgDocument from '../assets/icons/file-storage.png'
import imgMusic from '../assets/icons/music-folder.png'
import imgPC from '../assets/icons/pc.png'
import imgPicture from '../assets/icons/photo-gallery.png'
import imgVideo from '../assets/icons/video-folder.png'
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
          <li class="nav-item">
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
          </li>
        </ul>
      </div>
    </div>
  </aside>
</template>