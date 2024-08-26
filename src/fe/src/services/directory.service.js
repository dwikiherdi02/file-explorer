import axios from 'axios';

// const API_URL = 'http://127.0.0.1:8810/api'
const API_URL = import.meta.env.VITE_BACKEND_URL

class DirectoryService {
  listRoot() {
    return axios.get(`${API_URL}/directories/root/list`)
    .then((responses) => {
      let {code, status, results, errors} = responses.data
      return [results, errors]
    })
    .catch((error) => {
      let {code, status, results, errors} = error.response.data
      return [results, errors]
    })
  }

  listSub(rid, subid) {
    return axios.get(`${API_URL}/directories`, {
      params: {
        rid: rid,
        subid: subid
      }
    })
    .then((responses) => {
      let {code, status, results, errors} = responses.data
      return [results, errors]
    })
    .catch((error) => {
      let {code, status, results, errors} = error.response.data
      return [results, errors]
    })
  }

  createDir(parentID, folderName) {
    const json = JSON.stringify({ parent_id: parentID, folder_name: folderName });
    return axios.post(`${API_URL}/directories`, json, {
      headers: {
        // Overwrite Axios's automatically set Content-Type
        'Content-Type': 'application/json'
      }
    })
    .then((responses) => {
      let {code, status, results, errors} = responses.data
      return [results, errors]
    })
    .catch((error) => {
      let {code, status, results, errors} = error.response.data
      return [results, errors]
    })
  }

  uploadFile(parentID, file) {
    const formData = new FormData();
    formData.append('parent_id', parentID)
    formData.append('file', file)

    return axios.post(`${API_URL}/files`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
    })
    .then((responses) => {
      console.log(responses)
      let {code, status, results, errors} = responses.data
      return [results, errors]
    })
    .catch((error) => {
      let {code, status, results, errors} = error.response.data
      console.log(results)
      console.log(errors)
      return [results, errors]
    })

  }
}

export default new DirectoryService();