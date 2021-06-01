/*=========================================================================================
  File Name: store.js
  Description: Vuex store
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/


import Vue from 'vue'
import Vuex from 'vuex'

import state from './state'
import getters from './getters'
import mutations from './mutations'
import actions from './actions'

Vue.use(Vuex)


//import moduleECommerce from './ecommerce/moduleECommerce.js'
//import tokenModule from './token/token.js'
//import packageModule from './package/package.js'
//import subscriptionModule from './subscription/subscription.js'
//import moduleChat from './chat/moduleChat.js'
//import moduleInvoiceList from './invoices/moduleInvoiceList.js'

import moduleCategory from './category/moduleCategory.js'
import moduleAdmin from './admin/admin.js'
import ModuleGallery from './gallery/galleryModule.js'
import custom from './custom/custom.js'
import formList from './form/formList.js'
import packageModule from './package/package.js'
import setting from './setting/setting.js'
import modulePostList from './post/modulePostList.js'
import moduleUserManagement from './user-management/moduleUserManagement.js'
import moduleAuth from './auth/moduleAuth.js'


export default new Vuex.Store({
    getters,
    mutations,
    state,
    actions,
    modules: {

        // eCommerce: moduleECommerce,
        package: packageModule,
        // subscription: subscriptionModule,
        // invoice: moduleInvoiceList,
        // token: tokenModule,
        // chat: moduleChat,
        category: moduleCategory,
        gallery: ModuleGallery,
        admin: moduleAdmin,
        custom,
        form: formList,
        setting,
        post: modulePostList,
        user: moduleUserManagement,
        auth: moduleAuth
    },
    strict: process.env.NODE_ENV !== 'production'
})
