<template>
  <vx-card no-shadow>

    <div class="mb-base">
      <h6 class="mb-4">{{$t('Activitiy')}}</h6>

      <div class="flex items-center mb-4">
        <vs-switch v-model="comment" />
        <span class="ml-4">{{$t('email_me_when_someone_comments_on_my_article')}}</span>
      </div>
      <div class="flex items-center mb-4">
        <vs-switch v-model="answer" />
        <span class="ml-4">{{$t('email_me_when_someone_comments_on_my_answer')}}</span>
      </div>
      <div class="flex items-center mb-4">
        <vs-switch v-model="follow" />
        <span class="ml-4">{{$t('email_me_when_someone_follow_me')}}</span>
      </div>
    </div>

    <div>
      <h6 class="mb-4">{{$t('Application')}}</h6>

      <div class="flex items-center mb-4">
        <vs-switch v-model="news" />
        <span class="ml-4">{{$t('news_and_announcements')}}</span>
      </div>
    </div>

    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2"  @click="save_changes">{{$t('Save')}}</vs-button>
    </div>

  </vx-card>
</template>

<script>
import axios from 'axios';

export default {
  created() {
    this.appendData()
  },
  data() {
    return {
      comment: true,
      answer: true,
      follow: false,
      news: false,
      product_update: false,
      blog: true,
    }
  },
  props: {
    user: {
      type: Object,
      default: () => {},
    }
  },
  watch: {

  },
  computed: {
    validateForm() {
      return !this.errors.any()
    },
  },
  methods:{
    save_changes() {
      if(!this.validateForm) return
      const payload = {
        id: this.user.id,
        notification_data :{
          comment: this.comment,
          answer: this.answer,
          follow: this.follow,
          news: this.news,
          product_update: this.product_update,
          blog: this.blog,
        }
      }
      this.$store.dispatch('user/updateUser',payload)
        .then((response) => { this.$vs.loading.close()
          if(response.data)
            this.$vs.notify({
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
    appendData(){
      this.comment = this.user.notification_data.comment
      this.answer = this.user.notification_data.answer
      this.follow = this.user.notification_data.follow
      this.news = this.user.notification_data.news
      this.product_update =this.user.notification_data.product_update
      this.blog =this.user.notification_data.blog

    }

  },

}
</script>
