<!-- =========================================================================================
  File Name: DataListListView.vue
  Description: Data List - List View
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
========================================================================================== -->

<template>
  <div id="data-list-list-view" class="data-list-container">
    <div class="vx-col w-full md:w-12/12 mb-base">
      <div
        class="vx-col sm:w-1/2 w-full sm:mb-10 my-3 flex sm:justify-end justify-center order-last"
      >
        <p class="text-red">{{ $t("MonthlyOrYearly") }}</p>
        <vs-switch v-model="PriceAnnual" />
      </div>
      <vs-tabs position="left" color="danger">
        <vs-tab
          :label="$t('NewsDoping')"
          icon-pack="feather"
          icon="icon-file-text"
        >
          <div class="vx-row">
            <div
              v-for="packageData in newsPackage"
              :key="packageData.id"
              :class="
                `vx-col w-full  lg:w-1/` + newsPackage.length + ` mb-base`
              "
            >
              <vx-card>
                <h2
                  :style="
                    packageData.popular === 1
                      ? 'color: rgb(231, 96, 59)'
                      : 'color: #22292f !important'
                  "
                >
                  {{ packageData.title }}
                </h2>
                <p class="text-grey">{{ packageData.second_title }}</p>

                <h2 class="text-black" v-if="!PriceAnnual">
                  {{ packageData.monthly_price }}/ {{ $t("Monthly") }}
                </h2>
                <h2 class="text-black" v-else>
                  {{ packageData.yearly_price }}/ {{ $t("Yearly") }}
                </h2>
                <vs-list-item
                  icon-pack="feather"
                  v-for="(item, index) in JSON.parse(packageData.description)"
                  :key="index"
                  icon="icon-check"
                  :subtitle="item.value"
                />

                <div class="flex justify-between flex-wrap">
                  <payment-popup
                    :activeUser="activeUser"
                    :item="packageData"
                    :PriceAnnual="PriceAnnual"
                  />
                </div>
              </vx-card>
            </div>
          </div>
        </vs-tab>
        <vs-tab
          :label="$t('CaseDoping')"
          icon-pack="feather"
          icon="icon-file-text"
        >
          <div class="vx-row">
            <div
              v-for="packageData in servicePackage"
              :key="packageData.id"
              :class="
                `vx-col w-full  lg:w-1/` + servicePackage.length + ` mb-base`
              "
            >
              <vx-card>
                <h2
                  :style="
                    packageData.popular === 1
                      ? 'color: rgb(231, 96, 59)'
                      : 'color: #22292f !important'
                  "
                >
                  {{ packageData.title }}
                </h2>
                <p class="text-grey">{{ packageData.second_title }}</p>

                <h2 class="text-black" v-if="!PriceAnnual">
                  {{ packageData.monthly_price }}/ {{ $t("Monthly") }}
                </h2>
                <h2 class="text-black" v-else>
                  {{ packageData.yearly_price }}/ {{ $t("Yearly") }}
                </h2>
                <vs-list-item
                  icon-pack="feather"
                  v-for="(item, index) in JSON.parse(packageData.description)"
                  :key="index"
                  icon="icon-check"
                  :subtitle="item.value"
                />

                <div class="flex justify-between flex-wrap">
                  <payment-popup
                    :activeUser="activeUser"
                    :item="packageData"
                    :PriceAnnual="PriceAnnual"
                  />
                </div>
              </vx-card>
            </div>
          </div>
        </vs-tab>
        <vs-tab
          :label="$t('ProfileDoping')"
          icon-pack="feather"
          icon="icon-file-text"
        >
          <div class="vx-row">
            <div
              v-for="packageData in profilePackage"
              :key="packageData.id"
              :class="
                `vx-col w-full  lg:w-1/` + profilePackage.length + ` mb-base`
              "
            >
              <vx-card>
                <h2
                  :style="
                    packageData.popular === 1
                      ? 'color: rgb(231, 96, 59)'
                      : 'color: #22292f !important'
                  "
                >
                  {{ packageData.title }}
                </h2>
                <p class="text-grey">{{ packageData.second_title }}</p>

                <h2 class="text-black" v-if="!PriceAnnual">
                  {{ packageData.monthly_price }}/ {{ $t("Monthly") }}
                </h2>
                <h2 class="text-black" v-else>
                  {{ packageData.yearly_price }}/ {{ $t("Yearly") }}
                </h2>
                <vs-list-item
                  icon-pack="feather"
                  v-for="(item, index) in JSON.parse(packageData.description)"
                  :key="index"
                  icon="icon-check"
                  :subtitle="item.value"
                />

                <div class="flex justify-between flex-wrap">
                  <payment-popup
                    :activeUser="activeUser"
                    :item="packageData"
                    :PriceAnnual="PriceAnnual"
                  />
                </div>
              </vx-card>
            </div>
          </div>
        </vs-tab>
      </vs-tabs>
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
import i18n from "@/i18n/i18n";
import PaymentPopup from "./PaymentPopup";

export default {
  components: {
    PaymentPopup,
  },
  data() {
    return {
      PriceAnnual: false,
    };
  },
  computed: {
    newsPackage() {
      return this.$store.getters["package/newsPackage"];
    },
    servicePackage() {
      return this.$store.getters["package/servicePackage"];
    },
    profilePackage() {
      return this.$store.getters["package/profilePackage"];
    },
    activeUser() {
      return this.$store.state.auth.user;
    },
  },
  methods: {},
  created() {
    this.$store.dispatch("package/fetchItems");
    this.$store.dispatch("user/fetchUser");
  },
};
</script>
