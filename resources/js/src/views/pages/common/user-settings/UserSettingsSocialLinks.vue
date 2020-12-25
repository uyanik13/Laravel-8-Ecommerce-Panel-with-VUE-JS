<template>
  <vx-card no-shadow>

    <vs-input class="w-full mb-base" v-model="twitter" icon-pack="feather" icon="icon-twitter" :label="$t('Twitter')" icon-no-border />
    <vs-input class="w-full mb-base" v-model="facebook" icon-pack="feather" icon="icon-facebook" :label="$t('Facebook')"  icon-no-border />
    <vs-input class="w-full mb-base" v-model="instagram" icon-pack="feather" icon="icon-instagram" :label="$t('Instagram')"  icon-no-border />
    <vs-input class="w-full mb-base" v-model="github" icon-pack="feather" icon="icon-github" :label="$t('Github')"  icon-no-border />
    <vs-input class="w-full mb-base" v-model="linkedin" icon-pack="feather" icon="icon-linkedin" :label="$t('Linkedin')"  icon-no-border />
    <vs-input class="w-full mb-base" v-model="slack" icon-pack="feather" icon="icon-slack" :label="$t('Slack')"  icon-no-border />
    <vs-input class="w-full mb-base" v-model="youtube" icon-pack="feather" icon="icon-youtube" :label="$t('Youtube')"  icon-no-border />

    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2"  @click="save_changes">{{$t('Save')}}</vs-button>
    </div>
  </vx-card>
</template>

<script>
import axios from 'axios'

export default {

  data () {
    return {
      twitter: null,
      facebook: null,
      instagram: null,
      github: null,
      linkedin: null,
      youtube: null,
      slack: null
    }
  },
  created () {
    this.appendData()
  },
  props: {
    user: {
      type: [Object,Array],
      default: () => {}
    },
  },
  watch: {

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
        id: this.user.id,
        social_data :{
          twitter: this.twitter,
          facebook: this.facebook,
          instagram: this.instagram,
          github: this.github,
          linkedin: this.linkedin,
          youtube: this.youtube,
          slack: this.slack
        }
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
    appendData () {
      this.twitter = this.user.social_data.twitter
      this.facebook = this.user.social_data.facebook
      this.instagram = this.user.social_data.instagram
      this.github = this.user.social_data.github
      this.linkedin = this.user.social_data.linkedin
      this.youtube = this.user.social_data.youtube
      this.slack = this.user.social_data.slack
    }

  }

}
</script>
