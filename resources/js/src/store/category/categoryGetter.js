/*=========================================================================================
  File Name: moduleCalendarGetters.js
  Description: Calendar Module Getters
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/


export default {

    currentCategory: (state) => (CatID) => state.categories.filter((category) => category.id === CatID)[0],

    getChildCategories: (state) => (CatID) => state.categories.filter((category) => category.parent_id === CatID),



}
