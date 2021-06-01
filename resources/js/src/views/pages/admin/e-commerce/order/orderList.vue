<!-- =========================================================================================
  File Name: DataListListView.vue
  Description: Data List - List View
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
========================================================================================== -->

<template>
  <div id="data-list-thumb-view" class="data-list-container">
    <!-- <order-sidebar :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :data="sidebarData"/> -->

    <vs-table
      ref="table"
      multiple
      v-model="selected"
      pagination
      :max-items="itemsPerPage"
      search
      :data="dataList"
    >
      <div
        slot="header"
        class="flex flex-wrap-reverse items-center flex-grow justify-between"
      >
        <!-- <div class="flex flex-wrap-reverse items-center data-list-btn-container">
            <div
                class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary"
                @click="addNewData">
                <feather-icon icon="PlusIcon" svgClasses="h-4 w-4"/>
                <span class="ml-2 text-base text-primary">{{$t('addSubscription')}}</span>
            </div>
        </div> -->

        <!-- ITEMS PER PAGE -->
        <vs-dropdown
          vs-trigger-click
          class="cursor-pointer mb-4 mr-4 items-per-page-handler"
        >
          <div
            class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium"
          >
            <span class="mr-2"
              >{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} -
              {{
                dataList.length - currentPage * itemsPerPage > 0
                  ? currentPage * itemsPerPage
                  : dataList.length
              }}
              of {{ queriedItems }}</span
            >
            <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
          </div>
          <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
          <vs-dropdown-menu>
            <vs-dropdown-item @click="itemsPerPage = 4">
              <span>4</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage = 10">
              <span>10</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage = 15">
              <span>15</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage = 20">
              <span>20</span>
            </vs-dropdown-item>
          </vs-dropdown-menu>
        </vs-dropdown>
      </div>

      <template slot="thead">
        <vs-th sort-key="id">{{ $t("Id") }}</vs-th>
        <vs-th sort-key="order_id">{{ $t("orderId") }}</vs-th>
        <vs-th sort-key="price">{{ $t("Amount") }}</vs-th>
        <vs-th sort-key="order_status">{{ $t("OrderStatus") }}</vs-th>
        <vs-th sort-key="status">{{ $t("Status") }}</vs-th>
        <vs-th>{{ $t("Action") }}</vs-th>
      </template>

      <template slot-scope="{ data }">
        <tbody>
          <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
            <vs-td>
              <p class="product-name font-medium truncate">{{ tr.id }}</p>
            </vs-td>
            <vs-td>
              <p class="product-name font-medium truncate">{{ tr.order_id }}</p>
            </vs-td>
            <vs-td>
              <p class="product-name font-medium truncate">{{ tr.price }}</p>
            </vs-td>

            <vs-td>
              <p class="product-name font-medium truncate">
                {{ $t(tr.order_status) }}
              </p>
            </vs-td>

            <vs-td>
              <p class="product-name font-medium truncate">
                {{ $t(tr.status) }}
              </p>
            </vs-td>

            <vs-td class="whitespace-no-wrap">
              <order-popup :item="tr" />
            </vs-td>
          </vs-tr>
        </tbody>
      </template>
    </vs-table>
  </div>
</template>

<script>
import OrderSidebar from "./orderSidebar.vue";
import OrderPopup from "./orderPopup.vue";
import Swal from "sweetalert2";
import i18n from "@/i18n/i18n";

export default {
  components: {
    OrderSidebar,
    OrderPopup,
  },
  data() {
    return {
      selected: [],
      itemsPerPage: 10,
      isMounted: false,
      addNewDataSidebar: false,
      sidebarData: {},
    };
  },
  computed: {
    currentPage() {
      if (this.isMounted) {
        return this.$refs.table.currentx;
      }
      return 0;
    },
    dataList() {
      return this.$store.state.admin.orders;
    },

    queriedItems() {
      return this.$refs.table
        ? this.$refs.table.queriedResults.length
        : this.dataList.length;
    },
  },
  methods: {
    addNewData() {
      this.sidebarData = {
        categories: this.categoryList,
      };
      this.toggleDataSidebar(true);
    },
    getOrderStatusColor(status) {
      if (status == "1") return "success";
      if (status == "0") return "#10163A";
      return "#10163A";
    },
    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val;
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
    this.$store.dispatch("admin/fetchItems");
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
