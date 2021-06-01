<!-- =========================================================================================
  File Name: DataListListView.vue
  Description: Data List - List View
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
========================================================================================== -->

<template>
  <div class="vx-row">
    <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/3 mb-base">
      <statistics-card-line
        v-if="lastWeekPaymentsStatisticData()"
        icon="DollarSignIcon"
        :statistic="lastWeekPaymentsAmount | k_formatter"
        :statisticTitle="$t('lastWeekPayments')"
        :chartData="lastWeekPaymentsStatisticData()"
        color="danger"
        type="area"
      />
    </div>
    <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/3 mb-base">
      <statistics-card-line
        v-if="lasMonthPaymentsStatisticData()"
        icon="DollarSignIcon"
        :statistic="lastMonthPaymentsAmount | k_formatter"
        :statisticTitle="$t('lastMonthPayments')"
        :chartData="lasMonthPaymentsStatisticData()"
        color="warning"
        type="area"
      />
    </div>
    <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/3 mb-base">
      <statistics-card-line
        v-if="lastYearPaymentsStatisticData()"
        icon="DollarSignIcon"
        :statistic="lastYearPaymentsAmount | k_formatter"
        :statisticTitle="$t('lastYearPayments')"
        :chartData="lastYearPaymentsStatisticData()"
        color="success"
        type="area"
      />
    </div>

    <vx-card>
      <!-- TABLE ACTION ROW -->
      <div class="flex flex-wrap justify-between items-center">
        <!-- ITEMS PER PAGE -->
        <div class="mb-4 md:mb-0 mr-4 ag-grid-table-actions-left">
          <vs-dropdown vs-trigger-click class="cursor-pointer">
            <div
              class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium"
            >
              <span class="mr-2"
                >{{
                  currentPage * paginationPageSize - (paginationPageSize - 1)
                }}
                -
                {{
                  paymentsPaginated.length - currentPage * paginationPageSize >
                  0
                    ? currentPage * paginationPageSize
                    : paymentsPaginated.length
                }}
                of {{ paymentsPaginated.length }}</span
              >
              <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
            </div>
            <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
            <vs-dropdown-menu>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(20)">
                <span>20</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(50)">
                <span>50</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(100)">
                <span>100</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(150)">
                <span>150</span>
              </vs-dropdown-item>
            </vs-dropdown-menu>
          </vs-dropdown>
        </div>

        <!-- TABLE ACTION COL-2: SEARCH & EXPORT AS CSV -->
        <div
          class="flex flex-wrap items-center justify-between ag-grid-table-actions-right"
        >
          <vs-input
            class="mb-4 md:mb-0 mr-4"
            v-model="searchQuery"
            @input="updateSearchQuery"
            placeholder="Search..."
          />
          <vs-button class="mb-4 md:mb-0" @click="gridApi.exportDataAsCsv()">{{
            $t("export_as_cv")
          }}</vs-button>
        </div>
      </div>
      <ag-grid-vue
        ref="agGridTable"
        :gridOptions="gridOptions"
        class="ag-theme-material w-100 my-4 ag-grid-table"
        :columnDefs="columnDefs"
        :defaultColDef="defaultColDef"
        :rowData="paymentsPaginated"
        rowSelection="multiple"
        colResizeDefault="shift"
        :animateRows="true"
        :floatingFilter="true"
        :pagination="true"
        :paginationPageSize="paginationPageSize"
        :suppressPaginationPanel="true"
        :enableRtl="$vs.rtl"
      >
      </ag-grid-vue>
      <vs-pagination
        :total="totalPages"
        :max="maxPageNumbers"
        v-model="currentPage"
      />
    </vx-card>
  </div>
</template>

<script>
import Swal from "sweetalert2";
import i18n from "@/i18n/i18n";
import StatisticsCardLine from "@/components/statistics-cards/StatisticsCardLine.vue";
import { AgGridVue } from "ag-grid-vue";
import "@sass/vuexy/extraComponents/agGridStyleOverride.scss";

