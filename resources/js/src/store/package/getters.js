/*=========================================================================================
  File Name: moduleCalendarGetters.js
  Description: Calendar Module Getters
  ----------------------------------------------------------------------------------------

  Author: Pixinvent
  Author URL: https://www.dijitalreklam.org
==========================================================================================*/


export default {
  newsPackage:    (state) =>  state.packages.filter((packageData) => packageData.type === 'news'),
  servicePackage: (state) =>  state.packages.filter((packageData) => packageData.type === 'service'),
  profilePackage: (state) =>  state.packages.filter((packageData) => packageData.type === 'profile'),
  tokenPackage: (state) =>  state.packages.filter((packageData) => packageData.type === 'token'),
  tokenPackagesData: (state) =>state.packages.filter((packageData) => packageData.type === 'token')
    .flatMap(({ id, title, monthly_price }) => Object.assign({ id, title, monthly_price}))
}
