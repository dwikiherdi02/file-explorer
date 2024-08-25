import axios from 'axios';

const API_URL = 'http://127.0.0.1:8810/api'

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
}

export default new DirectoryService();