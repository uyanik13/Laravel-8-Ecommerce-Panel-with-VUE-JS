/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
==========================================================================================*/


export default {
  //ADD ONLY 1 DATA TO ARRAY
  ADD_ITEM(state, item) {
    state.posts.unshift(item)
  },
  ADD_PAGE(state, item) {
    state.pages.unshift(item)
  },
  ADD_MY_POST (state, item) {
    state.myPosts.unshift(item)
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
  ADD_SERVICE(state, item) {
    state.services.unshift(item)
  },
  ADD_CONTRACT(state, item) {
    state.myContracts.unshift(item)
  },



  ///SET
  SET_MyServices(state,itemData) {
    state.myServices = itemData
  },
  SET_CONTRACTS(state,itemData) {
    state.myContracts = itemData
  },
  SET_MyPosts (state, itemData) {
    state.myPosts = itemData
  },
  SET_ITEM(state, itemData) {
    state.posts = itemData
  },
  SET_PORTFOLIOS(state, itemData) {
    state.portfolios = itemData
  },
  SET_CATEGORIES(state, itemData) {
    state.categories = itemData
  },
  SET_PAGES(state, itemData) {
    state.pages = itemData
  },
  SET_PRODUCTS(state, itemData) {
    state.products = itemData
  },
  SET_CERTIFICATE(state, itemData) {
    state.certificates = itemData
  },
  SET_SERVICES(state, itemData) {
    state.services = itemData
  },
  SET_COUNTRIES(state, itemData) {
    state.countries = itemData
  },
  SET_CITIES(state, itemData) {
    state.cities = itemData
  },


  //UPDATE DATA IN ARRAY
  UPDATE_ITEM(state, item) {
      const itemIndex = state.posts.findIndex((i) => i.id === item.id)
      Object.assign(state.posts[itemIndex], item)
  },

  UPDATE_PAGE(state, item) {
    const itemIndex = state.pages.findIndex((i) => i.id === item.id)
    Object.assign(state.pages[itemIndex], item)
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
  UPDATE_SERVICES(state, item) {
    const itemIndex = state.services.findIndex((i) => i.id === item.id)
    Object.assign(state.services[itemIndex], item)
  },
  UPDATE_CONTRACTS(state, item) {
    const itemIndex = state.myContracts.findIndex((i) => i.id === item.id)
    Object.assign(state.myContracts[itemIndex], item)
  },



  //REMOVE DATA FROM ARRAY
  REMOVE_ITEM(state, itemId) {
      const ItemIndex = state.posts.findIndex((i) => i.id === itemId)
      state.posts.splice(ItemIndex, 1)
  },

  REMOVE_PAGE(state, itemId) {
    const ItemIndex = state.pages.findIndex((i) => i.id === itemId)
    state.pages.splice(ItemIndex, 1)
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
  REMOVE_SERVICE(state, itemId) {
    const ItemIndex = state.services.findIndex((i) => i.id === itemId)
    state.services.splice(ItemIndex, 1)
  },
  REMOVE_CONTRACT(state, itemId) {
    const ItemIndex = state.myContracts.findIndex((i) => i.id === itemId)
    state.myContracts.splice(ItemIndex, 1)
  },
}
