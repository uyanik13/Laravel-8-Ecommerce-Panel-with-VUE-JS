<!-- =========================================================================================
  File Name: DataListThumbView.vue
  Description: Data List - Thumb View
  ----------------------------------------------------------------------------------------

  
  
========================================================================================== -->

<template>
  <div id="data-list-thumb-view" class="data-list-container">
    <!-- <div class="vx-col w-4/5 sm:w-4/5 md:w-3/5 lg:w-3/4 xl:w-3/5 mx-auto self-center">-->
    <div class="vx-col w-3/5 sm:w-2/4 ">
      <vs-table ref="table"
                multiple v-model="selected"
                pagination :max-items="itemsPerPage"
                search
                :data="data">

        <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">


          <!-- ITEMS PER PAGE -->
          <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4">
            <div
              class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
              <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ data.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : data.length }} of {{ queriedItems }}</span>
              <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4"/>
            </div>
            <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
            <vs-dropdown-menu>

              <vs-dropdown-item @click="itemsPerPage=4">
                <span>4</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="itemsPerPage=10">
                <span>10</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="itemsPerPage=15">
                <span>15</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="itemsPerPage=20">
                <span>20</span>
              </vs-dropdown-item>
            </vs-dropdown-menu>
          </vs-dropdown>
        </div>

        <template slot="thead">
          <vs-th sort-key="name">{{$t('Name')}}</vs-th>
          <vs-th>Action</vs-th>
        </template>

        <template slot-scope="{data}">
          <tbody>
          <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">


            <vs-td>
              <p class="product-name font-medium truncate">{{ tr.name }}</p>
            </vs-td>


            <vs-td class="whitespace-no-wrap">
              <vs-button class="mt-4" 
                            v-show="!FollowingForThisUser(tr.id)"
                             @click="follow(tr.id)" type="border"
                             color="#b9b9b9">{{ $t('Follow') }}</vs-button>
             
            </vs-td>

          </vs-tr>
          </tbody>
        </template>
      </vs-table>
    </div>
  </div>
</template>

<script>

import i18n from '@/i18n/i18n'

export default {
  components: {

  },
  props: {
    user: { },
    data: {
      type: Array
    }
  },
  data () {
    return {
      selected: [],
      itemsPerPage: 10
    }
  },
  computed: {
    currentPage () {
      if (this.isMounted) {
        return this.$refs.table.currentx
      }
      return 0
    },
    queriedItems () {
      return this.$refs.table ? this.$refs.table.queriedResults.length : this.data.length
    }
  },
  methods: {
    unFollow (data) {
      const obj = {id: data}
      this.$store.dispatch('user/unFollow', obj).then((response) => {
        this.showAlert(i18n.t('Success'), i18n.t('SuccessfullyUnFollowed'), 'icon-success', 'success')
      })
        .catch(error => {
          this.showAlert(i18n.t('Error'), i18n.t('CouldntFollow'), 'icon-alert-circle', 'danger')
        })
    },
    follow (data) {
      const obj = {id: data}
      this.$store.dispatch('user/follow',  obj).then((response) => {
        this.showAlert(i18n.t('Success'), i18n.t('SuccessfullyFollowed'), 'icon-success', 'success')
      })
        .catch(error => {
          this.showAlert(i18n.t('Error'), i18n.t('CouldntFollow'), 'icon-alert-circle', 'danger')
        })
    },
    showAlert (title, text, icon, color) {
      this.$vs.notify({
        title,
        text,
        iconPack: 'feather',
        icon,
        color
      })
    },
    FollowingForThisUser (id) {
      return this.$store.getters['user/amIFollowing'](id)
    }
  }
}
</script>

<style lang="scss">
  #data-list-thumb-view {
    .vs-con-table {

      .product-name {
        max-width: 23rem;
      }

      .vs-table--header {
        display: flex;
        flex-wrap: wrap-reverse;
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
            padding: 10px;
            &:first-child{
              border-top-left-radius: .5rem;
              border-bottom-left-radius: .5rem;
            }
            &:last-child{
              border-top-right-radius: .5rem;
              border-bottom-right-radius: .5rem;
            }
            &.img-container {
              // width: 1rem;
              // background: #fff;

              span {
                display: flex;
                justify-content: flex-start;
              }

              .product-img {
                height: 110px;
              }
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
