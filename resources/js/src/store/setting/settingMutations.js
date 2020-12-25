/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------

  Author: Pixinvent
  Author URL: https://www.dijitalreklam.org
==========================================================================================*/


export default {
  SET_ITEM(state, users) {
    state.settings = users
  },
  REMOVE_RECORD(state, itemId) {
      const userIndex = state.settings.findIndex((u) => u.id == itemId)
      state.settings.splice(userIndex, 1)
  },
}
