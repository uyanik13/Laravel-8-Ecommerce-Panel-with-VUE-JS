/*=========================================================================================
  File Name: state.js
  Description: Vuex Store - state
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/

import navbarSearchAndPinList from '@/layouts/components/navbar/navbarSearchAndPinList'
import themeConfig from '@/../themeConfig.js'
import colors from '@/../themeConfig.js'
import Cookies from 'js-cookie'
import axios from 'axios'
import router from '../router'
import moduleAuth from './auth/moduleAuth'
import jwt from '../http/requests/auth/jwt'


// /////////////////////////////////////////////
// Helper
// /////////////////////////////////////////////

// *From Auth - Data will be received from auth provider
const userDefaults = {

}

const userInfoLocalStorage = JSON.parse(localStorage.getItem('userInfo')) || {}

// Set default values for active-user
// More data can be added by auth provider or other plugins/packages
const getUserInfo = () => {
    const userInfo = {}
        // Update property in user
    Object.keys(userDefaults).forEach((key) => {
        // If property is defined in localStorage => Use that
        userInfo[key] = userInfoLocalStorage[key] ? userInfoLocalStorage[key] : userDefaults[key]
    })

    // Include properties from localStorage
    Object.keys(userInfoLocalStorage).forEach((key) => {
        if (userInfo[key] == undefined && userInfoLocalStorage[key] != null) userInfo[key] = userInfoLocalStorage[key]
    })

    return userInfo
}


const is_touch_device = () => {
    const prefixes = ' -webkit- -moz- -o- -ms- '.split(' ')
    const mq = function(query) {
        return window.matchMedia(query).matches
    }

    if ('ontouchstart' in window || window.DocumentTouch) {
        return true
    }

    // include the 'heartz' as a way to have a non matching MQ to help terminate the join
    // https://git.io/vznFH
    const query = ['(', prefixes.join('touch-enabled),('), 'heartz', ')'].join('')
    return mq(query)
}


// /////////////////////////////////////////////
// State
// /////////////////////////////////////////////

const state = {
    AppActiveUser: getUserInfo(),
    ActiveUser: moduleAuth.actions.fetchUser,
    bodyOverlay: false,
    isVerticalNavMenuActive: true,
    locales: ['en', 'tr'],
    is_touch_device: is_touch_device(),
    mainLayoutType: themeConfig.mainLayoutType || 'vertical',
    navbarSearchAndPinList,
    reduceButton: themeConfig.sidebarCollapsed,
    verticalNavMenuWidth: 'default',
    verticalNavMenuItemsMin: false,
    scrollY: 0,
    starredPages: navbarSearchAndPinList['pages'].data.filter((page) => page.is_bookmarked),
    theme: themeConfig.theme || 'light',
    themePrimaryColor: colors.primary,

    // Can be used to get current window with
    // Note: Above breakpoint state is for internal use of sidebar & navbar component
    windowWidth: null
}

export default state
