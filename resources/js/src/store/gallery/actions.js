/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
==========================================================================================*/

import axios from "axios"

export default {
  addItem(context, data) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/gallery`, data)
        .then((response) => {
          context.dispatch('fetchItems')
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },


  fetchItems({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get("/api/gallery")
        .then((response) => {
          //console.log('response gallery',response.data)
          commit('SET_ITEM', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

  removeItem(context, itemId) {
    return new Promise((resolve, reject) => {
      axios.delete(`/api/gallery/${itemId}`)
        .then((response) => {
          context.dispatch('fetchItems')
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

  updateItem (context, data) {
    return new Promise((resolve, reject) => {
      //console.log('payload',data)
      axios.patch(`/api/gallery/${data.id}`, data)
        .then((response) => {
            context.dispatch('fetchItems')
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

  searchItems({ commit },key) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/mediaSearch/${key}`)
        .then((response) => {
          //console.log('response gallery',response.data)
          commit('SET_ITEM', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

  changePage({ commit },nextPageUrl) {
    return new Promise((resolve, reject) => {
     axios.get(nextPageUrl).then((response) => {
          commit('SET_ITEM', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

  showPage({ commit },page) {
    return new Promise((resolve, reject) => {
     axios.get(`/api/gallery?page=${page}`).then((response) => {
          commit('SET_ITEM', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

}
