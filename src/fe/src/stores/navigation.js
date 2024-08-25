// Packages
import { defineStore } from 'pinia'

// Services
import DirectoryService from '../services/directory.service'


export const useNavigationStore = defineStore('navigation', {
    state: () => ({
      list: []
    }),
    getters: {
      
    },
    actions: {
      list() {
        return DirectoryService.listRoot().then(
          (responses) => {
            return responses
          }
        )
      }
    }
});