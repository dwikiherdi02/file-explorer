import { defineStore } from 'pinia'

// Services
import DirectoryService from '../services/directory.service'

export const useDirectoryStore = defineStore('directory', {
    state: () => ({
      
    }),
    getters: {
      
    },
    actions: {
      list(rid, subid) {
        return DirectoryService.listSub(rid, subid).then(
          (responses) => {
            return responses
          }
        )
      }
    }
});