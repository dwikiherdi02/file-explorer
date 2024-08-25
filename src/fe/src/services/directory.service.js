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
}

export default new DirectoryService();