<script setup>
// Components
import MainTitle from '../components/MainTitle.vue'

// Images
import imgDocument from '../assets/icons/file-storage.png'
import imgMusic from '../assets/icons/music-folder.png'
import imgPicture from '../assets/icons/photo-gallery.png'
import imgVideo from '../assets/icons/video-folder.png'
</script>

<template>
  <!-- Header Main -->
  <MainTitle :title="Home" />
  <!-- ./Header Main -->

  <!-- Content -->
  <div class="row row-cols-1">
    <div class="col mb-2">
      <div class="row row-cols-3 row-gap-3">
        <div class="col-12 col-sm-6 col-md-4">
          <a href="#">
            <div class="card card-folder border-0">
              <div class="card-body d-flex flex-row align-items-stretch">
                <div class="icon align-self-center pe-2">
                  <img :src="imgDocument" alt="Documents" width="30" height="30">
                </div>
                <div class="text align-self-center fw-bold">Documents</div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
          <a href="#">
            <div class="card card-folder border-0">
              <div class="card-body d-flex flex-row align-items-stretch">
                <div class="icon align-self-center pe-2">
                  <img :src="imgMusic" alt="Documents" width="30" height="30">
                </div>
                <div class="text align-self-center fw-bold">Music</div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
          <a href="#">
            <div class="card card-folder border-0">
              <div class="card-body d-flex flex-row align-items-stretch">
                <div class="icon align-self-center pe-2">
                  <img :src="imgPicture" alt="Documents" width="30" height="30">
                </div>
                <div class="text align-self-center fw-bold">Pictures</div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
          <a href="#">
            <div class="card card-folder border-0">
              <div class="card-body d-flex flex-row align-items-stretch">
                <div class="icon align-self-center pe-2">
                  <img :src="imgVideo" alt="Documents" width="30" height="30">
                </div>
                <div class="text align-self-center fw-bold">Videos</div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- ./Content -->
</template>