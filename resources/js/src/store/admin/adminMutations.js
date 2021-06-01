/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
==========================================================================================*/


export default {
  //ADD ONLY 1 DATA TO ARRAY
  ADD_PAYMENT (state, item) {
    state.payments.unshift(item)
  },
  ADD_ORDER (state, item) {
    state.orders.unshift(item)
  },
  ADD_TOTAL_AMOUNT (state, item) {
    state.totalAmount = item
  },
  ADD_CATEGORY (state, item) {
    state.categories.unshift(item)
  },
  ADD_PRODUCT (state, item) {
    state.products.unshift(item)
  },
  ADD_CERTIFICATE (state, item) {
    state.certificates.unshift(item)
  },



  //ADD ALL DATA TO ARRAY
  SET_ACTIVE_USERS (state, itemData) {
    state.activeUsers = itemData
  },
  SET_STAFF (state, itemData) {
    state.staff = itemData
  },
  SET_PAYMENTS (state, itemData) {
    state.payments = itemData
  },

  SET_RECURRING_PAYMENTS (state, itemData) {
    state.recurringPayments = itemData
  },

  SET_LAST_YEAR_PAYMENTS (state, itemData) {
    state.lastYearPayments = itemData
  },
  SET_LAST_WEEK_PAYMENTS (state, itemData) {
    state.lastWeekPayments = itemData
  },
  SET_LAST_MONTH_PAYMENTS (state, itemData) {
    state.lastMonthPayments = itemData
  },
  SET_THIS_MONTH_PAYMENTS (state, itemData) {
    state.thisMonthPayments = itemData
  },
  SET_COUNTRIES (state, itemData) {
    state.countries = itemData
  },
  SET_PAYMENTS_PAGINATED (state, itemData) {
    state.paymentsPaginated = itemData
  },

  SET_AVERAGE_PAYMENTS (state, itemData) {
    state.averageWeeklySalesRevenue = itemData
  },

  SET_ORDERS (state, itemData) {
    state.orders = itemData
  },
  SET_CATEGORIES (state, itemData) {
    state.categories = itemData
  },
  SET_PAGES (state, itemData) {
    state.HomePageSlider = itemData
  },
  SET_PRODUCTS (state, itemData) {
    state.products = itemData
  },
  SET_CERTIFICATE (state, itemData) {
    state.certificates = itemData
  },



  //UPDATE DATA IN ARRAY
  UPDATE_PAYMENTS (state, item) {
    const itemIndex = state.payments.findIndex((i) => i.id === item.id)
    Object.assign(state.payments[itemIndex], item)
  },
  UPDATE_ORDER (state, item) {
    const itemIndex = state.orders.findIndex((i) => i.id === item.id)
    Object.assign(state.orders[itemIndex], item)
  },

  UPDATE_SLIDER (state, item) {
    const itemIndex = state.HomePageSlider.findIndex((i) => i.id === item.id)
    Object.assign(state.HomePageSlider[itemIndex], item)
  },

  UPDATE_CATEGORY (state, item) {
    const itemIndex = state.categories.findIndex((i) => i.id === item.id)
    Object.assign(state.categories[itemIndex], item)
  },
  UPDATE_PRODUCT (state, item) {
    const itemIndex = state.products.findIndex((i) => i.id === item.id)
    Object.assign(state.products[itemIndex], item)
  },
  UPDATE_CERTIFICATE (state, item) {
    const itemIndex = state.certificates.findIndex((i) => i.id === item.id)
    Object.assign(state.certificates[itemIndex], item)
  },




  //REMOVE DATA FROM ARRAY
  REMOVE_ITEM (state, itemId) {
    const ItemIndex = state.bayiler.findIndex((i) => i.id === itemId)
    state.bayiler.splice(ItemIndex, 1)
  },

  REMOVE_SLIDER (state, itemId) {
    const ItemIndex = state.HomePageSlider.findIndex((i) => i.id === itemId)
    state.HomePageSlider.splice(ItemIndex, 1)
  },

  REMOVE_CATEGORY (state, itemId) {
    const ItemIndex = state.categories.findIndex((i) => i.id === itemId)
    state.categories.splice(ItemIndex, 1)
  },

  REMOVE_PRODUCT (state, itemId) {
    const ItemIndex = state.products.findIndex((i) => i.id === itemId)
    state.products.splice(ItemIndex, 1)
  },
  REMOVE_CERTIFICATE (state, itemId) {
    const ItemIndex = state.certificates.findIndex((i) => i.id === itemId)
    state.certificates.splice(ItemIndex, 1)
  }
}
