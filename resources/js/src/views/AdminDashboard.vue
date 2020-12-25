<!-- =========================================================================================
    File Name: DashboardEcommerce.vue
    Description: Dashboard - Ecommerce
    ----------------------------------------------------------------------------------------

      
    
========================================================================================== -->

<template>
    <div>
        <div class="vx-row">

             <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base">
                <statistics-card-line
                  icon="UserPlusIcon"
                  :statistic="allUsersCount | k_formatter"
                  :statisticTitle="$t('AllUsers')"
                  color="success"
                  type="area" />
            </div>








        </div>


    </div>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import VueApexCharts from 'vue-apexcharts'
import StatisticsCardLine from '@/components/statistics-cards/StatisticsCardLine.vue'
import ChangeTimeDurationDropdown from '@/components/ChangeTimeDurationDropdown.vue'
import i18n from '@/i18n/i18n'

export default{
  components: {
    VueApexCharts,
    StatisticsCardLine,
    VuePerfectScrollbar,
    ChangeTimeDurationDropdown
  },
  data () {
    return {
        isMounted : false,
      settings: { // perfectscrollbar settings
        maxScrollbarLength: 60,
        wheelSpeed: .60
      },
     }
  },
  computed: {
    scrollbarTag () { return this.$store.getters.scrollbarTag },
    allUsersCount () {
      return this.$store.getters['user/allUsersCount']
    }

  },
  methods : {

  },
  watch: {
    isMounted () {
        //this.countriesSet()
    },
  },
  mounted () {
   this.isMounted= true

  },
  created () {
    this.$store.dispatch('user/fetchUsers')
    //this.$store.dispatch('admin/fetchItems')

  }
}
</script>

<style lang="scss">
.chat-card-log {
    height: 400px;

    .chat-sent-msg {
        background-color: #f2f4f7 !important;
    }
}
</style>
