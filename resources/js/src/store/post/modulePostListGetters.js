/*=========================================================================================
  File Name: moduleCalendarGetters.js
  Description: Calendar Module Getters
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/


export default {
    // getItem: state => (productId) => state.products.find((product) => product.id == productId),

    openCases: (state) => state.services.filter((service) => service.status === 1),

    myCases: (state) => state.myServices,

    currentCategory: (state) => (CatID) => state.categories.filter((category) => category.id === CatID)[0],

    getChildCategories: (state) => (CatID) => state.categories.filter((category) => category.parent_id === CatID),

    myCasesTitle: (state) => state.myServices.flatMap(service => service['title']),

    myPosts: (state) => (userId) => state.posts.filter((post) => post.user_id === userId),

    pages: (state) => (userId) => state.posts.filter((post) => post.user_id === userId),

    myCasesId: (state) => state.myServices.flatMap(service => service['id']),

    myCasesTitleAndId: (state) => state.myServices.flatMap(({ id, title }) => Object.assign({ id, title })),

    emergencyCases: (state) => state.services.filter((service) => service.status === 1 && service.emergency === 1),

    randomOpenCases: (state, getters) => getters.openCases.sort(() => Math.random() - Math.random()).slice(0, 12),

    randomEmergencyOpenCases: (state, getters) => getters.emergencyCases.sort(() => Math.random() - Math.random()).slice(0, 12)

}
