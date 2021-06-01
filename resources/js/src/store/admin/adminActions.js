/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
==========================================================================================*/

import axios from 'axios'

export default {

  fetchItems ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get('/api/admin')
        .then((response) => {
          commit('SET_ACTIVE_USERS', response.data.activeUsers)
          commit('SET_STAFF', response.data.staff)
          commit('SET_ORDERS', response.data.orders)
          commit('SET_PAYMENTS', response.data.payments)
          commit('SET_RECURRING_PAYMENTS', response.data.recurringPayments)
          commit('SET_PAYMENTS_PAGINATED', response.data.paymentsPaginated)
          commit('SET_LAST_YEAR_PAYMENTS', response.data.lastYearPayments)
          commit('SET_LAST_WEEK_PAYMENTS', response.data.lastWeekPayments)
          commit('SET_LAST_MONTH_PAYMENTS', response.data.lastMonthPayments)
          commit('SET_THIS_MONTH_PAYMENTS', response.data.thisMonthPayments)
          commit('SET_COUNTRIES', response.data.countries)
          commit('SET_AVERAGE_PAYMENTS', response.data.averageWeeklySalesRevenue)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

  fetchStaffItems ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get('/api/staff')
        .then((response) => {
          commit('SET_ACTIVE_USERS', response.data.activeUsers)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

  updateOrder ({ commit }, data) {
    return new Promise((resolve, reject) => {
      axios.patch(`/api/order/${data.id}`, data)
        .then((response) => {
          console.log('payload', response.data)
          commit('UPDATE_ORDER', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

  addUser (context, data) {
    return new Promise((resolve, reject) => {
      console.log('payload', data)
      axios.post('/api/users', data)
        .then((response) => context.dispatch('fetchItems'))
          resolve(response)
        })
        .catch((error) => { reject(error) })
  },

  updateUser (context, data) {
    return new Promise((resolve, reject) => {
      if (data.new_password !== data.confirm_new_password) {
        reject({message: 'Password doesn\'t match. Please try again.'})
      }
      console.log('payload', data)
      axios.patch(`/api/users/${data.id}`, data)
        .then((response) => {
            context.dispatch('fetchItems')
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },


  removeRecord (context, userId) {
    return new Promise((resolve, reject) => {
      axios.delete(`/api/users/${userId}`)
        .then((response) => {
            context.dispatch('fetchItems')
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },

}
