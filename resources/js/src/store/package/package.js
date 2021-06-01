/*=========================================================================================
  File Name: moduleSchoolThingsList.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/


import state from './state.js'
import mutations from './mutations.js'
import actions from './actions.js'
import getters from './getters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}

