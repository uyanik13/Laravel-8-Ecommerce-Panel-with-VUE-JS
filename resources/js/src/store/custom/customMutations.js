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
    state.bayiler.unshift(item)
  },
  ADD_SLIDER(state, item) {
    state.HomePageSlider.unshift(item)
  },
  ADD_CATEGORY(state, item) {
    state.categories.unshift(item)
  },
  ADD_PRODUCT(state, item) {
    state.products.unshift(item)
  },
  ADD_CERTIFICATE(state, item) {
    state.certificates.unshift(item)
  },


  //ADD ALL DATA TO ARRAY
  SET_ITEM(state, itemData) {
    state.bayiler = itemData
  },
  SET_CATEGORIES(state, itemData) {
    state.categories = itemData
  },
  SET_PAGES(state, itemData) {
    state.HomePageSlider = itemData
  },
  SET_PRODUCTS(state, itemData) {
    state.products = itemData
  },
  SET_CERTIFICATE(state, itemData) {
    state.certificates = itemData
  },

  //UPDATE DATA IN ARRAY
  UPDATE_ITEM(state, item) {
      const itemIndex = state.bayiler.findIndex((i) => i.id === item.id)
      Object.assign(state.bayiler[itemIndex], item)
  },

  UPDATE_SLIDER(state, item) {
    const itemIndex = state.HomePageSlider.findIndex((i) => i.id === item.id)
    Object.assign(state.HomePageSlider[itemIndex], item)
  },

  UPDATE_CATEGORY(state, item) {
    const itemIndex = state.categories.findIndex((i) => i.id === item.id)
    Object.assign(state.categories[itemIndex], item)
  },
  UPDATE_PRODUCT(state, item) {
    const itemIndex = state.products.findIndex((i) => i.id === item.id)
    Object.assign(state.products[itemIndex], item)
  },
  UPDATE_CERTIFICATE(state, item) {
    const itemIndex = state.certificates.findIndex((i) => i.id === item.id)
    Object.assign(state.certificates[itemIndex], item)
  },



  //REMOVE DATA FROM ARRAY
  REMOVE_ITEM(state, itemId) {
      const ItemIndex = state.bayiler.findIndex((i) => i.id === itemId)
      state.bayiler.splice(ItemIndex, 1)
  },

  REMOVE_SLIDER(state, itemId) {
    const ItemIndex = state.HomePageSlider.findIndex((i) => i.id === itemId)
    state.HomePageSlider.splice(ItemIndex, 1)
  },

  REMOVE_CATEGORY(state, itemId) {
    const ItemIndex = state.categories.findIndex((i) => i.id === itemId)
    state.categories.splice(ItemIndex, 1)
  },

  REMOVE_PRODUCT(state, itemId) {
    const ItemIndex = state.products.findIndex((i) => i.id === itemId)
    state.products.splice(ItemIndex, 1)
  },
  REMOVE_CERTIFICATE(state, itemId) {
    const ItemIndex = state.certificates.findIndex((i) => i.id === itemId)
    state.certificates.splice(ItemIndex, 1)
  },
}
