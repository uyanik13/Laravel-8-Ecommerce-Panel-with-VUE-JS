/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/


export default {
  //ADD ONLY 1 DATA TO ARRAY
  ADD_ITEM(state, item) {
    state.packages.unshift(item)
  },


  //ADD ALL DATA TO ARRAY
  SET_ITEM(state, itemData) {
    state.packages = itemData
  },


  //UPDATE DATA IN ARRAY
  UPDATE_ITEM(state, item) {
      const itemIndex = state.packages.findIndex((i) => i.id === item.id)
      Object.assign(state.packages[itemIndex], item)
  },

  //REMOVE DATA FROM ARRAY
  REMOVE_ITEM(state, itemId) {
      const ItemIndex = state.packages.findIndex((i) => i.id === itemId)
      state.packages.splice(ItemIndex, 1)
  },
}
