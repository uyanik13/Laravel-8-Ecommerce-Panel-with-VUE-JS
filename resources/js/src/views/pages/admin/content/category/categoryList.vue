<!-- =========================================================================================
  File Name: DataListListView.vue
  Description: Data List - List View
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
========================================================================================== -->

<template>
  <div id="data-list-list-view" class="data-list-container">
    <category-sidebar
      :isSidebarActive="addNewDataSidebar"
      @closeSidebar="toggleDataSidebar"
      :data="sidebarData"
    />

    <vs-table
      ref="table"
      pagination
      :max-items="itemsPerPage"
      search
      :data="blogPosts"
    >
      <div
        slot="header"
        class="flex flex-wrap-reverse items-center flex-grow justify-between"
      >
        <div
          class="flex flex-wrap-reverse items-center data-list-btn-container"
        >
          <!-- ADD NEW -->
          <div
            class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary"
            @click="addNewData"
          >
            <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
            <span class="ml-2 text-base text-primary">{{
              $t("addCategory")
            }}</span>
          </div>
        </div>

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
                blogPosts.length - currentPage * itemsPerPage > 0
                  ? currentPage * itemsPerPage
                  : blogPosts.length
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
        <vs-th sort-key="id">{{ $t("id") }}</vs-th>
        <vs-th sort-key="title">{{ $t("CategoryName") }}</vs-th>
        <vs-th sort-key="slug">{{ $t("categoryUrl") }}</vs-th>
        <vs-th sort-key="seo_title">{{ $t("seoTitle") }}</vs-th>
        <vs-th sort-key="seo_description">{{ $t("seoDescription") }}</vs-th>
        <vs-th>{{ $t("actions") }}</vs-th>
      </template>

      <template slot-scope="{ data }">
        <tbody>
          <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
            <vs-td>
              <p class="product-name font-medium truncate">{{ tr.id }}</p>
            </vs-td>
            <vs-td>
              <p class="product-name font-medium truncate">
                {{ tr.title[locale] }}
              </p>
            </vs-td>
            <vs-td>
              <p class="product-name font-medium truncate">
                {{ tr.slug[locale] }}
              </p>
            </vs-td>
            <vs-td>
              <p class="product-name font-medium truncate">
                {{ tr.seo_title[locale] }}
              </p>
            </vs-td>
            <vs-td>
              <p class="product-name font-medium truncate">
                {{ tr.seo_description[locale] }}
              </p>
            </vs-td>

            <vs-td class="whitespace-no-wrap">
              <feather-icon
                icon="EditIcon"
                svgClasses="w-7 h-7 hover:text-primary stroke-current"
                @click="editData(tr)"
              />
              <feather-icon
                icon="TrashIcon"
                v-show="
                  tr.id !== 1 && tr.id !== 2 && tr.id !== 3 && tr.id !== 4
                "
                svgClasses="w-7 h-7 hover:text-danger stroke-current"
                class="ml-2"
                @click.stop="deleteData(tr.id)"
              />
            </vs-td>
          </vs-tr>
        </tbody>
      </template>
    </vs-table>
  </div>
</template>

<script>
import CategorySidebar from "./CategorySidebar.vue";
import moduleCategory from "@/store/category/moduleCategory";
import Swal from "sweetalert2";
import i18n from "@/i18n/i18n";

export default {
  components: {
    CategorySidebar,
  },
  data() {
    return {
      selected: [],
      user: {},
      itemsPerPage: 10,
      isMounted: false,

      // Data Sidebar
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
    blogPosts() {
      return this.$store.state.category.categories;
    },
    locale() {
      return this.$i18n.locale;
    },
    queriedItems() {
      return this.$refs.table
        ? this.$refs.table.queriedResults.length
        : this.blogPosts.length;
    },
  },
  methods: {
    addNewData() {
      this.sidebarData = {
        newData: true,
        categories: this.blogPosts,
      };
      this.toggleDataSidebar(true);
    },
    deleteData(id) {
      Swal.fire({
        type: "warning",
        title: i18n.t("areYouSureToDeleteThis"),
        text: i18n.t("areYouSureToDeleteData"),
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonText: i18n.t("ok"),
        cancelButtonText: i18n.t("cancel"),
      })
        .then((result) => {
          if (result.value) {
            console.log(result);
            this.$store
              .dispatch("categoryModule/removeItem", id)
              .then((response) => {
                this.$vs.notify({
                  title: "Başarılı",
                  text: response.data.title[en] + " " + i18n.t("deleted"),
                  iconPack: "feather",
                  icon: "icon-success",
                  color: "success",
                });
              })
              .catch((error) => {
                this.$vs.notify({
                  title: "Hata",
                  text: "İçerik Silinemedi.",
                  iconPack: "feather",
                  icon: "icon-alert-circle",
                  color: "danger",
                });
              });
          }
        })
        .catch((error) => {
          console.log("ERROR:", error);
        });
    },
    editData(data) {
      // this.sidebarData = JSON.parse(JSON.stringify(this.blankData))
      this.sidebarData = {
        newData: false,
        categories: this.categoryList,
        data,
      };
      this.toggleDataSidebar(true);
    },
    getOrderStatusColor(status) {
      // if(status == 'open') return "warning"
      if (status == "1") return "success";
      if (status == "0") return "primary";
      return "primary";
    },
    getPopularityColor(num) {
      if (num > 90) return "success";
      if (num > 70) return "primary";
      if (num >= 50) return "warning";
      if (num < 50) return "danger";
      return "primary";
    },
    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val;
    },
  },
  created() {
    if (!moduleCategory.isRegistered) {
      this.$store.registerModule("categoryModule", moduleCategory);
      moduleCategory.isRegistered = true;
    }
    this.$store.dispatch("categoryModule/fetchItems");
  },
  mounted() {
    this.isMounted = true;
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
