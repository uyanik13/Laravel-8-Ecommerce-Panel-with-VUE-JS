import Api from '@/plugins/api.js'
import Cookies from 'js-cookie'


export default {

  login (context, payload) {
    return new Promise((resolve, reject) => {
        Api.post('/api/login',payload).then(response => {
            //console.log(response)
           context.commit('SET_BEARER', response.access_token)
           context.dispatch('fetchUser')
          setTimeout(() => { resolve(response.user) }, 500)
        })
        .catch(error => {
          console.log(error)
          reject({message: error})
        })
    })
  },


  register ({ commit }, payload) {
    return new Promise((resolve, reject) => {
      if (payload.password !== payload.confirm_password) {
        reject({message: 'Password doesn\'t match. Please try again.'})
      }
      Api.post('/api/register',payload)
        .then(response => {
          resolve(response)
        })
        .catch(error => { reject(error) })
    })
  },


  fetchUser (context) {
    return new Promise((resolve, reject) => {
        Api.get('/api/user').then(response => {
            //console.log(response)
          context.commit('SET_USER', response)
          acl => acl.change(response.role)
          resolve(response)
        })
        .catch(error => { reject(error) })
    })
  },



  logout () {
    return new Promise((resolve, reject) => {
        // Api.post('/api/logout').then(response => {
        //  Api.clearCreds()
        // })
        Api.clearCreds()
        .catch(error => { reject(error) })
    })
  },


  refreshToken (context) {
    return new Promise((resolve, reject) => {
      Api.get('/api/refresh').then(response => {
          context.commit('SET_BEARER', response)
          resolve(response)
        })
        .catch(error => { reject(error) })
    })
  },


  emailVerifyApi ({ commit }, payload) {
    return new Promise((resolve, reject) => {
     Api.post('/api/emailResendApi',payload)
        .then(response => {
          resolve(response)
        })
        .catch(error => { reject(error) })
    })
  },

}
