<!-- =========================================================================================
    File Name: DashboardEcommerce.vue
    Description: Dashboard - Ecommerce
    ----------------------------------------------------------------------------------------

      
    
========================================================================================== -->

<template>
    <div>
        <div class="vx-row mt-8">

             <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base">
                <statistics-card-line
                  v-if="lastWeekPaymentsStatisticData()"
                  icon="DollarSignIcon"
                  :statistic="lastWeekPaymentsAmount | k_formatter"
                  :statisticTitle="$t('lastWeekPayments')"
                  :chartData="lastWeekPaymentsStatisticData()"
                   color="danger"
                  type="area" />
            </div>
             <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base">
                <statistics-card-line
                  v-if="lasMonthPaymentsStatisticData()"
                  icon="DollarSignIcon"
                  :statistic="lastMonthPaymentsAmount | k_formatter"
                  :statisticTitle="$t('lastMonthPayments')"
                  :chartData="lasMonthPaymentsStatisticData()"
                  color="warning"
                  type="area" />
            </div>


             <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base">
                <statistics-card-line

                  icon="DollarSignIcon"
                  :statistic="averageWeeklySalesRevenue ? parseInt(averageWeeklySalesRevenue) : 0 | k_formatter"
                  :statisticTitle="$t('averageWeeklyRevenue')"
                  color="success"
                  type="area" />
            </div>


          <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base">
                <statistics-card-line
                  icon="UserPlusIcon"
                  :statistic="allUsersCount | k_formatter"
                  :statisticTitle="$t('AllUsers')"
                  color="success"
                  type="area" />
            </div>






        <div class="vx-col w-full md:w-1/1 mb-base">
                <vx-card title="Monthly Revenue">
                    <!-- <template slot="actions">
                        <feather-icon icon="SettingsIcon" svgClasses="w-6 h-6 text-grey"></feather-icon>
                    </template> -->
                    <div slot="no-body" class="p-6 pb-0">
                        <div class="flex" v-if="lastMonthPaymentsAmount">
                            <div class="mr-6">
                                <p class="mb-1 font-semibold">{{$t('thisMonth')}}</p>
                                <p class="text-3xl text-success"><sup class="text-base mr-1">€</sup>{{ thisMonthPaymentsAmount.toLocaleString() }}</p>
                            </div>
                            <div>
                                 <p class="mb-1 font-semibold">{{$t('lastMonth')}}</p>
                                <p class="text-3xl"><sup class="text-base mr-1">€</sup>{{ lastMonthPaymentsAmount.toLocaleString() }}</p>
                            </div>
                        </div>

                         <vue-apex-charts
                          type="line"
                          height="266"
                          :options="revenueComparisonLine.chartOptions"
                          :series="setDataForMonthlySeries()" />

                    </div>
                </vx-card>
            </div>



        <div class="vx-col w-full md:w-1/1 mb-base">
              <vx-card title="Yearly Revenue">
                    <!-- <template slot="actions">
                        <feather-icon icon="SettingsIcon" svgClasses="w-6 h-6 text-grey"></feather-icon>
                    </template> -->
                    <div slot="no-body" class="p-6 pb-0">
                        <div class="flex" v-if="lastYearPaymentsStatisticData()">

                              <div class="mr-6">
                                <p class="mb-1 font-semibold">{{$t('thisYear')}}</p>
                                <p class="text-3xl text-success"><sup class="text-base mr-1">€</sup>{{ lastYearPaymentsAmount.toLocaleString() }}</p>
                            </div>

                        </div>

                         <vue-apex-charts
                          type="line"
                          height="266"
                          :options="revenueComparisonLineYearly.chartOptions"
                          :series="setDataForYearlySeries()" />

                    </div>
                </vx-card>
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

      itemsPerPage: 5,
      isMounted: false,
      settings: { // perfectscrollbar settings
        maxScrollbarLength: 60,
        wheelSpeed: .60
      },

  revenueComparisonLine: {
    chartOptions: {
      chart: {
        toolbar: { show: false },
        dropShadow: {
          enabled: true,
          top: 5,
          left: 0,
          blur: 4,
          opacity: 0.10
        }
      },
      stroke: {
        curve: 'smooth',
        dashArray: [0, 8],
        width: [4, 2]
      },
      grid: {
        borderColor: '#e7e7e7'
      },
      legend: {
        show: false
      },
      colors: ['#F97794', '#b8c2cc'],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          inverseColors: false,
          gradientToColors: ['#7367F0', '#b8c2cc'],
          shadeIntensity: 1,
          type: 'horizontal',
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100, 100, 100]
        }
      },
      markers: {
        size: 0,
        hover: {
          size: 5
        }
      },
      xaxis: {
        labels: {
          style: {
            cssClass: 'text-grey fill-current'
          }
        },
        axisTicks: {
          show: false
        },
        categories: [],
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        tickAmount: 5,
        labels: {
          style: {
            cssClass: 'text-grey fill-current'
          },
          formatter (val) {
            return val > 999 ? `${(val / 1000).toFixed(1)}k` : val
          }
        }
      },
      tooltip: {
        x: { show: false }
      }
    }
  },
  revenueComparisonLineYearly: {
    chartOptions: {
      chart: {
        toolbar: { show: false },
        dropShadow: {
          enabled: true,
          top: 5,
          left: 0,
          blur: 4,
          opacity: 0.10
        }
      },
      stroke: {
        curve: 'smooth',
        dashArray: [0, 8],
        width: [4, 2]
      },
      grid: {
        borderColor: '#e7e7e7'
      },
      legend: {
        show: false
      },
      colors: ['#F97794', '#b8c2cc'],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          inverseColors: false,
          gradientToColors: ['#7367F0', '#b8c2cc'],
          shadeIntensity: 1,
          type: 'horizontal',
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100, 100, 100]
        }
      },
      markers: {
        size: 0,
        hover: {
          size: 5
        }
      },
      xaxis: {
        labels: {
          style: {
            cssClass: 'text-grey fill-current'
          }
        },
        axisTicks: {
          show: false
        },
        categories: [],
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        tickAmount: 5,
        labels: {
          style: {
            cssClass: 'text-grey fill-current'
          },
          formatter (val) {
            return val > 999 ? `${(val / 1000).toFixed(1)}k` : val
          }
        }
      },
      tooltip: {
        x: { show: false }
      }
    }
  },
   SalesCountryPerformance: {
    series: [],
    chartOptions: {
      labels: [],
      dataLabels: {
        enabled: false
      },
      legend: { show: false },
      chart: {
        type: 'pie',
        offsetY: 0,
        dropShadow: {
          enabled: false,
          blur: 5,
          left: 1,
          top: 1,
          opacity: 0.2
        },
        toolbar: {
          show: false
        }
      },
      stroke: {
        width: 5
      },
      colors: ['#7961F9', '#FF9F43', '#EA5455'],
      fill: {
        type: 'gradient',
        gradient: {
          gradientToColors: ['#9c8cfc', '#FFC085', '#f29292']
        }
      }
    }
  },
    }
  },
  computed: {
    scrollbarTag () { return this.$store.getters.scrollbarTag },
    allUsersCount () {
        this.countriesSet()
      return this.$store.getters['user/allUsersCount']
    },
    completedPayments () {
      return this.$store.getters['admin/completedPayments']
    },
    completedPaymentsCountries () {
      return this.$store.getters['admin/completedPaymentsCountries']
    },
    lastWeekPaymentsAmount () {
      return this.$store.getters['admin/lastWeekPaymentsAmount']
    },
    lastMonthPaymentsAmount () {
      return this.$store.getters['admin/lastMonthPaymentsAmount']
    },
    thisMonthPaymentsAmount () {
      return this.$store.getters['admin/thisMonthPaymentsAmount']
    },
    lastYearPaymentsAmount () {
      return this.$store.getters['admin/lastYearPaymentsAmount']
    },
    averageWeeklySalesRevenue () {
      return this.$store.state.admin.averageWeeklySalesRevenue
    },



  },
  methods : {
    chartDataForLastWeekPayments () {
      return this.$store.getters['admin/chartDataForLastWeekPayments']
    },
    chartDataForLastMonthPayments () {
      return this.$store.getters['admin/chartDataForLastMonthPayments']
    },
    chartDataForThisMonthPayments () {
      return this.$store.getters['admin/chartDataForThisMonthPayments']
    },
    chartDataForLastYearPayments () {
      return this.$store.getters['admin/chartDataForLastYearPayments']
    },

    IncomingPaymentsStatisticData () {
      return [{name : i18n.t('Amount'), data : this.chartDataForPayment()}]
    },
    lastWeekPaymentsStatisticData () {
      return [{name : i18n.t('Amount'), data : this.chartDataForLastWeekPayments()}]
    },
    lasMonthPaymentsStatisticData () {
      return [{name : i18n.t('lastMonth'), data : this.chartDataForLastMonthPayments()}]
    },

    lastYearPaymentsStatisticData () {
      return [{name : i18n.t('Amount'), data : this.chartDataForLastYearPayments()}]
    },

    setDataForMonthlySeries () {
        this.revenueComparisonLine.chartOptions.xaxis.categories = this.$store.getters['admin/chartDataForLastMonthPaymentsDates']
        return  [
         {name : i18n.t('lastMonth'), data : this.$store.getters['admin/chartDataForLastMonthPayments']},
         {name : i18n.t('thisMonth'), data : this.$store.getters['admin/chartDataForThisMonthPayments']},
         ]
    },
    setDataForYearlySeries () {
        this.revenueComparisonLineYearly.chartOptions.xaxis.categories = this.$store.getters['admin/chartDataForLastYearPaymentsDates']
        return  [
         {name : i18n.t('lastYear'), data : this.$store.getters['admin/chartDataForLastYearPayments']},

         ]
    },
    countriesSet() {
        const countries = this.$store.state.admin.countries
          for (const [key, value] of Object.entries(countries)) {
             this.SalesCountryPerformance.chartOptions.labels.push(key)
             this.SalesCountryPerformance.series.push(value)
            }
    }


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
    this.$store.dispatch('admin/fetchItems')

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
