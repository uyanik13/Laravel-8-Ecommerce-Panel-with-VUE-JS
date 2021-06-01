<!-- =========================================================================================
    File Name: PopupBackground.vue
    Description: Change background when popup opens
    ----------------------------------------------------------------------------------------

      Author: uyanik13
    Author URL: https://github.com/uyanik13
========================================================================================== -->


<template>
  <div class="align-content-center mt-3">
    <vs-button
      class="shadow-lg"
      type="gradient"
      color="#F93E0B"
      @click="popupActive = true"
      gradient-color-secondary="#CE9FFC"
      >{{ $t("BuyToken") }}</vs-button
    >

    <vs-popup
      background-color="rgba(152,152,152,.7)"
      fullscreen
      :background-color-popup="colorx"
      class="bg-primary-gradient"
      title="Payment"
      :active.sync="popupActive"
    >
      <div id="ecommerce-checkout-demo">
        <form-wizard
          ref="checkoutWizard"
          color="rgba(var(--vs-primary), 1)"
          :title="null"
          :subtitle="null"
          :hide-buttons="true"
        >
          <!-- tab 2 content -->
          <tab-content
            :title="$t('selectTokenPackage')"
            icon="feather icon-send"
            class="mb-5"
          >
            <div class="vx-row">
              <!-- LEFT COL: NEW ADDRESS -->
              <div class="vx-col lg:w-1/1 w-full">
                <vx-card
                  :title="$t('selectTokenPackage')"
                  :subtitle="$t('selectTokenPackageDesc')"
                  class="mb-base"
                >
                  <form data-vv-scope="selectService">
                    <div class="vx-row">
                      <div class="vx-col sm:w-1/1 w-full">
                        <v-select
                          v-validate="'required'"
                          class="w-full mt-5"
                          v-model="yourpackage"
                          :options="tokenPackageListGetter"
                          @search="(query) => (search = query)"
                          :getOptionLabel="(option) => option.title"
                          :filterable="false"
                        />

                        <span
                          v-show="errors.has('selectService.yourService')"
                          class="text-danger"
                          >{{
                            errors.first("selectService.yourService")
                              ? $t("pleaseSelectAService")
                              : ""
                          }}</span
                        >
                      </div>
                    </div>
                    <vs-button
                      class="mt-6 ml-auto flex"
                      @click.prevent="submitNewAddressForm"
                      >{{ $t("goToPayment") }}</vs-button
                    >
                  </form>
                </vx-card>
              </div>
            </div>
          </tab-content>

          <!-- tab 3 content -->

          <tab-content
            :title="$t('Payment')"
            icon="feather icon-credit-card"
            class="mb-5"
          >
            <div class="vx-row">
              <!-- LEFT COL: PAYMENT OPTIONS -->
              <div class="vx-col lg:w-2/3 w-full">
                <vx-card
                  :title="$t('Payment')"
                  :subtitle="$t('paymentDesc')"
                  class="mb-base"
                >
                  <div class="mt-3">
                    <ul>
                      <!-- OPTION 1 -->
                      <li>
                        <!-- CARD DETAILS -->
                        <div
                          class="flex flex-wrap justify-between items-center"
                        >
                          <vs-radio
                            v-model="paymentMethod"
                            vs-value="debit-card"
                          >
                            <div class="flex items-center">
                              <img
                                src="@assets/images/pages/eCommerce/bank.png"
                                alt="bank-logo"
                                height="40"
                                width="50"
                                class="inline-flex"
                              />
                              <span
                                >US Unlocked Debit Card 12XX XXXX XXXX
                                0000</span
                              >
                            </div>
                          </vs-radio>
                          <span>John Doe</span>
                          <span>11/2020</span>
                        </div>

                        <!-- CVV BLOCK -->
                        <form data-vv-scope="cvv-form">
                          <div class="flex items-center flex-wrap">
                            <span class="mt-4">Enter CVV: </span>
                            <vs-input
                              v-validate="'required|digits:3'"
                              name="cvv"
                              v-model="cvv"
                              class="mr-3 ml-2 mt-4"
                            />
                            <vs-button
                              class="mt-4"
                              @click.prevent="makePayment"
                              :disabled="false"
                              >CONTINUE</vs-button
                            >
                          </div>
                          <span
                            v-show="errors.has('cvv-form.cvv')"
                            class="text-danger ml-24"
                            >{{ errors.first("cvv-form.cvv") }}</span
                          >
                        </form>
                      </li>

                      <vs-divider class="my-6" />

                      <!-- OPTION 2 -->
                      <li>
                        <vs-radio
                          v-model="paymentMethod"
                          vs-value="credit-debit-atmCard"
                          >Credit / Debit / ATM Card</vs-radio
                        >
                      </li>
                    </ul>

                    <vs-divider />
                  </div>
                </vx-card>
              </div>

              <!-- RIGHT COL: PRICE -->
              <div class="vx-col lg:w-1/3 w-full">
                <vx-card :title="$t('priceDetails')">
                  <div class="mb-2">
                    {{ $t("Item") }}:
                    <span class="font-semibold">{{ yourpackage.title }}</span>
                    <br />
                    {{ $t("price") }}:
                    <span class="font-semibold">{{
                      yourpackage.monthly_price
                    }}</span>
                  </div>

                  <vs-divider />

                  <div class="flex justify-between">
                    <span>{{ $t("totalPrice") }}</span>
                    <span class="font-semibold">{{
                      yourpackage.monthly_price
                    }}</span>
                  </div>
                </vx-card>
              </div>
            </div>
          </tab-content>
        </form-wizard>
      </div>
    </vs-popup>
  </div>
