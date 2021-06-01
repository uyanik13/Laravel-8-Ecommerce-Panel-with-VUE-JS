/*=========================================================================================
  File Name: moduleSchoolThingsList.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/


import state from './formListState.js'
import mutations from './formListMutations.js'
import actions from './formListActions.js'
import getters from './formListGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}

