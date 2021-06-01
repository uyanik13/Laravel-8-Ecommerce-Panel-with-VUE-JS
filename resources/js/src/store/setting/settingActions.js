/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
==========================================================================================*/

import axios from "axios"

export default {

  addItem({ commit }, data) {
    return new Promise((resolve, reject) => {
      console.log(data)
      axios.post(`/api/setting`, data)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

  fetchItems({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get("/api/setting")
        .then((response) => {
          //console.log('SETTING ACTION - DATA:',response.data)
          commit('SET_ITEM', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  // fetchEventLabels({ commit }) {
  //   return new Promise((resolve, reject) => {
  //     axios.get("/api/apps/calendar/labels")
  //       .then((response) => {
  //         commit('SET_LABELS', response.data)
  //         resolve(response)
  //       })
  //       .catch((error) => { reject(error) })
  //   })
  // },

  updateItem({ commit }, data) {
    return new Promise((resolve, reject) => {
      console.log('payload',data)
      axios.patch(`/api/post/${data.id}`,{
        title: data.title,
        description: data.description,
        category_id: data.category,
        content: data.content,
        seo_title: data.seo_title,
        seo_description: data.seo_description,
        image: data.image,
        status: data.status
      })
        .then((response) => {
          commit('UPDATE_ITEM', data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeItem({ commit }, itemId) {
    return new Promise((resolve, reject) => {
      axios.delete(`/api/post/${itemId}`)
        .then((response) => {
          commit('REMOVE_ITEM', itemId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },



}
