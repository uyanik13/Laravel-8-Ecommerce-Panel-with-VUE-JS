<template>
    <div class="vx-col w-full md:w-12/12 mb-base">
        <vx-card slot="no-body" class="text-center bg-primary-gradient greet-user">
          <feather-icon icon="GiftIcon" class="p-6 mb-8 bg-primary inline-flex rounded-full text-white shadow" svgClasses="h-8 w-8"></feather-icon>
          <h1 class="mb-6 text-white">{{$t('upgradeYourProfile')}}</h1>
          <p class="xl:w-3/4 lg:w-4/5 md:w-2/3 w-4/5 mx-auto text-white">{{$t('underupgradeYourProfileText')}}</p>

        </vx-card>

                <div class="vx-col sm:w-1/2 w-full sm:mb-10 my-3 flex sm:justify-end justify-center order-last">
                  <p class="text-red">{{$t("MonthlyOrYearly")}}</p>
                    <vs-switch v-model="PriceAnnual" />
                </div>

        <div class="vx-row">
            <div v-for="packageData in upgrade_profile" :key="packageData.id" :class="`vx-col w-full  lg:w-1/`+upgrade_profile.length+` mb-base`">
                <vx-card>
                        <h2 :style="packageData.popular === 1 ? 'color: rgb(231, 96, 59)' : 'color: #22292f !important' ">{{packageData.title}}</h2>
                        <p class="text-grey">{{packageData.second_title}}</p>

                        <h2 class="text-black" v-if="!PriceAnnual">{{packageData.monthly_price}}/ {{$t("Monthly")}} </h2>
                        <h2 class="text-black" v-else>{{packageData.yearly_price}}/ {{$t("Yearly")}}</h2>
                        <vs-list-item icon-pack="feather"
                                    v-for="(item,index) in JSON.parse(packageData.description)" :key="index"
                                    icon="icon-check"
                                    :subtitle="item.value" />

                        <div class="flex justify-between flex-wrap">
                                    <user-profile-payment :activeUser="activeUser" :item="packageData" :PriceAnnual="PriceAnnual" />
                        </div>
                </vx-card>
            </div>
        </div>

      </div>
</template>

<script>
import UserProfilePayment from './UserProfilePayment'

export default {
  components: {
    UserProfilePayment
  },
  data () {
    return {
      name: null,
      PriceAnnual : false


    }
  },
  props: {
    user: {
      type: Object,
      default: () => {}
    }
  },

  computed: {
    validateForm () {
      return !this.errors.any()
    },
    upgrade_profile () {
      return this.$store.getters['package/upgrade_profile']
    },
    activeUser () {
      return this.$store.state.auth.user
    },
  },
  methods:{
    save_changes () {
      if (!this.validateForm) return
      const payload = {
        id: this.user.id
      }
      this.$store.dispatch('user/updateCompany', payload)
        .then((response) => {
          this.$vs.loading.close()
          if (response.data) this.$vs.notify({
            title: 'Success',
            text: 'Succesfully updated',
            iconPack: 'feather',
            icon: 'icon-alert-circle',
            color: 'success'
          })
        })
        .catch(error => {
          this.$vs.loading.close()
          this.$vs.notify({
            title: 'Error',
            text: error.message,
            iconPack: 'feather',
            icon: 'icon-alert-circle',
            color: 'danger'
          })
        })

    }

  },

  created () {
    this.$store.dispatch('package/fetchItems')
    this.$store.dispatch('user/fetchUser')
  }

}
</script>
