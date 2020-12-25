<template>
  <vx-card no-shadow>

      <div v-show="verifyRequests !== undefined">
           <vx-card slot="no-body" v-if="verifyRequests !== undefined && verifyRequests.status === 'pending'" class="text-center bg-primary-gradient greet-user">
          <feather-icon icon="LoaderIcon" class="p-6 mb-8 bg-primary inline-flex rounded-full text-white shadow" svgClasses="h-8 w-8"></feather-icon>
          <h1 class="mb-6 text-white">{{$t('YourVerifyUnderReview')}}</h1>
        </vx-card>

         <vx-card slot="no-body" v-else-if="verifyRequests !== undefined && verifyRequests.status === 'rejected'" class="text-center bg-primary-gradient greet-user">
          <feather-icon icon="XIcon" class="p-6 mb-8 bg-primary inline-flex rounded-full text-white shadow" svgClasses="h-8 w-8"></feather-icon>
          <h1 class="mb-6 text-white">{{$t('YourVerifyRejected')}}</h1>
        </vx-card>

         <vx-card slot="no-body" v-else-if="verifyRequests !== undefined && verifyRequests.status === 'verified'" class="text-center bg-primary-gradient greet-user">
          <feather-icon icon="CheckIcon" class="p-6 mb-8 bg-primary inline-flex rounded-full text-white shadow" svgClasses="h-8 w-8"></feather-icon>
          <h1 class="mb-6 text-white">{{$t('YourVerifyVerified')}}</h1>
        </vx-card>
      </div>

    <vx-card v-show="!verifyRequests || verifyRequests.status === 'rejected' ">
     <!-- Img Row -->
    <div class="flex flex-wrap items-center mb-base" >
      <vs-avatar :src="lawyerPhoto"  size="250px" class="mr-4 mb-4" />
      <div>
        <input type="file" class="hidden" ref="updateLawyerPhoto" @change="updateLawyerPhoto" accept="image/*">
        <vs-button class="mr-4 sm:mb-0 mb-2" @click="$refs.updateLawyerPhoto.click()">{{$t('UploadYourPicture')}}</vs-button>
      </div>
    </div>

    <div class="flex flex-wrap items-center mb-base">
      <vs-avatar :src="passportPhoto"  size="250px" class="mr-4 mb-4" />
      <div>
        <input type="file" class="hidden" ref="updatePassportPhoto" @change="updatePassportPhoto" accept="image/*">
        <vs-button class="mr-4 sm:mb-0 mb-2" @click="$refs.updatePassportPhoto.click()">{{$t('UploadYourPassport')}}</vs-button>
      </div>
    </div>

    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2"  @click="save_changes">{{$t('Save')}}</vs-button>
    </div>
    </vx-card>

  </vx-card>
</template>

<script>

export default {
  created () {
    this.$store.dispatch('user/fetchUser')
    this.$store.dispatch('user/fetchVerifyRequests')

  },
  data () {
    return {
      lawyerPhoto : '',
      passportPhoto : '',
      status : 'rejected'

    }
  },
  computed: {
    validateForm () {
      return !this.errors.any()
    },
     activeUser () {
      return this.$store.state.auth.user
    },
     verifyRequests () {
      return this.$store.state.user.verifyRequests[0]
    },

  },
  methods:{
    save_changes () {
      if (!this.validateForm) return
      const payload = {
        id: this.activeUser.id,
        lawyerPhoto: this.lawyerPhoto,
        passportPhoto: this.passportPhoto

      }
      this.$store.dispatch('user/createVerify', payload)
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

    updateLawyerPhoto (input) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()
        reader.onload = e => {
          this.lawyerPhoto = e.target.result
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },

    updatePassportPhoto (input) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()
        reader.onload = e => {
          this.passportPhoto = e.target.result
        }
        reader.readAsDataURL(input.target.files[0])
      }
    }

  }
}
</script>
