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
    state.galleryList.unshift(item)
  },


  //ADD ALL DATA TO ARRAY
  SET_ITEM(state, itemData) {
    state.galleryList = itemData
  },


  //UPDATE DATA IN ARRAY
  UPDATE_ITEM(state, item) {
      const itemIndex = state.galleryList.findIndex((i) => i.id === item.id)
      Object.assign(state.galleryList[itemIndex], item)
  },

  //REMOVE DATA FROM ARRAY
  REMOVE_ITEM(state, itemId) {
      const ItemIndex = state.galleryList.findIndex((i) => i.id === itemId)
      state.galleryList.splice(ItemIndex, 1)
  },
}
