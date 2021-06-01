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
            axios.post('/api/post', data)
                .then((response) => {
                    context.dispatch('fetchItems')
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },
    addCategory(context, data) {
        return new Promise((resolve, reject) => {
            axios.post('/api/addCategory', data)
                .then((response) => {
                    context.dispatch('fetchItems')
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },
    fetchItems({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/post')
                .then((response) => {
                    //console.log('POST ACTION - POSTS:', response.data)
                    commit('SET_PAGES', response.data.pages)
                    commit('SET_ITEM', response.data.posts)
                    commit('SET_PORTFOLIOS', response.data.portfolios)
                    commit('SET_SERVICES', response.data.services)
                    commit('SET_PRODUCTS', response.data.products)
                    commit('SET_CATEGORIES', response.data.categories)
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },
    updateItem(context, data) {
        return new Promise((resolve, reject) => {
            //console.log('payload',data)
            axios.patch(`/api/post/${data.id}`, data)
                .then((response) => {
                    context.dispatch('fetchItems')
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },
    removeItem(context, itemId) {
        return new Promise((resolve, reject) => {
            axios.delete(`/api/post/${itemId}`)
                .then((response) => {
                    context.dispatch('fetchItems')
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },
    copyItem(context, itemId) {
        return new Promise((resolve, reject) => {
            axios.post(`/api/copy-post/${itemId}`)
                .then((response) => {
                    context.dispatch('fetchItems')
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },
    removeCategory({ commit }, itemId) {
        return new Promise((resolve, reject) => {
            axios.post('/api/removeCategory', {
                    id: itemId
                })
                .then((response) => {
                    commit('REMOVE_CATEGORY', itemId)
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },

    updateCategory(context, data) {
        return new Promise((resolve, reject) => {
            //console.log('payload',data)
            axios.post(`/api/updateCategory/`, data)
                .then((response) => {
                    context.dispatch('fetchItems')
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },

    removeProductGalleryImage(context, data) {
        console.log(data)
        return new Promise((resolve, reject) => {
            axios.post(`/api/removeProductGalleryImage`, data)
                .then((response) => {
                    context.dispatch('fetchItems')
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },

    //Custom
    fetchMyCases({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/cases/my-cases')
                .then((response) => {
                    // console.log('POST ACTION - POSTS:',response.data.posts)
                    response.data.posts.forEach(element => {
                        const service = response.data.posts.filter(element => element.type === 'service')
                        commit('SET_MyServices', service)
                    })
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },

    fetchMyContracts({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/contract')
                .then((response) => {
                    // console.log('POST ACTION - CONTRACTS:',response.data)
                    commit('SET_CONTRACTS', response.data)

                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },

    createContract({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios.post('/api/contract', data)
                .then((response) => {
                    commit('ADD_CONTRACT', Object.assign(data, {
                        id: response.data.id,
                        post_id: data.post_id,
                        from: data.id
                    }))
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },

    updateContract({ commit }, data) {
        return new Promise((resolve, reject) => {
            //console.log('payload',data)
            axios.patch(`/api/contract/${data.id}`, data)
                .then((response) => {
                    commit('UPDATE_CONTRACTS', data)
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },

    fetchCountries({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/geo')
                .then((response) => {
                    // console.log('POST ACTION - POSTS:',response.data)
                    commit('SET_COUNTRIES', response.data)
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },

    fetchCities({ commit }, data) {
        return new Promise((resolve, reject) => {
            //console.log('payload',data)
            axios.get(`/geo/${data}`)
                .then((response) => {
                    commit('SET_CITIES', response.data)
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },

    filterData(data) {
        if (data.category_id == []) return false
    }

}
