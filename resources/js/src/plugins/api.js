import store from '@/store/store.js'
import router from '@/router'
import axios from 'axios'
import Cookies from 'js-cookie'



export default {
  get (url, request) {
    return axios.get(url, request)
      .then((response) => Promise.resolve(response.data))
      .catch((error) => Promise.reject(error))
  },
  post (url, request) {
    //console.log(request)
    return axios.post(url, request)
      .then((response) => Promise.resolve(response.data))
      .catch((error) => Promise.reject(error))
  },
  patch (url, request) {
    if (request instanceof FormData) {
      request.append('_method', 'PATCH')
    } else {
      request._method = 'PATCH'
    }
    return axios.post(url, request)
      .then((response) => Promise.resolve(response.data))
      .catch((error) => Promise.reject(error))
  },
  delete (url, request) {
    return axios.delete(url, request)
      .then((response) => Promise.resolve(response.data))
      .catch((error) => Promise.reject(error))
  },
  setToken (token) {
    if (token) {
      axios.defaults.headers.common = { 'Authorization': `Bearer ${token}` }
      store.auth.commit('SET_BEARER', token)
      Cookies.set('token', token)
    } else if (!token || token === '')  {
      delete axios.defaults.headers.common
    }
  },
  clearCreds () {
    Cookies.remove('user')
    Cookies.remove('token')
    delete axios.defaults.headers.common
    return router.push({path: '/panel/login', query : { selfLogouted:1}})
  }
}

