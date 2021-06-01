/*=========================================================================================
  File Name: moduleSchoolThingsList.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/


import state from './categoryState.js'
import mutations from './categoryMutation.js'
import actions from './categoryAction.js'
import getters from './categoryGetter.js'

export default {
    isRegistered: false,
    namespaced: true,
    state: state,
    mutations: mutations,
    actions: actions,
    getters: getters
}
