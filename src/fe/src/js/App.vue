<script setup>
// Components
import Header from '../components/Navbar.vue'
import Sidebar from '../components/Sidebar.vue'
</script>

<template>
  <!-- Header -->
  <Header />
  <!-- ./Header -->

  <!-- Main Container -->
  <div class="container-fluid">
    <!-- Main Row -->
    <div class="row">
      <!-- Sidebar -->
      <Sidebar />
      <!-- ./Sidebar -->

      <!-- Main -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <RouterView />
      </main>
      <!-- ./Main -->
    </div>
    <!-- ./Main Row -->
  </div>
  <!-- ./Main Container -->

</template>
