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
        <vs-tab :label="$t('Account')" icon-pack="feather" icon="icon-monitor">
          <div class="vx-row">
            <!-- CONTENT CARD - PROGRESS BAR/GOAL -->
            <div
              class="vx-col w-full sm:w-1/1 md:w-1/1 lg:w-1/3 xl:w-1/3 mb-base"
            >
              <statistics-card-line
                icon="ShoppingBagIcon"
                :statistic="Number(activeUser.token ? activeUser.token : 0)"
                :statisticTitle="$t('Token')"
                color="warning"
                type="area"
              ></statistics-card-line>
            </div>

            <div
              class="vx-col w-full sm:w-1/1 md:w-1/1 lg:w-1/3 xl:w-1/3 mb-base"
            >
              <statistics-card-line
                icon="ShoppingBagIcon"
                :statistic="Number(pendingToken)"
                :statisticTitle="$t('PendingPayments')"
                color="warning"
                type="area"
              ></statistics-card-line>
            </div>
            <div
              class="vx-col w-full sm:w-1/1 md:w-1/1 lg:w-1/3 xl:w-1/3 mb-base"
            >
              <statistics-card-line
                icon="ShoppingBagIcon"
                :statistic="Number(completedTokens)"
                :statisticTitle="$t('CompletedPayments')"
                color="warning"
                type="area"
              ></statistics-card-line>
            </div>

            <div class="vx-col w-full lg:w-1/1 mb-base">
              <vx-card :title="$t('LastPayments')">
                <div slot="no-body" class="mt-4">
                  <vs-table :data="inToken" class="table-dark-inverted">
                    <template slot="thead">
                      <vs-th>{{ $t("Id") }}</vs-th>
                      <vs-th>{{ $t("Title") }}</vs-th>
                      <vs-th>{{ $t("Amount") }}</vs-th>
                      <vs-th>{{ $t("PaymentDate") }}</vs-th>
                      <vs-th>{{ $t("Status") }}</vs-th>
                      <!-- <vs-th>{{$t('Action')}}</vs-th> -->
                    </template>

                    <template slot-scope="{ data }">
                      <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                        <vs-td :data="data[indextr].id">
                          <span>{{ data[indextr].id }}</span>
                        </vs-td>
                        <vs-td :data="data[indextr].title">
                          <span>{{ data[indextr].title }}</span>
                        </vs-td>

                        <vs-td :data="data[indextr].amount">
                          <span>{{ data[indextr].amount }}</span>
                        </vs-td>

                        <vs-td :data="data[indextr].status">
                          <span>{{ data[indextr].status }}</span>
                        </vs-td>

                        <vs-td :data="data[indextr].created_at">
                          <span>{{ toDate(data[indextr].created_at) }}</span>
                        </vs-td>
                      </vs-tr>
                    </template>
                  </vs-table>
                </div>
              </vx-card>
            </div>
          </div>
        </vs-tab>
        <vs-tab
          :label="$t('OutgoingPayments')"
          icon-pack="feather"
          icon="icon-arrow-up"
        >
          <div class="vx-col w-full lg:w-1/1 mb-base">
            <vx-card :title="$t('OutgoingPayments')">
              <div slot="no-body" class="mt-4">
                <vs-table :data="outToken" class="table-dark-inverted">
                  <template slot="thead">
                    <vs-th>{{ $t("Id") }}</vs-th>
                    <vs-th>{{ $t("Title") }}</vs-th>
                    <vs-th>{{ $t("Amount") }}</vs-th>
                    <vs-th>{{ $t("PaymentDate") }}</vs-th>
                    <vs-th>{{ $t("Status") }}</vs-th>
                    <!-- <vs-th>{{$t('Action')}}</vs-th> -->
                  </template>

                  <template slot-scope="{ data }">
                    <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                      <vs-td :data="data[indextr].id">
                        <span>{{ data[indextr].id }}</span>
                      </vs-td>
                      <vs-td :data="data[indextr].title">
                        <span>{{ data[indextr].title }}</span>
                      </vs-td>

                      <vs-td :data="data[indextr].amount">
                        <span>{{ data[indextr].amount }}</span>
                      </vs-td>

                      <vs-td :data="data[indextr].status">
                        <span>{{ data[indextr].status }}</span>
                      </vs-td>

                      <vs-td :data="data[indextr].created_at">
                        <span>{{ toDate(data[indextr].created_at) }}</span>
                      </vs-td>
                    </vs-tr>
                  </template>
                </vs-table>
              </div>
            </vx-card>
          </div>
        </vs-tab>
        <vs-tab
          :label="$t('IncomingPayments')"
          icon-pack="feather"
          icon="icon-arrow-down"
        >
          <div class="vx-col w-full lg:w-1/1 mb-base">
            <vx-card :title="$t('IncomingPayments')">
              <div slot="no-body" class="mt-4">
                <vs-table :data="inToken" class="table-dark-inverted">
                  <template slot="thead">
                    <vs-th>{{ $t("Id") }}</vs-th>
                    <vs-th>{{ $t("Title") }}</vs-th>
                    <vs-th>{{ $t("Amount") }}</vs-th>
                    <vs-th>{{ $t("PaymentDate") }}</vs-th>
                    <vs-th>{{ $t("Status") }}</vs-th>
                    <!-- <vs-th>{{$t('Action')}}</vs-th> -->
                  </template>

                  <template slot-scope="{ data }">
                    <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                      <vs-td :data="data[indextr].id">
                        <span>{{ data[indextr].id }}</span>
                      </vs-td>
                      <vs-td :data="data[indextr].title">
                        <span>{{ data[indextr].title }}</span>
                      </vs-td>

                      <vs-td :data="data[indextr].amount">
                        <span>{{ data[indextr].amount }}</span>
                      </vs-td>

                      <vs-td :data="data[indextr].status">
                        <span>{{ data[indextr].status }}</span>
                      </vs-td>

                      <vs-td :data="data[indextr].created_at">
                        <span>{{ toDate(data[indextr].created_at) }}</span>
                      </vs-td>
                    </vs-tr>
                  </template>
                </vs-table>
              </div>
            </vx-card>
          </div>
        </vs-tab>
        <vs-tab
          :label="$t('TokenOperations')"
          icon-pack="feather"
          icon="icon-dollar-sign"
        >
          <div class="vx-row">
            <div class="vx-col w-full sm:w-1/2 lg:w-2/4 mb-base">
              <vx-card>
                <div class="my-8">
                  <h2 class="mb-2 text-4xl">
                    {{ Number(activeUser.token ? activeUser.token : 0) }}
                  </h2>
                  <p class="text-grey">{{ $t("TotalTokens") }}</p>
                </div>
                <div class="flex justify-between flex-wrap">
                  <vs-button
                    @click="setTokenRequest"
                    v-show="!isAlreadyRequested"
                    type="gradient"
                    color="#F93E0B"
                    gradient-color-secondary="#CE9FFC"
                    >{{ $t("RequestPayment") }}</vs-button
                  >
                </div>
              </vx-card>
            </div>
            <div class="vx-col w-full sm:w-1/2 lg:w-2/4 mb-base">
              <vx-card>
                <div class="my-6">
                  <feather-icon
                    icon="ShoppingCartIcon"
                    svg-classes="h-12 w-12"
                    class="ml-4"
                  ></feather-icon>
                  <p class="text-grey">{{ $t("BuyToken") }}</p>
                </div>
                <div class="flex justify-between flex-wrap">
                  <global-payment-popup />
                </div>
              </vx-card>
            </div>
            <div class="vx-col w-full lg:w-1/1 mb-base">
              <vx-card :title="$t('paymentRequests')">
                <div slot="no-body" class="mt-4">
                  <vs-table :data="paymentRequests" class="table-dark-inverted">
                    <template slot="thead">
                      <vs-th>{{ $t("Id") }}</vs-th>
                      <vs-th>{{ $t("Name") }}</vs-th>
                      <vs-th>{{ $t("Amount") }}</vs-th>
                      <vs-th>{{ $t("Status") }}</vs-th>
                      <vs-th>{{ $t("RequestDate") }}</vs-th>
                      <!-- <vs-th>{{$t('Action')}}</vs-th> -->
                    </template>

                    <template slot-scope="{ data }">
                      <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                        <vs-td :data="data[indextr].id">
                          <span>{{ data[indextr].id }}</span>
                        </vs-td>
                        <vs-td :data="data[indextr].request_id">
                          <span>{{ data[indextr].request_id }}</span>
                        </vs-td>

                        <vs-td :data="data[indextr].amount">
                          <span>{{ data[indextr].amount }}</span>
                        </vs-td>

                        <vs-td :data="data[indextr].status">
                          <span>{{ data[indextr].status }}</span>
                        </vs-td>

                        <vs-td :data="data[indextr].created_at">
                          <span>{{ toDate(data[indextr].created_at) }}</span>
                        </vs-td>
                      </vs-tr>
                    </template>
                  </vs-table>
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
import StatisticsCardLine from "@/components/statistics-cards/StatisticsCardLine.vue";
import GlobalPaymentPopup from "@/components/global/payment/components/GlobalPaymentPopup.vue";

