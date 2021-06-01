/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
==========================================================================================*/

import axios from "axios"

export default {
  addItem({ commit }, data) {
    console.log('data',data)
    return new Promise((resolve, reject) => {
      axios.post(`/api/custom`, data)
        .then((response) => {

          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

  addCategory({ commit }, data) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/addCategory`, data)
        .then((response) => {
          commit('ADD_CATEGORY', Object.assign(data,
            {
              id: response.data.id,
              title: data.title,
              url:data.title,
              seo_title: data.seo_title,
              seo_description: data.seo_description,
            }))
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchItems({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get("/api/custom")
        .then((response) => {
         //console.log('POST ACTION - POSTS:',response.data.posts.data)
          response.data.forEach(element =>{
            //const page = response.data.posts.data.filter(element => element.type === 'page');
            commit('ADD_ITEM', element.JsonData)

          });
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
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
        video: data.video,
        status: data.status
      })
        .then((response) => {
          if(data.type === 'post') commit('UPDATE_ITEM', data)
          if(data.type === 'page') commit('UPDATE_PAGE', data)
          if(data.type === 'category') commit('UPDATE_CATEGORY', data)
          if(data.type === 'certificate') commit('UPDATE_CERTIFICATE', data)
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
  removeCategory({ commit }, itemId) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/removeCategory`, {
        id: itemId,
      })
        .then((response) => {
          commit('REMOVE_CATEGORY', itemId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },


}
