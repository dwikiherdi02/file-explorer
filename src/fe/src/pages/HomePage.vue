<script setup>
import { onMounted, ref } from 'vue'

// Components
import MainTitle from '../components/MainTitle.vue'

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
  <!-- Header Main -->
  <MainTitle title="Home" :onLoad="onLoad" />
  <!-- ./Header Main -->

  <!-- Content -->
  <div class="row row-cols-1">
    <div class="col mb-2">
      <div class="row row-cols-3 row-gap-3">
        
        <div v-if="onLoad == 0" v-for="list in listNavigations" class="col-12 col-sm-6 col-md-4">
          <router-link :to="{ name: 'to_folder', query: { rid: list.id } }">
            <div class="card card-folder border-0">
              <div class="card-body d-flex flex-row align-items-stretch pt-2 ps-0 pt-md-0 ps-md-3">
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
              <div class="card-body d-flex flex-row align-items-stretch placeholder-glow pt-2 ps-0 pt-md-0 ps-md-3">
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