</template>

<script>
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import i18n from "@/i18n/i18n";
import { FormWizard, TabContent } from "vue-form-wizard";
import "vue-form-wizard/dist/vue-form-wizard.min.css";
const ItemListView = () => import("./ItemListView.vue");
import vSelect from "vue-select";
import Swal from "sweetalert2";

export default {
  components: {
    VuePerfectScrollbar,
    ItemListView,
    FormWizard,
    TabContent,
    "v-select": vSelect,
  },
  props: {},
  data() {
    return {
      colorx: "#ffffff",
      search: "",
      popupActive: false,
      yourpackage: "",

      // TAB 3
      paymentMethod: "debit-card",
      cvv: "",
    };
  },
  computed: {
    validateForm() {
      return !this.errors.any();
    },

    filtered() {
      return this.tokenPackageListGetter.filter((service) =>
        service.includes(this.search)
      );
    },

    tokenPackageListGetter() {
      return this.$store.getters["package/tokenPackagesData"];
    },
  },

  methods: {
    // TAB 2
    submitNewAddressForm() {
      return new Promise(() => {
        this.$validator.validateAll("select").then((result) => {
          if (result) {
            // if form have no errors
            this.$refs.checkoutWizard.nextTab();
          } else {
            this.$vs.notify({
              title: "Error",
              text: "Please enter valid details",
              color: "warning",
              iconPack: "feather",
              icon: "icon-alert-circle",
            });
          }
        });
      });
    },

    makePayment(item, PriceAnnual) {
      const obj = {
        title: this.item.title,
        user_id: this.activeUser.id,
        package_id: this.item.id,
        amount: PriceAnnual ? item.yearly_price : item.monthly_price,
        options: this.yourService,
        annual: PriceAnnual,
      };
      this.popupActive = false;
      this.$store
        .dispatch("subscription/addItem", obj)
        .then((response) => {
          Swal.fire({
            type: "warning",
            title: i18n.t("subscriptionSuccessfull"),
            text: i18n.t("subscriptionSuccessfullDesc"),
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonText: i18n.t("showTokens"),
            cancelButtonText: i18n.t("cancel"),
          })
            .then((result) => {
              if (result.value) {
                console.log(result);
                return this.$router.push("/panel/token");
              }
            })
            .catch((error) => {
              console.log("ERROR:", error);
            });
          this.showAlert(
            i18n.t("Success"),
            i18n.t("SuccessfullyAdded"),
            "icon-success",
            "success"
          );
          return this.$router.push("/panel/token");
        })
        .catch((error) => {
          Swal.fire({
            type: "warning",
            title: i18n.t("youHaveNotRequiredTokens"),
            text: i18n.t("youHaveNotRequiredTokensDesc"),
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonText: i18n.t("buyToken"),
            cancelButtonText: i18n.t("cancel"),
          })
            .then((result) => {
              if (result.value) {
                console.log(result);
                return this.$router.push("/panel/token");
              }
            })
            .catch((error) => {
              console.log("ERROR:", error);
            });
        });
    },
    showAlert(title, text, icon, color) {
      this.$vs.notify({
        title,
        text,
        iconPack: "feather",
        icon,
        color,
      });
    },
  },

  created() {
    this.$store.dispatch("post/fetchMyCases");
    this.$store.dispatch("package/fetchItems");
  },
};
</script>


<style lang="scss" scoped>
#ecommerce-checkout-demo {
  .item-view-primary-action-btn {
    color: #2c2c2c !important;
    background-color: #f6f6f6;
  }

  .item-name {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
    -webkit-line-clamp: 2;
  }

  .vue-form-wizard {
    padding-bottom: 0;

    ::v-deep .wizard-header {
      padding: 0;
    }

    ::v-deep .wizard-tab-content {
      padding-right: 0;
      padding-left: 0;
      padding-bottom: 0;

      .wizard-tab-container {
        margin-bottom: 0 !important;
      }
    }
  }
}
</style>
