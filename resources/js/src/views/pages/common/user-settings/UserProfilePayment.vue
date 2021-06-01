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
      <div class="vx-col lg:w-1/1 w-full">
        <vx-card
          :title="$t('Payment')"
          :subtitle="$t('paymentDesc')"
          class="mb-base"
        >
          <div class="mt-3">
            <span class="mr-3"
              >{{ $t("forThisActionCutting") }}
              {{ !PriceAnnual ? item.monthly_price : item.yearly_price }}
              {{ $t("Token") }}</span
            >
            <vs-button class="mt-4" @click="makePayment(item, PriceAnnual)">{{
              $t("PayNow")
            }}</vs-button>
            <vs-divider />
          </div>
        </vx-card>
      </div>
    </vs-popup>
  </div>
</template>

<script>
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import i18n from "@/i18n/i18n";
import { FormWizard, TabContent } from "vue-form-wizard";
import "vue-form-wizard/dist/vue-form-wizard.min.css";
import vSelect from "vue-select";
import Swal from "sweetalert2";

export default {
  components: {
    VuePerfectScrollbar,
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
      popupActive: false,
    };
  },
  computed: {
    validateForm() {
      return !this.errors.any();
    },
  },

  methods: {
    makePayment(item, PriceAnnual) {
      const obj = {
        title: this.item.title,
        user_id: this.activeUser.id,
        package_id: this.item.id,
        amount: PriceAnnual ? item.yearly_price : item.monthly_price,
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

  created() {},
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
