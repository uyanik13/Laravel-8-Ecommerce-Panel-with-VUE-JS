/*=========================================================================================
  File Name: moduleCalendarGetters.js
  Description: Calendar Module Getters
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/


export default {
  newsPackage:    (state) =>  state.packages.filter((packageData) => packageData.type === 'news'),
  servicePackage: (state) =>  state.packages.filter((packageData) => packageData.type === 'service'),
  profilePackage: (state) =>  state.packages.filter((packageData) => packageData.type === 'profile'),
  tokenPackage: (state) =>  state.packages.filter((packageData) => packageData.type === 'token'),
  tokenPackagesData: (state) =>state.packages.filter((packageData) => packageData.type === 'token')
    .flatMap(({ id, title, monthly_price }) => Object.assign({ id, title, monthly_price}))
}
