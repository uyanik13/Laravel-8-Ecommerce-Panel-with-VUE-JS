<template>
  <vx-card no-shadow>

    <vs-input class="w-full mb-base" :label-placeholder="$t('oldPassword')" v-model="old_password" />
    <vs-input class="w-full mb-base" :label-placeholder="$t('newPassword')" v-model="new_password" />
    <vs-input class="w-full mb-base" :label-placeholder="$t('newPasswordConfirm')" v-model="confirm_new_password" />

    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2" @click="save_changes" >{{$t('save')}}</vs-button>
<!--      <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>-->
    </div>
  </vx-card>
</template>

<script>
import axios from 'axios'

export default {
  created () {
    axios.get('/api/user')
      .then((response) => { this.currentUserData = response.data })
      .catch((error) => { console.log(error) })
  },
  data () {
    return {
      currentUserData : {},
      old_password: '',
      new_password: '',
      confirm_new_password: ''
    }
  },
  computed: {
    validateForm () {
      return !this.errors.any()  && this.old_password != ''  && this.new_password != '' && this.confirm_new_password != ''
    }
  },
  methods:{
    save_changes () {
      if (!this.validateForm) return
      const payload = {
        id: this.currentUserData.id,
        old_password: this.old_password,
        new_password: this.new_password,
        confirm_new_password: this.confirm_new_password
      }
      this.$store.dispatch('user/updateUser', payload)
        .then((response) => {
          this.$vs.loading.close()
          if (response.data) this.$vs.notify({
            title: 'Success',
            text: 'Password Successfully Changed',
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
    }
  }
}
</script>
