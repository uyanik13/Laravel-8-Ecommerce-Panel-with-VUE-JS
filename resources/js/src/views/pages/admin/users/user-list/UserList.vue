<!-- =========================================================================================
  File Name: UserList.vue
  Description: User List page
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
========================================================================================== -->

<template>
  <div id="page-user-list">
    <div class="vx-card p-6">
      <div class="flex flex-wrap items-center">
        <!-- ITEMS PER PAGE -->
        <div class="flex-grow">
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
                  UserList.length - currentPage * paginationPageSize > 0
                    ? currentPage * paginationPageSize
                    : UserList.length
                }}
                of {{ UserList.length }}</span
              >
              <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
            </div>
            <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
            <vs-dropdown-menu>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(10)">
                <span>10</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(20)">
                <span>20</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(25)">
                <span>25</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(30)">
                <span>30</span>
              </vs-dropdown-item>
            </vs-dropdown-menu>
          </vs-dropdown>
        </div>

        <!-- TABLE ACTION COL-2: SEARCH & EXPORT AS CSV -->
        <vs-input
          class="sm:mr-4 mr-0 sm:w-auto w-full sm:order-normal order-3 sm:mt-0 mt-4"
          v-model="searchQuery"
          @input="updateSearchQuery"
          :placeholder="$t('search')"
        />
        <!-- <vs-button class="mb-4 md:mb-0" @click="gridApi.exportDataAsCsv()">Export as CSV</vs-button> -->
        <data-view-sidebar
          :isSidebarActive="addNewDataSidebar"
          @closeSidebar="toggleDataSidebarUser"
          :data="sidebarData"
        />
        <!-- ADD NEW -->
        <div
          class="btn-add-new p-2 mb-2 mr-2 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary"
          @click="addNewData"
        >
          <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
          <span class="ml-2 text-base text-primary">{{ $t("add_new") }}</span>
        </div>
        <!-- ACTION - DROPDOWN -->
        <vs-dropdown vs-trigger-click class="cursor-pointer">
          <div
            class="p-3 shadow-drop rounded-lg d-theme-dark-light-bg cursor-pointer flex items-end justify-center text-lg font-medium w-32"
          >
            <span class="mr-2 leading-none">{{ $t("Actions") }}</span>
            <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
          </div>
          <vs-dropdown-menu>
            <vs-dropdown-item>
              <span class="flex items-center">
                <feather-icon
                  icon="TrashIcon"
                  @click="deleteRecords()"
                  svgClasses="h-4 w-4"
                  class="mr-2"
                />
                <span>{{ $t("Delete") }}<</span>
              </span>
            </vs-dropdown-item>

            <vs-dropdown-item>
              <span class="flex items-center">
                <feather-icon
                  icon="ArchiveIcon"
                  svgClasses="h-4 w-4"
                  class="mr-2"
                />
                <span>{{ $t("Archive") }}</span>
              </span>
            </vs-dropdown-item>

            <vs-dropdown-item>
              <span class="flex items-center">
                <feather-icon
                  icon="FileIcon"
                  svgClasses="h-4 w-4"
                  class="mr-2"
                />
                <span>{{ $t("Print") }}</span>
              </span>
            </vs-dropdown-item>

            <vs-dropdown-item>
              <span class="flex items-center">
                <feather-icon
                  icon="SaveIcon"
                  svgClasses="h-4 w-4"
                  class="mr-2"
                />
                <span>{{ $t("Export") }}</span>
              </span>
            </vs-dropdown-item>
          </vs-dropdown-menu>
        </vs-dropdown>
      </div>

      <!-- AgGrid Table -->
      <ag-grid-vue
        ref="agGridTable"
        :components="components"
        :gridOptions="gridOptions"
        class="ag-theme-material w-100 my-4 ag-grid-table"
        :columnDefs="columnDefs"
        :defaultColDef="defaultColDef"
        :rowData="UserList"
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

      <vs-pagination :total="totalPages" :max="50" v-model="currentPage" />
    </div>
  </div>
</template>

<script>
import { AgGridVue } from "ag-grid-vue";
import "@sass/vuexy/extraComponents/agGridStyleOverride.scss";
import vSelect from "vue-select";
import jwt from "@/http/requests/auth/jwt/index.js";
// Store Module
import moduleUserManagement from "@/store/user-management/moduleUserManagement.js";

// Cell Renderer
import CellRendererLink from "./cell-renderer/CellRendererLink.vue";
import CellRendererStatus from "./cell-renderer/CellRendererStatus.vue";
import CellRendererVerified from "./cell-renderer/CellRendererVerified.vue";
import CellRendererActions from "./cell-renderer/CellRendererActions.vue";

//Components
import DataViewSidebar from "../QuickViewAndAdd.vue";

