<!-- =========================================================================================
    File Name: PopupBackground.vue
    Description: Change background when popup opens
    ----------------------------------------------------------------------------------------


    Author URL: https://github.com/uyanik13
========================================================================================== -->


<template>
  <div class="align-content-center mt-5">
    <vs-button
      class="mt-4 ml-8 shadow-lg"
      type="gradient"
      color="#E8603B"
      gradient-color-secondary="#E8603B"
      @click="popupActive = true"
      >{{ $t("GetStarted") }}</vs-button
    >
    <vs-popup
      background-color="rgba(152,152,152,.7)"
      :background-color-popup="colorx"
      class="bg-primary-gradient"
      :title="item.title"
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
            :title="$t('selectService')"
            icon="feather icon-send"
            class="mb-5"
          >
            <div class="vx-row">
              <!-- LEFT COL: NEW ADDRESS -->
              <div class="vx-col lg:w-1/1 w-full">
                <vx-card
                  :title="$t('pleaseSelectAService')"
                  :subtitle="$t('pleaseSelectAServiceDesc')"
                  class="mb-base"
                >
                  <form data-vv-scope="selectService">
                    <div class="vx-row">
                      <div class="vx-col sm:w-1/1 w-full">
                        <v-select
                          class="w-full mt-5"
                          v-model="yourService"
                          :options="serviceListGetter"
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
              <div class="vx-col lg:w-1/1 w-full">
                <vx-card
                  :title="$t('Payment')"
                  :subtitle="$t('paymentDesc')"
                  class="mb-base"
                >
                  <div class="mt-3">
                    <span class="mr-3"
                      >{{ $t("forThisActionCutting") }}
                      {{
                        !PriceAnnual ? item.monthly_price : item.yearly_price
                      }}
                      {{ $t("Token") }}</span
                    >
                    <vs-button
                      class="mt-4"
                      @click="makePayment(item, PriceAnnual)"
                      :disabled="false"
                      >{{ $t("PayNow") }}</vs-button
                    >
                    <vs-divider />
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
const ItemListView = () => import("./components/ItemListView.vue");
import vSelect from "vue-select";
import Swal from "sweetalert2";

export default {
  components: {
    VuePerfectScrollbar,
    ItemListView,
    FormWizard,
    "v-select": vSelect,
    TabContent,
  },
  props: {
    item: {},
    PriceAnnual: {
      type: Boolean,
      required: true,
    },
    activeUser: {},
  },
  data() {
    return {
      colorx: "#ffffff",
      search: "",
      popupActive: false,
      yourService: "",
      paymentMethod: "debit-card",
      cvv: "",
    };
  },
  computed: {
    validateForm() {
      return !this.errors.any();
    },

    filtered() {
      return this.serviceListGetter.filter((service) =>
        service.includes(this.search)
      );
    },

    serviceListGetter() {
      return this.$store.getters["post/myCasesTitleAndId"];
    },
  },

  methods: {
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
