/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/

import axios from 'axios'
export default {
    addItem(context, data) {
        return new Promise((resolve, reject) => {
            axios.post('/api/category', data)
                .then((response) => {
                    context.dispatch('fetchItems')
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },

    fetchItems({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/category')
                .then((response) => {
                    commit('SET_CATEGORIES', response.data)
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },

    updateItem(context, data) {
        return new Promise((resolve, reject) => {
            //console.log('payload',data)
            axios.patch(`/api/category/${data.id}`, data)
                .then((response) => {
                    context.dispatch('fetchItems')
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },

    removeItem(context, itemId) {
        return new Promise((resolve, reject) => {
            axios.delete(`/api/category/${itemId}`)
                .then((response) => {
                    context.dispatch('fetchItems')
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },



}
