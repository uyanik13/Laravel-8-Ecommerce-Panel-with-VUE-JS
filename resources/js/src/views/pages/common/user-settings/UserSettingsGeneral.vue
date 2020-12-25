<template>
  <vx-card no-shadow>

    <!-- Img Row -->
    <div class="flex flex-wrap items-center mb-base">
      <vs-avatar :src="currentUserData.avatar" v-if="avatar === null" size="70px" class="mr-4 mb-4" />
      <vs-avatar :src="avatar" v-else size="70px" class="mr-4 mb-4" />
      <div>
        <input type="file" class="hidden" ref="updateImgInput" @change="update_avatar" accept="image/*">
        <vs-button class="mr-4 sm:mb-0 mb-2" @click="$refs.updateImgInput.click()">{{$t('pictureUpload')}}</vs-button>
        <p v-show="avatar !== null"> {{$t('saveYourPicture')}}</p>
      </div>
    </div>


    <!-- Info -->
<!--    <vs-input class="w-full mb-base" name="username" disabled="" label-placeholder="Username" v-model="currentUserData.username"></vs-input>-->
    <vs-input class="w-full mb-base" name="name" :label-placeholder="$t('name')" v-model="currentUserData.name"></vs-input>
    <vs-input class="w-full" :label-placeholder="$t('email')" disabled="" name="email" v-model="currentUserData.email"></vs-input>
    <vs-input class="w-full" :label-placeholder="$t('phone')" disabled="" name="phone" v-model="currentUserData.phone"></vs-input>

<!--    <vs-alert icon-pack="feather" icon="icon-info" class="h-full my-4" color="warning" v-show="!currentUserData.email_verified_at">-->
<!--      <span>Hesabınız Onaylı Değil. <a href="#" @click="emailVerify" class="hover:underline">Onay Emaili Gönder</a></span>-->
<!--    </vs-alert>-->

    <vs-input class="w-full my-base" :label-placeholder="$t('address')" name="address" v-model="currentUserData.address"></vs-input>

    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2"  @click="save_changes">{{$t('Save')}}</vs-button>
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
    //console.log('PHOTOURL',this.photo_url)
  },
  data () {
    return {
      currentUserData : {},
      avatar :null
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
      const payload = {
        id: this.currentUserData.id,
        name: this.currentUserData.name,
        address: this.currentUserData.address,
        avatar: this.avatar
      }
      this.$store.dispatch('user/updateUser', payload)
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

    reset_data () {
      this.data_local = JSON.parse(JSON.stringify(this.data))
    },
    update_avatar (input) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()
        reader.onload = e => {
          this.avatar = e.target.result
          //console.log('IMAGEURL',e.target.result)
        }
        reader.readAsDataURL(input.target.files[0])
      }
    }

  }
}
</script>
