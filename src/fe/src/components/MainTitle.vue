<script setup>
// Components
import { ref, watch } from 'vue'

// Images
import imgPC from '../assets/icons/pc.png'

const props = defineProps(['title', 'breadcrumbs', 'onLoad'])

const title = (props.title != undefined) ? ref(props.title) : ref('Home')

const breadcrumbs = (props.breadcrumbs != undefined) ? ref(props.breadcrumbs) : ref([])

const onLoad = (props.onLoad != undefined) ? ref(props.onLoad) : ref(0)

watch(() => props.title, (newTitle, oldTitle) => {
  title.value = (newTitle) ? newTitle : 'Home'
})

watch(() => props.onLoad, (newOnLoad, oldOnLoad) => {
  onLoad.value = (newOnLoad) ? newOnLoad : 0
})

watch(() => props.breadcrumbs, (newBreadcrumbs, oldBreadcrumbs) => {
  breadcrumbs.value = newBreadcrumbs ?? 0
})

</script>

<template>
  <div id="main-header" class="d-flex flex-column flex-md-row flex-wrap flex-md-nowrap justify-content-between align-items-center pt-md-3 pb-2 mb-2">
    <h1 v-if="onLoad == 0" class="h2 text-uppercase">{{ title }}</h1>
    
    <h1 v-if="onLoad == 1" class="h2 text-uppercase placeholder-glow w-25"><span class="placeholder w-100"></span></h1>

    <nav class="align-self-center" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
      aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <router-link :to="{name: 'home'}"><img :src="imgPC" alt="This PC"></router-link>
        </li>
        <!-- <li v-if="onLoad == 0" v-for="(breadcrumb, index) in breadcrumbs" class="breadcrumb-item active" aria-current="page">
          {{ breadcrumb }}
        </li> -->
      </ol>
    </nav>
  </div>
</template>