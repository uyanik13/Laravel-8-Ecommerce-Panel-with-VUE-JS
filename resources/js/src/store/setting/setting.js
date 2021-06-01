/*=========================================================================================
  File Name: setting.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/


import state from './settingState.js'
import mutations from './settingMutations.js'
import actions from './settingActions.js'
import getters from './settingGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}

