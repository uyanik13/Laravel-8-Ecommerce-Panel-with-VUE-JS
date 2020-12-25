/*=========================================================================================
  File Name: moduleCalendarGetters.js
  Description: Calendar Module Getters
  ----------------------------------------------------------------------------------------

  Author: Pixinvent
  Author URL: https://www.dijitalreklam.org
==========================================================================================*/


export default {

    currentCategory: (state) => (CatID) => state.categories.filter((category) => category.id === CatID)[0],

    getChildCategories: (state) => (CatID) => state.categories.filter((category) => category.parent_id === CatID),



}
