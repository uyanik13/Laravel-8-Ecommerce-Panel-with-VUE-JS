/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/


export default {
  SET_USERS (state, users) {
    state.users = users
  },
  SET_USER (state, users) {
    state.currentUser = users
  },
  SET_FOLLOWER (state, data) {
    state.myFollowers = data
  },
  SET_FOLLOWING (state, data) {
    state.myFollows = data
  },

  SET_UPGRADE_PACKAGE_LEFT (state, data) {
    state.upgradePackage_remaining_days = data
  },
  SET_PROFILE_DOPING_PACKAGE_LEFT (state, data) {
    state.profileDopingPackage_remaining_days = data
  },
  SET_NEWS_DOPING_PACKAGE_LEFT (state, data) {
    state.newsDopingPackage_remaining_days = data
  },
  SET_SERVICE_DOPING_PACKAGE_LEFT (state, data) {
    state.serviceDopingPackage_remaining_days = data
  },


  ADD_USERS (state, item) {
    state.users.unshift(item)
  },
  ADD_USER (state, item) {
    state.currentUser.unshift(item)
  },
  ADD_FOLLOWER (state, item) {
    state.myFollowers.unshift(item)
  },
  ADD_FOLLOWING (state, item) {
    state.myFollows.unshift(item)
  },


  REMOVE_RECORD (state, itemId) {
    const userIndex = state.users.findIndex((u) => u.id == itemId)
    state.users.splice(userIndex, 1)
  },
  REMOVE_USER (state, itemId) {
    const userIndex = state.currentUser.findIndex((u) => u.id == itemId)
    state.currentUser.splice(userIndex, 1)
  },
  REMOVE_FOLLOWER (state, itemId) {
    const userIndex = state.myFollowers.findIndex((u) => u.id == itemId)
    state.myFollowers.splice(userIndex, 1)
  },
  REMOVE_FOLLOWING (state, itemId) {
    const userIndex = state.myFollows.findIndex((u) => u.id == itemId)
    state.myFollows.splice(userIndex, 1)
  }


}
