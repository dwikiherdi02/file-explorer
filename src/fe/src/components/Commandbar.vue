<script setup>
// Package
import { onMounted, reactive, ref, watch } from 'vue';
import { Modal } from 'bootstrap';

// Stores
import { useDirectoryStore } from '../stores/directory'

// Images
import imgCreateFolder from '../assets/icons/add-folder.png'
import imgUploadFile from '../assets/icons/upload-file.png'

// const emit = defineEmits({
//   submitCreateFolder: ({ folderName }) => {
//     return folderName
//   }
// })
const emit = defineEmits(['onCreateFolderSuccess'])

const directoryStore = useDirectoryStore()

const props = defineProps(['onLoad', 'parentID'])

const onLoad = props.onLoad ? ref(props.onLoad) : ref(0)

const parentID = props.parentID ? ref(props.parentID) : ref('')

const folderName = ref('')

const errs = reactive({ folderName: '' })

const onSubmitCF = ref(0)

let modalCreatFolder
let modalInstance 
let inputFolderName

const submitCF = async () => {
  onSubmitCF.value = 1
  
  errs.folderName = ''
  
  const [results, errors] = await directoryStore.createDir(parentID.value, folderName.value)
  
  if (errors.folder_name) {
    errs.folderName = errors.folder_name
  } else {
    modalInstance.hide()
    emit('onCreateFolderSuccess')
  }
  
  onSubmitCF.value = 0
}

onMounted(() => {
  modalCreatFolder = document.getElementById('createFolder')
  modalInstance = new Modal(modalCreatFolder)
  inputFolderName = document.getElementById('folderName')


  modalCreatFolder.addEventListener('hidden.bs.modal', () => {
    inputFolderName.value = ''
    folderName.value = ''
    errs.folderName = ''
  })
})

watch(() => props.parentID, (newParentID, oldParentID) => {
  parentID.value = newParentID
})

watch(() => props.onLoad, (newOnLoad, oldOnLoad) => {
  onLoad.value = newOnLoad
})

</script>

<template>  
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
  <div class="order-2 order-md-1"></div>
  <div class="order-1 order-md-2">
    <ul class="navbar-nav flex-row justify-content-end">
      <li class="nav-item ms-2 placeholder-glow">
        <button v-if="onLoad == 0" type="button" class="btn btn-light d-flex flex-row align-items-center w-100">
          <span class="icon me-lg-2">
            <img :src="imgUploadFile" alt="Add Folder" width="25" height="25">
          </span>
          <span class="text d-none d-lg-block fw-medium">Upload File</span>
        </button>
        <button v-if="onLoad == 1" class="btn btn-light d-flex flex-row align-items-center w-100 p-4 placeholder" aria-disabled="true"></button>
      </li>
      <li class="nav-item ms-2 placeholder-glow">
        <button v-if="onLoad == 0" type="button" class="btn btn-light d-flex flex-row align-items-center w-100" data-bs-toggle="modal" data-bs-target="#createFolder">
          <span class="icon me-lg-2">
          <img :src="imgCreateFolder" alt="Add Folder" width="25" height="25">
          </span>
          <span class="text d-none d-lg-block fw-medium">Create Folder</span>
        </button>
        <button v-if="onLoad == 1" class="btn btn-light d-flex flex-row align-items-center w-100 p-4 placeholder" aria-disabled="true"></button>
      </li>
    </ul>
  </div>
</div>

<div class="modal modal-sheet fade" id="createFolder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createFolderLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header border-bottom-0">
        <h1 id="createFolderLabel" class="modal-title fs-5">Create Folder</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ref="CloseCreateDirModal"></button>
      </div>
      <div class="modal-body py-0">
        <div class="form-floating">
          <input type="text" v-model="folderName" id="folderName" class="form-control rounded-3" placeholder="Folder Name">
          <label for="floatingInput">Folder Name</label>
        </div>
        <span v-if="errs.folderName != ''" class="text-danger" style="font-size: 12px; font-weight: 700;">{{ errs.folderName }}</span>
      </div>
      <div class="modal-footer flex-column align-items-stretch w-100 pb-3 border-top-0">
        <button v-if="onSubmitCF == 0" @click="submitCF" type="button" class="btn btn-lg btn-primary">Create</button>
        <button v-if="onSubmitCF == 1" class="btn btn-lg btn-primary" disabled>
          <span class="spinner-border spinner-border-sm me-2" aria-hidden="true"></span>
          <span class="visually-hidden" role="status">Creating...</span>
        </button>
        <button type="button" class="btn btn-lg btn-link text-decoration-none text-danger fw-bold" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</template>