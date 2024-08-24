<script setup>

import imgBarsMenu from '../assets/icons/bars-menu.png'

</script>

<template>
  <header class="navbar navbar-expand-md navbar-white bg-white border-bottom">
    <div class="container-fluid">
      <div class="d-flex justify-content-between w-100">
        <div>
          <a class="navbar-brand fw-bolder" href="#">
            File Explorer
          </a>
        </div>
        <div>
          <ul class="navbar-nav flex-row d-md-none">
            <li class="nav-item text-nowrap">
              <button class="nav-link text-dark p-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <img :src="imgBarsMenu" alt="Bars Menu">
              </button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>
</template>