export default {
  components: {
    StatisticsCardLine,
    AgGridVue,
  },
  data() {
    return {
      searchQuery: "",
      gridOptions: {},
      maxPageNumbers: 7,
      gridApi: null,
      defaultColDef: {
        sortable: true,
        editable: true,
        resizable: true,
        suppressMenu: true,
      },
      columnDefs: [
        {
          headerName: i18n.t("name"),
          field: "user.name",
          width: 175,
          filter: true,
          checkboxSelection: true,
          headerCheckboxSelectionFilteredOnly: true,
          headerCheckboxSelection: true,
        },
        {
          headerName: i18n.t("email"),
          field: "user.email",
          filter: true,
          width: 225,
          pinned: "left",
        },
        {
          headerName: i18n.t("paymentId"),
          field: "payment_id",
          filter: true,
          width: 150,
        },
        {
          headerName: i18n.t("country"),
          field: "payment_country",
          filter: true,
          width: 150,
        },
        {
          headerName: i18n.t("amount"),
          field: "amount",
          filter: "agNumberColumnFilter",
          width: 125,
        },
        {
          headerName: i18n.t("paymentDate"),
          field: "created_at",
          filter: "agNumberColumnFilter",
          width: 175,
        },
      ],
    };
  },
  watch: {
    "$store.state.windowWidth"(val) {
      if (val <= 576) {
        this.maxPageNumbers = 4;
        this.gridOptions.columnApi.setColumnPinned("email", null);
      } else this.gridOptions.columnApi.setColumnPinned("email", "left");
    },
  },
  computed: {
    lastWeekPaymentsAmount() {
      return this.$store.getters["admin/lastWeekPaymentsAmount"];
    },
    lastMonthPaymentsAmount() {
      return this.$store.getters["admin/lastMonthPaymentsAmount"];
    },
    lastYearPaymentsAmount() {
      return this.$store.getters["admin/lastYearPaymentsAmount"];
    },
    paymentsPaginated() {
      return this.$store.state.admin.payments;
    },
    paginationPageSize() {
      if (this.gridApi) return this.gridApi.paginationGetPageSize();
      else return 50;
    },
    totalPages() {
      if (this.gridApi) return this.gridApi.paginationGetTotalPages();
      else return 0;
    },
    currentPage: {
      get() {
        if (this.gridApi) return this.gridApi.paginationGetCurrentPage() + 1;
        else return 1;
      },
      set(val) {
        this.gridApi.paginationGoToPage(val - 1);
      },
    },
  },
  methods: {
    chartDataForLastWeekPayments() {
      return this.$store.getters["admin/chartDataForLastWeekPayments"];
    },
    lastWeekPaymentsStatisticData() {
      return [
        { name: i18n.t("Amount"), data: this.chartDataForLastWeekPayments() },
      ];
    },
    chartDataForLastMonthPayments() {
      return this.$store.getters["admin/chartDataForLastMonthPayments"];
    },
    chartDataForThisMonthPayments() {
      return this.$store.getters["admin/chartDataForThisMonthPayments"];
    },
    chartDataForLastYearPayments() {
      return this.$store.getters["admin/chartDataForLastYearPayments"];
    },

    IncomingPaymentsStatisticData() {
      return [{ name: i18n.t("Amount"), data: this.chartDataForPayment() }];
    },
    lastWeekPaymentsStatisticData() {
      return [
        { name: i18n.t("Amount"), data: this.chartDataForLastWeekPayments() },
      ];
    },
    lasMonthPaymentsStatisticData() {
      return [
        {
          name: i18n.t("lastMonth"),
          data: this.chartDataForLastMonthPayments(),
        },
      ];
    },

    lastYearPaymentsStatisticData() {
      return [
        { name: i18n.t("Amount"), data: this.chartDataForLastYearPayments() },
      ];
    },

    toDate(time) {
      const locale = "en-us";
      const date_obj = new Date(Date.parse(time));
      const monthName = date_obj.toLocaleString(locale, {
        month: "short",
      });
      return `${date_obj.getDate()} ${monthName} ${date_obj.getFullYear()}`;
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
      if (status === "completed") return "success";
      if (status === "pending") return "primary";
      return "primary";
    },
    getPopularityColor(num) {
      if (num > 500) return "#16ac8b";
      if (num >= 100) return "#373091";
      if (num < 100) return "#c21700";
      return "primary";
    },
    updateSearchQuery(val) {
      this.gridApi.setQuickFilter(val);
    },
  },
  mounted() {
    this.gridApi = this.gridOptions.api;

    /* =================================================================
      NOTE:
      Header is not aligned properly in RTL version of agGrid table.
      However, we given fix to this issue. If you want more robust solution please contact them at gitHub
    ================================================================= */
    if (this.$vs.rtl) {
      const header = this.$refs.agGridTable.$el.querySelector(
        ".ag-header-container"
      );
      header.style.left = `-${String(
        Number(header.style.transform.slice(11, -3)) + 9
      )}px`;
    }
  },
  created() {
    this.$store.dispatch("user/fetchUsers");
    this.$store.dispatch("admin/fetchItems");
    // console.clear()
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
