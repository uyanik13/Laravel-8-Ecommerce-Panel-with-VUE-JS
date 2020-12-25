<template>
  <div id="data-list-thumb-view" class="data-list-container">

    <sidebar :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :data="sidebarData" />

    <vs-table ref="table"  multiple v-model="selected" pagination :max-items="itemsPerPage" search :data="dataList">

      <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">

        <div class="flex flex-wrap-reverse items-center data-list-btn-container">

          <!-- ADD NEW -->
          <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary" @click="addNewData">
              <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
              <span class="ml-2 text-base text-primary">{{$t('addPackage')}}</span>
          </div>
        </div>


      </div>

      <template slot="thead">
        <vs-th sort-key="id">{{$t('packageId')}}</vs-th>
        <vs-th sort-key="thumbnail">{{$t('image')}}</vs-th>
        <vs-th sort-key="title">{{$t('packageTitle')}}</vs-th>
        <vs-th sort-key="second_title">{{$t('packageSecondTitle')}}</vs-th>
        <vs-th sort-key="monthly_price">{{$t('MonthlyPrice')}}</vs-th>
        <vs-th sort-key="yearly_price">{{$t('YearlyPrice')}}</vs-th>
        <vs-th sort-key="type">{{$t('Type')}}</vs-th>
        <vs-th sort-key="popular">{{$t('Popular')}}</vs-th>
        <vs-th>{{$t('Action')}}</vs-th>
      </template>

        <template slot-scope="{data}">
          <tbody>
            <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
              <vs-td>
                <p class="product-name font-medium truncate">{{ tr.id }}</p>
              </vs-td>
               <vs-td class="img-container">
                <img :src="tr.thumbnail[locale]" class="product-img" height="100px" width="100px"/>
              </vs-td>
              <vs-td>
                <p class="product-name font-medium truncate">{{ tr.title[locale] }}</p>
              </vs-td>
              <vs-td>
                <p class="product-name font-medium truncate">{{ tr.second_title[locale] }}</p>
              </vs-td>
              <vs-td>
                <p class="product-name font-medium truncate">{{ tr.monthly_price }}</p>
              </vs-td>
              <vs-td>
                <p class="product-name font-medium truncate">{{ tr.yearly_price }}</p>
              </vs-td>

              <vs-td>
                <p class="product-name font-medium truncate">{{ tr.type }}</p>
              </vs-td>

              <vs-td>
                <vs-chip :color="getOrderStatusColor(tr.popular)" class="product-order-status">{{ tr.popular == '1' ? $t('Popular') : $t('Normal')}}</vs-chip>
              </vs-td>


              <vs-td class="whitespace-no-wrap">
                <feather-icon icon="EditIcon" svgClasses="w-7 h-7 hover:text-primary stroke-current" @click="editData(tr)" />
                <feather-icon icon="TrashIcon" svgClasses="w-7 h-7 hover:text-danger stroke-current" class="ml-2" @click.stop="deleteData(tr.id)" />
              </vs-td>

            </vs-tr>
          </tbody>
        </template>
    </vs-table>
  </div>
</template>

<script>
import Sidebar from './sidebar.vue'
import Swal from 'sweetalert2'
import i18n from "@/i18n/i18n";

export default {
  components: {
    Sidebar,

  },
  data() {
    return {
      selected: [],

      itemsPerPage: 10,
      isMounted: false,

      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {}
    }
  },
  computed: {
      currentPage () {
        if (this.isMounted) {
        return this.$refs.table.currentx
      }
      return 0
    },
    dataList() {
      return this.$store.state.package.packages
    },
    locale () {
        return this.$i18n.locale
        },

    queriedItems () {
      return this.$refs.table ? this.$refs.table.queriedResults.length : this.dataList.length
    }
  },
  methods: {
    addNewData() {
      this.sidebarData = {
          newData: true,
      }
      this.toggleDataSidebar(true)
    },
    deleteData(id) {
      Swal.fire({
        type: 'warning',
        title: i18n.t('areYouSureToDeleteThis'),
        text: i18n.t('areYouSureToDeleteData'),
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonText: i18n.t('ok'),
        cancelButtonText: i18n.t('cancel')
      }).then((result) => {
        if (result.value) {
          console.log(result)
          this.$store.dispatch("package/removeItem", id)
            .then((response) => {
              this.showAlert(i18n.t('Success'),i18n.t('SuccessfullyDeleted'),'icon-success','success')
            })
            .catch(error => {
              this.showAlert(i18n.t('Error'),i18n.t('CouldntDelete'),'icon-alert-circle','danger')
            })
        }
      }).catch((error) => {
        console.log('ERROR:', error)
      });
    },
    editData(data) {
      // this.sidebarData = JSON.parse(JSON.stringify(this.blankData))
      this.sidebarData = {
           newData : false,
        data:data,
      }
      this.toggleDataSidebar(true)
    },
    getOrderStatusColor(status) {
      if(status == '1') return "success"
      if(status == '0') return "#10163A"
      return "#10163A"
    },
    toggleDataSidebar(val=false) {
      this.addNewDataSidebar = val
    },
    showAlert(title,text,icon,color){
      this.$vs.notify({
        title: title,
        text: text,
        iconPack: 'feather',
        icon: icon,
        color: color
      })
    },
  },
  created() {
    this.$store.dispatch("package/fetchItems")
  },
  mounted() {
    this.isMounted = true;
  }
}
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

      .vs-table--search{
        padding-top: 0;

        .vs-table--search-input {
          padding: 0.9rem 2.5rem;
          font-size: 1rem;

          &+i {
            left: 1rem;
          }

          &:focus+i {
            left: 1rem;
          }
        }
      }
    }

    .vs-table {
      border-collapse: separate;
      border-spacing: 0 1.3rem;
      padding: 0 1rem;

      tr{
          box-shadow: 0 4px 20px 0 rgba(0,0,0,.05);
          td{
            padding: 20px;
            &:first-child{
              border-top-left-radius: .5rem;
              border-bottom-left-radius: .5rem;
            }
            &:last-child{
              border-top-right-radius: .5rem;
              border-bottom-right-radius: .5rem;
            }
          }
          td.td-check{
            padding: 20px !important;
          }
      }
    }

    .vs-table--thead{
      th {
        padding-top: 0;
        padding-bottom: 0;

        .vs-table-text{
          text-transform: uppercase;
          font-weight: 600;
        }
      }
      th.td-check{
        padding: 0 15px !important;
      }
      tr{
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
