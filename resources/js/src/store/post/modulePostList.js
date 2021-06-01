/*=========================================================================================
  File Name: moduleSchoolThingsList.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/


import state from './modulePostListState.js'
import mutations from './modulePostListMutations.js'
import actions from './modulePostListActions.js'
import getters from './modulePostListGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}

