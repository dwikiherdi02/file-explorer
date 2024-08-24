<script setup>
// Components
import { ref, watch } from 'vue'

// Images
import imgPC from '../assets/icons/pc.png'

const props = defineProps({
  title: String
})


let title = (props.title != undefined) ? ref(props.title) : ref('Home')

watch(() => props.title, (newTitle, oldTitle) => {
  title = (newTitle) ? newTitle : 'Home'
})

</script>

<template>
  <div id="main-header"
    class="d-flex flex-column flex-md-row justify-content-between flex-wrap flex-md-nowrap pt-md-3 pb-2 mb-2">
    <h1 class="h2 text-uppercase">{{ title }}</h1>
    <nav
      style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
      aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <RouterLink to="/"><img :src="imgPC" alt="This PC"></RouterLink>
        </li>
        <!-- <li class="breadcrumb-item active" aria-current="page">Documents</li> -->
      </ol>
    </nav>
  </div>
</template>