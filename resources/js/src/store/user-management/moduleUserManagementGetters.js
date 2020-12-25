/*=========================================================================================
  File Name: moduleCalendarGetters.js
  Description: Calendar Module Getters
  ----------------------------------------------------------------------------------------

  Author: Pixinvent
  Author URL: https://www.dijitalreklam.org
==========================================================================================*/


export default {
  myFollower: (state) => state.myFollowers,
  myFollowing: (state) => state.myFollows,
  amIFollowing: (state) => id => state.myFollows
    .includes(state.myFollows.find((user) => user.id === id)),
  allUsersCount: (state) => state.users.length,
  allUsersToken: (state) =>  state.users.flatMap(user => user['token']),

}
