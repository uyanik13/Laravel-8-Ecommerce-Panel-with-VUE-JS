<!-- =========================================================================================
  File Name: DataListListView.vue
  Description: Data List - List View
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
========================================================================================== -->

<template>
  <div id="data-list-list-view" class="data-list-container">

    <div class="vx-col w-full md:w-12/12 mb-base">

      <vs-tabs position="left" color="danger">
        <vs-tab :label="$t('MyFollowing')"  icon-pack="feather" icon="icon-file-text">
          <my-following-list :user="activeUser" :data="followList" />
        </vs-tab>
        <vs-tab :label="$t('MyFollowers')" icon-pack="feather" icon="icon-briefcase">
          <my-follower-list  :user="activeUser"  :data="followerList" />
        </vs-tab>

      </vs-tabs>
    </div>

  </div>
</template>

<script>
import MyFollowingList from './MyFollowingList.vue'
import MyFollowerList from './MyFollowerList.vue'
import Swal from 'sweetalert2'
import i18n from '@/i18n/i18n'
export default {
  components: {
    MyFollowerList,
    MyFollowingList
  },
  data () {
    return {

    }
  },
  computed: {
    activeUser () {
      return this.$store.state.auth.user
    },
    followerList () {
      return this.$store.state.user.myFollowers
    },
    followList () {
      return this.$store.state.user.myFollows
    }
  },
  methods: {

  },
  created () {
    this.$store.dispatch('user/fetchUser')
    this.$store.dispatch('user/fetchMyFollowData')
  }
}
</script>

