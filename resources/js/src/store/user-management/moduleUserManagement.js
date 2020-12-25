/*=========================================================================================
  File Name: moduleUserManagement.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------

  Author: Pixinvent
  Author URL: https://www.dijitalreklam.org
==========================================================================================*/


import state from './moduleUserManagementState.js'
import mutations from './moduleUserManagementMutations.js'
import actions from './moduleUserManagementActions.js'
import getters from './moduleUserManagementGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}

