<script setup>
// Packages
import { onMounted, ref } from 'vue'

// Stores
import { useNavigationStore } from '../stores/navigation'

const navigationStore = useNavigationStore()

// const [results, errors] = await navigationStore.list()

// const listNavigations = ref(results)

const listNavigations = await navigationStore.list()

// onMounted(async () => {
//   const [results, errors] = await navigationStore.list()
//   listNavigations.value = results
// })

</script>

<template>
  <li v-for="list in listNavigations[0]" class="nav-item">
    <a class="nav-link gap-2" href="#">
      <span class="icon">
        <img :src="list.image" :alt="list.name">
      </span>
      <span class="text">
        {{ list.name }}
      </span>
    </a>
  </li>
</template>