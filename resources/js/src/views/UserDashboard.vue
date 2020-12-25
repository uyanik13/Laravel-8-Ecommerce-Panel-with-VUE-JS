<!-- =========================================================================================
  File Name: DashboardAnalytics.vue
  Description: Dashboard Analytics
  ----------------------------------------------------------------------------------------

  
  
========================================================================================== -->

<template>
  <div id="dashboard-analytics">
    <div class="vx-row">

      <!-- CARD 1: CONGRATS -->
      <div class="vx-col w-full lg:w-1/1 mb-base">
        <vx-card slot="no-body" class="text-center bg-primary-gradient greet-user">
                    <img src="@assets/images/elements/decore-left.png" class="decore-left" alt="Decore Left" width="200" >
                    <img src="@assets/images/elements/decore-right.png" class="decore-right" alt="Decore Right" width="175">
          <feather-icon icon="AwardIcon" class="p-6 mb-8 bg-primary inline-flex rounded-full text-white shadow" svgClasses="h-8 w-8"></feather-icon>
          <h1 class="mb-6 text-white">{{$t('Welcome')}} {{ activeUser.name }}</h1>
          <!-- <p class="xl:w-3/4 lg:w-4/5 md:w-2/3 w-4/5 mx-auto text-white">{{$t('underWelcomeText')}}</p> -->
        </vx-card>
      </div>



  </div>
  </div>
</template>

<script>

import Cookies from 'js-cookie'
export default {
  data () {
    return {

    }
  },
  components: {

  },
  computed : {
    activeUser () {
      return  Cookies.get('user') ? JSON.parse(Cookies.get('user')) :  this.$store.state.auth.user
    },

  },
  methods:{

  },
  created () {

  }
}
</script>

<style lang="scss">
/*! rtl:begin:ignore */
#dashboard-analytics {
  .greet-user{
    position: relative;

    .decore-left{
      position: absolute;
      left:0;
      top: 0;
    }
    .decore-right{
      position: absolute;
      right:0;
      top: 0;
    }
  }

  @media(max-width: 576px) {
    .decore-left, .decore-right{
      width: 140px;
    }
  }
}
/*! rtl:end:ignore */
</style>