export default {
  components: {
    AgGridVue,
    DataViewSidebar,
    vSelect,

    // Cell Renderer
    CellRendererLink,
    CellRendererStatus,
    CellRendererVerified,
    CellRendererActions,
  },
  data() {
    return {
      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {},
      allUsers: {},
      searchQuery: "",
      // AgGrid
      gridApi: null,
      gridOptions: {},
      defaultColDef: {
        sortable: true,
        resizable: true,
        suppressMenu: true,
      },
      columnDefs: [
        {
          headerName: "ID",
          field: "id",
          width: 125,
          filter: true,
          checkboxSelection: true,
          headerCheckboxSelectionFilteredOnly: true,
          headerCheckboxSelection: true,
        },
        {
          headerName: "İsim",
          field: "name",
          filter: true,
          width: 200,
        },
        {
          headerName: "Email",
          field: "email",
          filter: true,
          width: 225,
        },
        {
          headerName: "Telefon Numarası",
          field: "phone",
          filter: true,
          width: 210,
        },
        {
          headerName: "Rolü",
          field: "role",
          filter: true,
          width: 150,
        },
        {
          headerName: "Doğrulanma",
          field: "email_verified_at",
          filter: true,
          width: 125,
          cellRendererFramework: "CellRendererVerified",
          cellClass: "text-center",
        },
        {
          headerName: "Seçenekler",
          field: "transactions",
          width: 150,
          cellRendererFramework: "CellRendererActions",
        },
      ],

      // Cell Renderer Components
      components: {
        CellRendererLink,
        CellRendererStatus,
        CellRendererVerified,
        CellRendererActions,
      },
    };
  },
  watch: {
    roleFilter(obj) {
      this.setColumnFilter("role", obj.value);
    },
    statusFilter(obj) {
      this.setColumnFilter("status", obj.value);
    },
    isVerifiedFilter(obj) {
      let val =
        obj.value === "all" ? "all" : obj.value == "yes" ? "true" : "false";
      this.setColumnFilter("is_verified", val);
    },
    departmentFilter(obj) {
      this.setColumnFilter("department", obj.value);
    },
  },
  computed: {
    UserList() {
      return this.$store.state.user.users;
    },
    paginationPageSize() {
      if (this.gridApi) return this.gridApi.paginationGetPageSize();
      else return 10;
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
    addNewData() {
      this.sidebarData = {};
      this.toggleDataSidebarUser(true);
    },
    deleteData(id) {
      this.$store.dispatch("userManagement/removeRecord", id).catch((err) => {
        console.error(err);
      });
    },
    editData(data) {
      // this.sidebarData = JSON.parse(JSON.stringify(this.blankData))
      this.sidebarData = data;
      this.toggleDataSidebarUser(true);
    },
    toggleDataSidebarUser(val = false) {
      this.addNewDataSidebar = val;
    },
    setColumnFilter(column, val) {
      const filter = this.gridApi.getFilterInstance(column);
      let modelObj = null;

      if (val !== "all") {
        modelObj = { type: "equals", filter: val };
      }

      filter.setModel(modelObj);
      this.gridApi.onFilterChanged();
    },
    resetColFilters() {
      // Reset Grid Filter
      this.gridApi.setFilterModel(null);
      this.gridApi.onFilterChanged();

      // Reset Filter Options
      this.roleFilter = this.statusFilter = this.isVerifiedFilter = this.departmentFilter = {
        label: "All",
        value: "all",
      };

      this.$refs.filterCard.removeRefreshAnimation();
    },
    updateSearchQuery(val) {
      this.gridApi.setQuickFilter(val);
    },
    fetchUsers() {
      jwt.fetchUsers().then((response) => {
        // Update user details
        this.allUsers = response.data;
      });
    },
    confirmDeleteRecord() {
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: `Confirm Delete`,
        text: `You are about to delete "${this.params.data.username}"`,
        accept: this.deleteRecords,
        acceptText: "Delete",
      });
    },
    deleteRecords(id) {
      console.log(this.params);
      /* UnComment below lines for enabling true flow if deleting user */
      // this.$store.dispatch("userManagement/removeRecord", this.params.data.id)
      //   .then(()   => { this.showDeleteSuccess() })
      //   .catch(err => { console.error(err)       })
    },
    showDeleteSuccess() {
      this.$vs.notify({
        color: "success",
        title: "User Deleted",
        text: "The selected user was successfully deleted",
      });
    },
  },
  mounted() {
    this.gridApi = this.gridOptions.api;
    //console.log('all users',this.allUsers)

    /* =================================================================
      NOTE:
      Header is not aligned properly in RTL version of agGrid table.
      However, we given fix to this issue. If you want more robust solution please contact them at gitHub
    ================================================================= */
    if (this.$vs.rtl) {
      const header = this.$refs.agGridTable.$el.querySelector(
        ".ag-header-container"
      );
      header.style.left =
        "-" + String(Number(header.style.transform.slice(11, -3)) + 9) + "px";
    }
  },
  created() {
    if (!moduleUserManagement.isRegistered) {
      this.$store.registerModule("userManagement", moduleUserManagement);
      moduleUserManagement.isRegistered = true;
    }
    this.$store.dispatch("userManagement/fetchUsers").catch((err) => {
      console.error(err);
    });
  },
};
</script>

<style lang="scss">
#page-user-list {
  .user-list-filters {
    .vs__actions {
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-58%);
    }
  }
}
</style>
