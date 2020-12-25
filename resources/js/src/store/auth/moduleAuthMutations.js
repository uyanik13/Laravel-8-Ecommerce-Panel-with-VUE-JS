import axios from 'axios'
import Cookies from 'js-cookie'

export default {
  SET_BEARER (state,token) {
    //console.log(token)
    axios.defaults.headers.common = { 'Authorization': `Bearer ${token}` }
    Cookies.set('token', token)
  },

  SET_USER (state, payload) {
    state.user = payload
    Cookies.set('user', payload)
  },

}
