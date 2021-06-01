/*=========================================================================================
  File Name: moduleCalendarGetters.js
  Description: Calendar Module Getters
  ----------------------------------------------------------------------------------------

  Author: uyanik13
  Author URL: https://github.com/uyanik13
==========================================================================================*/


export default {
  myFollower: (state) => state.myFollowers,
  myFollowing: (state) => state.myFollows,
  amIFollowing: (state) => id => state.myFollows
    .includes(state.myFollows.find((user) => user.id === id)),
  allUsersCount: (state) => state.users.length,
  allUsersToken: (state) =>  state.users.flatMap(user => user['token']),

}