export default {
  components: {
    StatisticsCardLine,
    GlobalPaymentPopup,
  },
  data() {
    return {
      itemsPerPage: 10,
    };
  },
  computed: {
    currentPage() {
      if (this.isMounted) {
        return this.$refs.table.currentx;
      }
      return 0;
    },
    allData() {
      //return this.$store.state.post.categories
      return this.websites;
    },
    AllProjects() {
      //return this.$store.state.post.categories
      return this.projects;
    },
    activeUser() {
      return this.$store.state.auth.user;
    },
    paymentRequests() {
      return this.$store.state.token.tokenRequests;
    },
    outToken() {
      return this.$store.getters["token/outgoingTokens"](this.activeUser.id);
    },
    inToken() {
      return this.$store.getters["token/incomingTokens"](this.activeUser.id);
    },
    pendingToken() {
      return this.$store.getters["token/pendingTokens"](this.activeUser.id);
    },
    completedTokens() {
      return this.$store.getters["token/completedTokens"](this.activeUser.id);
    },
    isAlreadyRequested() {
      return this.$store.getters["token/isAlreadyRequested"](
        this.activeUser.id
      );
    },
    queriedItems() {
      return this.$refs.table
        ? this.$refs.table.queriedResults.length
        : this.allData.length;
    },
  },
  methods: {
    toDate(time) {
      const locale = "en-us";
      const date_obj = new Date(Date.parse(time));
      const monthName = date_obj.toLocaleString(locale, {
        month: "short",
      });
      return `${date_obj.getDate()} ${monthName} ${date_obj.getFullYear()}`;
    },
    setTokenRequest() {
      this.$store
        .dispatch("token/addTokenRequest")
        .then((response) => {
          this.showAlert(
            i18n.t("Success"),
            i18n.t("paymentRequestHasSent"),
            "icon-success",
            "success"
          );
        })
        .catch((error) => {
          this.showAlert(
            i18n.t("Error"),
            i18n.t("yourTokenIsUnderLimit"),
            "icon-alert-circle",
            "danger"
          );
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
    getOrderStatusColor(status) {
      // if(status == 'open') return "warning"
      if (status === "1") return "success";
      if (status === "0") return "primary";
      return "primary";
    },
    getPopularityColor(num) {
      if (num > 500) return "#16ac8b";
      if (num >= 100) return "#373091";
      if (num < 100) return "#c21700";
      return "primary";
    },
  },
  created() {
    this.$store.dispatch("token/fetchTokenRequest");
    this.$store.dispatch("token/fetchItems");
    this.$store.dispatch("user/fetchUser");
  },
};
</script>

<style lang="scss">
#data-list-list-view {
  .vs-con-table {
    /*
        Below media-queries is fix for responsiveness of action buttons
        Note: If you change action buttons or layout of this page, Please remove below style
      */
    @media (max-width: 689px) {
      .vs-table--search {
        margin-left: 0;
        max-width: unset;
        width: 100%;

        .vs-table--search-input {
          width: 100%;
        }
      }
    }

    @media (max-width: 461px) {
      .items-per-page-handler {
        display: none;
      }
    }

    @media (max-width: 341px) {
      .data-list-btn-container {
        width: 100%;

        .dd-actions,
        .btn-add-new {
          width: 100%;
          margin-right: 0 !important;
        }
      }
    }

    .product-name {
      max-width: 23rem;
    }

    .vs-table--header {
      display: flex;
      flex-wrap: wrap;
      margin-left: 1.5rem;
      margin-right: 1.5rem;
      > span {
        display: flex;
        flex-grow: 1;
      }

      .vs-table--search {
        padding-top: 0;

        .vs-table--search-input {
          padding: 0.9rem 2.5rem;
          font-size: 1rem;

          & + i {
            left: 1rem;
          }

          &:focus + i {
            left: 1rem;
          }
        }
      }
    }

    .vs-table {
      border-collapse: separate;
      border-spacing: 0 1.3rem;
      padding: 0 1rem;

      tr {
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.05);
        td {
          padding: 20px;
          &:first-child {
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
          }
          &:last-child {
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
          }
        }
        td.td-check {
          padding: 20px !important;
        }
      }
    }

    .vs-table--thead {
      th {
        padding-top: 0;
        padding-bottom: 0;

        .vs-table-text {
          text-transform: uppercase;
          font-weight: 600;
        }
      }
      th.td-check {
        padding: 0 15px !important;
      }
      tr {
        background: none;
        box-shadow: none;
      }
    }

    .vs-table--pagination {
      justify-content: center;
    }
  }
}
</style>
