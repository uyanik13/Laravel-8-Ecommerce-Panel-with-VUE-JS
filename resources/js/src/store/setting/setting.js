/*=========================================================================================
  File Name: setting.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------

  Author: Pixinvent
  Author URL: https://www.dijitalreklam.org
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

