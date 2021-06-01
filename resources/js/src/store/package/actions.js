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
            axios.post('/api/package', data)
                .then((response) => {
                    context.dispatch('fetchItems')
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },


    fetchItems({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/package')
                .then((response) => {
                    // console.log('data from content',response.data)
                    commit('SET_ITEM', response.data)
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },


    updateItem(context, data) {
        return new Promise((resolve, reject) => {
            //console.log('payload',data)
            axios.patch(`/api/package/${data.id}`, data)
                .then((response) => {
                    context.dispatch('fetchItems')
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },


    removeItem(context, itemId) {
        return new Promise((resolve, reject) => {
            axios.delete(`/api/package/${itemId}`)
                .then((response) => {
                    context.dispatch('fetchItems')
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    }


}
