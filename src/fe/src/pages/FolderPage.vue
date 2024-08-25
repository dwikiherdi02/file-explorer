<script setup>
// Packages
import { ref, watch, onMounted } from 'vue'
import { useRoute } from 'vue-router'

// Stores
import { useDirectoryStore } from '../stores/directory'

// Components
import MainTitle from '../components/MainTitle.vue'

const route = useRoute()

const directoryStore = useDirectoryStore()

const onLoad = ref(0)

const pageDesc = ref([])

const listDir = ref([])

const load = async (rid, subid) => {
  onLoad.value = 1
  
  if (rid != '' && subid != '') {
    const [results, errors] = await directoryStore.list(rid, subid);
    
    pageDesc.value = results.current
    
    listDir.value = results.list
  }  else {
    pageDesc.value = []
    
    listDir.value = []
  }

  onLoad.value = 0
}

onMounted(async () => {
  await load(route.query.rid, route.query.subid)
})

watch(() => route.query, async (newQuery, oldQuery) => {
  await load(newQuery.rid, newQuery.subid)
})

</script>

<template>
  <!-- Header Main -->
  <MainTitle :title="pageDesc.name" :breadcrumbs="pageDesc.breadcrumbs ?? []" :onLoad="onLoad" />
  <!-- ./Header Main -->

  <!-- Content -->
  <div class="row row-cols-1">
    <div class="col mb-2">
      <div class="row row-cols-3 row-gap-3">
        
        <div v-if="onLoad == 0" v-for="list in listDir" class="col-12 col-sm-6 col-md-4">
          <router-link :to="{ name: 'to_folder', query: { rid: list.root_id, subid: list.id } }">
            <div class="card card-folder border-0">
              <div class="card-body d-flex flex-row align-items-stretch pt-0">
                <div class="icon align-self-center pe-2">
                  <img :src="list.image" :alt="list.name" width="30" height="30">
                </div>
                <div class="text align-self-center fw-bold">{{ list.name }}</div>
              </div>
            </div>
          </router-link>
        </div>

        <div v-if="onLoad == 1" v-for="n in 3" class="col-12 col-sm-6 col-md-4">
            <div class="card card-folder border-0">
              <div class="card-body d-flex flex-row align-items-stretch placeholder-glow pt-0">
                <div class="icon align-self-center py-3 me-1 placeholder" style="width: 35px"></div>
                <div class="text align-self-center py-3 w-50 placeholder"></div>
              </div>
            </div>
        </div>

      </div>
    </div>
  </div>
  <!-- ./Content -->
</template>