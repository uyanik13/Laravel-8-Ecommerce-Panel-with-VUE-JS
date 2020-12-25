<!-- =========================================================================================
  File Name: ECommerceCheckout.vue
  Description: eCommerce Checkout page
  ----------------------------------------------------------------------------------------

  
  
========================================================================================== -->

<template>
    <div id="ecommerce-checkout-demo">
        <div class="vx-row" v-if="JSON.parse(item.order_details).length">

                    <!-- LEFT COL -->
                     <div class="vx-col lg:w-2/3 w-full relative">
                        <div class="items-list-view" v-for="(product) in JSON.parse(item.order_details)" :key="product.id">
                            <item-list-view :item="product" class="mb-base">
                                <template slot="item-meta">
                                     <h6 class="item-name font-semibold mb-1 cursor-pointer hover:text-primary">{{ product.post.title }}</h6>
                                     <p class="mt-4 font-bold text-sm"> {{$t('Quantity')}} </p>
                                    <p class="mt-4 font-bold text-sm">{{product.quantity}}</p>
                                </template>
                            </item-list-view>
                        </div>
                    </div>

                    <!-- RIGHT COL -->
                    <div class="vx-col lg:w-1/3 w-full">
                        <vx-card>
                             <p class="font-semibold mb-3">{{$t('OrderStatus')}}</p>
                                <div class="flex justify-between font-semibold mb-3">
                                    <vs-select v-model="order_status" :label="$t('OrderStatus')" class="mt-5 w-full">
                                    <vs-select-item :key="status.value" :value="status.value" :text="status.text" v-for="status in order_status_choices" />
                                    </vs-select>

                            </div>
                            <vs-divider/>

                            <p class="font-semibold mb-3">{{$t('PriceDetails')}}</p>
                                <div class="flex justify-between font-semibold mb-3">
                                    <span>{{$t('Total')}}</span>
                                <span>${{item.price}}</span>
                                </div>

                            <vs-button class="w-full" @click="ChangeOrderStatus(item)">{{$t('ChangeOrderStatus')}}</vs-button>
                        </vx-card>
                    </div>
                </div>
    </div>
</template>

<script>
const ItemListView = () => import('./components/ItemListView.vue')
import i18n from '@/i18n/i18n'

export default {
  data () {
    return {
      order_status_choices: [
        {text: i18n.t('in_process'), value:'in_process'},
        {text: i18n.t('shipped'), value:'shipped'},
        {text: i18n.t('cancelled'), value:'cancelled'},
        {text: i18n.t('completed'), value:'completed'}
      ],
      order_status : ''
    }
  },
  props: {
    item: {}
  },
  computed: {

  },
  methods: {
    ChangeOrderStatus (data) {
      this.$vs.loading()
      const obj = {
        id:data.id,
        order_status: this.order_status
      }
      this.$store.dispatch('admin/updateOrder', obj).then((response) => {
        this.$vs.loading.close()
        this.$vs.notify({
          title: 'Başarılı',
          text: `${response.data.order_id } ${ i18n.t('idOrderStatusChanged')}`,
          iconPack: 'feather',
          icon: 'icon-success',
          color: 'success'
        })

      })
    }
  },
  components: {
    ItemListView
  },
  created () {
    this.order_status = this.item.order_status
  }
}
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

            .wizard-tab-container{
              margin-bottom: 0 !important;
            }
        }
    }
}
</style>
