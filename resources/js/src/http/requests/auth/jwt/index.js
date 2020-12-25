import axios from 'axios'
import store from '../../../../store/store.js'
import Cookies from 'js-cookie'
import router from '@/router'
// Token Refresh
let isAlreadyFetchingAccessToken = false
let subscribers = []

function onAccessTokenFetched (access_token) {
  subscribers = subscribers.filter(callback => callback(access_token))
}

function addSubscriber (callback) {
  subscribers.push(callback)
}

export default {
  login (email, pwd) {
    return axios.post('/api/login', {email, password: pwd})
  },
  fetchUser () {
    return axios.get('/api/user')
  },

  fetchStore () {
    return axios.get('/api/store')
  },

  fetchUsers () {
    return axios.get('/api/users')
  },
  registerUser (name, email,  password, confirmPassword) {
    return axios.post('/api/register', {name, email,  password, password_confirmation:confirmPassword})
  },
  emailVerifyApi (email) {
    return axios.post('/api/emailResendApi', {email})
  },

  refreshToken () {
    return axios.get('/api/refresh')
  }

}
