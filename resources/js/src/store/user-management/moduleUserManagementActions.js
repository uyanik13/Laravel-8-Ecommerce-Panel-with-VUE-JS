/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
==========================================================================================*/

import axios from 'axios'

export default {
  // addItem({ commit }, item) {
  //   return new Promise((resolve, reject) => {
  //     axios.post("/api/data-list/products/", {item: item})
  //       .then((response) => {
  //         commit('ADD_ITEM', Object.assign(item, {id: response.data.id}))
  //         resolve(response)
  //       })
  //       .catch((error) => { reject(error) })
  //   })
  // },
  fetchUsers ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get('/api/users')
        .then((response) => {
          // console.log('fetchUsers',response.data)
          commit('SET_USERS', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchUser ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get('/api/user')
        .then((response) => {
          //console.log('user',response.data)
          commit('SET_USER', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  findUser ({ commit }, userId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/users/${userId}`)
        .then((response) => {
          console.log('user', response)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

  addUser ({ commit }, data) {
    return new Promise((resolve, reject) => {
      console.log('payload', data)
      axios.post('/api/users', {
        name: data.name,
        email: data.email,
        phone: data.phone,
        password: data.password
      })
        .then((response) => {
          commit('ADD_USERS', Object.assign(data,
            {id: response.data.id,
              name: data.name,
              email: data.email,
              phone: data.phone
            }))
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  updateUser (payload, data) {
    return new Promise((resolve, reject) => {
      if (data.new_password !== data.confirm_new_password) {
        reject({message: 'Password doesn\'t match. Please try again.'})
      }
      console.log('payload', data)
      axios.patch(`/api/users/${data.id}`, data)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

  updateCompany (payload, data) {
    return new Promise((resolve, reject) => {
      console.log('payload', data)
      axios.post('/api/updateCompany', data)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

  removeRecord ({ commit }, userId) {
    return new Promise((resolve, reject) => {
      axios.delete(`/api/users/${userId}`)
        .then((response) => {
          commit('REMOVE_RECORD', userId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

  createPayment (payload, data) {
    return new Promise((resolve, reject) => {
      // console.log('payload',data)
      axios.post('/api/createPayment', {
        price: data.price,
        plan_name: data.plan_name
      })
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },


  follow ({ commit }, data) {
    return new Promise((resolve, reject) => {
      console.log('payload', data)
      axios.post('/api/user/follow', data)
        .then((response) => {
          commit('ADD_FOLLOWING', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

  unFollow ({ commit }, data) {
    return new Promise((resolve, reject) => {
      //console.log('payload',data)
      axios.post('/api/user/un-follow', data)
        .then((response) => {
          commit('REMOVE_FOLLOWING', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },


  fetchMyFollowData ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get('/api/user/my-follow-data')
        .then((response) => {
          //console.log('user',response.data.my_following_data)
          commit('SET_FOLLOWING', response.data.my_following_data)
          commit('SET_FOLLOWER', response.data.my_followers_data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

//   fetchPackageInformation ({ commit }) {
//     return new Promise((resolve, reject) => {
//       axios.get('/api/user/my-packages')
//         .then((response) => {
//           //console.log('user',response.data)
//           commit('SET_UPGRADE_PACKAGE_LEFT', response.data.upgradePackage_remaining_days)
//           commit('SET_PROFILE_DOPING_PACKAGE_LEFT', response.data.profileDopingPackage_remaining_days)
//           commit('SET_NEWS_DOPING_PACKAGE_LEFT', response.data.newsDopingPackage_remaining_days)
//           commit('SET_SERVICE_DOPING_PACKAGE_LEFT', response.data.serviceDopingPackage_remaining_days)
//           resolve(response)
//         })
//         .catch((error) => { reject(error) })
//     })
//   },

}
