<script setup>
// Packages
import { ref, watch, onMounted } from 'vue'
import { useRoute } from 'vue-router'

// Components
import MainTitle from '../components/MainTitle.vue'

const route = useRoute()

console.log(route.query)

let folderName = ref('')
let subID = ref('');

onMounted(() => {
  folderName.value = route.params.folder
  subID.value = route.query.subid
})

watch(() => route.params, (newParams, oldParams) => {
  folderName.value = newParams.folder
})

watch(() => route.query, (newQuery, oldQuery) => {
  subID.value = newQuery.folder
})

</script>

<template>
  <!-- Header Main -->
  <MainTitle :title="folderName" />
  <!-- ./Header Main -->

  <!-- Content -->
  <div class="row row-cols-1">
    <div class="col mb-2">
      Folder : {{ folderName }}
      <br>
      SubID : {{ subID }}
    </div>
  </div>
  <!-- ./Content -->
</template>