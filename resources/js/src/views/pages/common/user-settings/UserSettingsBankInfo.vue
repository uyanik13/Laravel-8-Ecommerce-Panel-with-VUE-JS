<template>
  <vx-card no-shadow>

    <vs-input class="w-full mb-base" :label-placeholder="$t('name')" v-model="name"></vs-input>
    <vs-input class="w-full mb-base"  :label-placeholder="$t('iban')" v-model="iban"></vs-input>
    <vs-input class="w-full mb-base" :label-placeholder="$t('bic')" v-model="bic"></vs-input>
    <vs-input class="w-full mb-base" :label-placeholder="$t('bankAddress')" v-model="bankAddress"></vs-input>

    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2"  @click="save_changes">{{$t('Save')}}</vs-button>
    </div>
  </vx-card>
</template>

<script>
export default {
  data () {
    return {
      iban :'',
      bic :'',
      name :'',
      bankAddress :''
    }
  },
   props: {
    user: {
      type: Object,
      default: () => {
      }
    }
  },
  computed: {
    validateForm () {
      return !this.errors.any()
    }
  },
  methods:{
    save_changes () {
      if (!this.validateForm) return
      const obj = {
        id: this.user.id,
        payment_data: {
          iban: this.iban,
          bic: this.bic,
          name: this.name,
          bankAddress: this.bankAddress
        }

      }
      this.$store.dispatch('user/updateUser', obj)
        .then((response) => {
          this.$vs.loading.close()
          if (response.data) this.$vs.notify({
            title: 'Success',
            text: 'Succesfully updated',
            iconPack: 'feather',
            icon: 'icon-alert-circle',
            color: 'success'
          })
        })
        .catch(error => {
          this.$vs.loading.close()
          this.$vs.notify({
            title: 'Error',
            text: error.message,
            iconPack: 'feather',
            icon: 'icon-alert-circle',
            color: 'danger'
          })
        })
    },
    appendData () {
      this.iban = this.user.payment_data.iban
      this.bic = this.user.payment_data.bic
      this.name = this.user.payment_data.name
      this.bankAddress = this.user.payment_data.bankAddress
    }
    
  },
  created () {
    this.appendData()
  }
}
</script>
