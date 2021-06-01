/*=========================================================================================
  File Name: moduleAuth.js
  Description: Auth Module
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/


import state from './moduleAuthState.js'
import mutations from './moduleAuthMutations.js'
import actions from './moduleAuthActions.js'
import getters from './moduleAuthGetters.js'

export default {
	namespaced: true,
    state: state,
    mutations: mutations,
    actions: actions,
    getters: getters
}
