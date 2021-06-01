/*=========================================================================================
  File Name: moduleSchoolThingsList.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/


import state from './adminState.js'
import mutations from './adminMutations.js'
import actions from './adminActions.js'
import getters from './adminGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}

