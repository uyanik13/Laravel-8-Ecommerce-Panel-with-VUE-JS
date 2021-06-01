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
    state.formList.unshift(item)
  },


  //ADD ALL DATA TO ARRAY
  SET_ITEM(state, itemData) {
    state.formList = itemData
  },


  //UPDATE DATA IN ARRAY
  UPDATE_ITEM(state, item) {
      const itemIndex = state.formList.findIndex((i) => i.id === item.id)
      Object.assign(state.formList[itemIndex], item)
  },

  //REMOVE DATA FROM ARRAY
  REMOVE_ITEM(state, itemId) {
      const ItemIndex = state.formList.findIndex((i) => i.id === itemId)
      state.formList.splice(ItemIndex, 1)
  },
}
