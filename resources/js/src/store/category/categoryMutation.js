/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/


export default {
    //ADD ONLY 1 DATA TO ARRAY
    ADD_CATEGORY(state, item) {
        state.categories.unshift(item)
    },


    ///SET MULTIPLE DATA
    SET_CATEGORIES(state, itemData) {
        state.categories = itemData
    },


    //UPDATE DATA IN ARRAY
    UPDATE_CATEGORY(state, item) {
        const itemIndex = state.categories.findIndex((i) => i.id === item.id)
        Object.assign(state.categories[itemIndex], item)
    },


    //REMOVE DATA FROM ARRAY
    REMOVE_CATEGORY(state, itemId) {
        const ItemIndex = state.categories.findIndex((i) => i.id === itemId)
        state.categories.splice(ItemIndex, 1)
    },

}
