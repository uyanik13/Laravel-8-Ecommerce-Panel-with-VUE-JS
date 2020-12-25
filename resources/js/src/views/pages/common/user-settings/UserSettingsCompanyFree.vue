<template>
  <vx-card no-shadow>

    <vs-input class="w-full mb-base" name="name" :label="$t('CompanyName')" :placeholder="$t('CompanyName')" v-model="name"></vs-input>


    <div class="mt-3">
      <!-- SEO TITLE -->
      <vs-input :label="$t('SeoTitle')" v-model="seo_title" class="mt-5 w-full"  />
      <span class="text-danger text-sm" v-show="errors.has('seo_title')">{{ errors.first('seo_title') ? $t('Seo Title Required | Max 71 Character') : '' }}</span>
      <vs-progress :percent="Number(seo_title ? seo_title.length : 0 )" :color="getPopularityColorTitle(Number(seo_title ? seo_title.length : 0))" class="shadow-md" />

      <!-- SEO DESCRIPTION -->
      <vs-input :label="$t('SeoDescription')" v-model="seo_description" class="mt-5 w-full"  />
      <span class="text-danger text-sm" v-show="errors.has('seo_description')">{{ errors.first('seo_description') ? $t('Seo Description Required | Max 160 Character') : '' }}</span>
      <vs-progress :percent="Number(seo_description ? seo_description.length : 0)" :color="getPopularityColorDescription(Number(seo_description ? seo_description.length : 0))" class="shadow-md" />
    </div>


    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2"  @click="save_changes">{{$t('Save')}}</vs-button>
    </div>
  </vx-card>
</template>

<script>
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import vSelect from 'vue-select'
import axios from 'axios'


export default {
  components: {
    flatPickr,
    vSelect
  },
  created () {
    this.appendData()
  },
  data () {
    return {
      name: null,
      type: '',
      seo_title: '',
      seo_description: ''

    }
  },
  props: {
    user: {
      type: Object,
      default: () => {}
    }
  },

  computed: {
    validateForm () {
      return !this.errors.any()
    }
  },
  methods:{
    getPopularityColorTitle (num) {
      if (num > 71) return 'dark'
      if (num >= 60 && num <= 71) return 'success'
      if (num < 60) return 'primary'
      return 'primary'
    },
    getPopularityColorDescription (num) {
      if (num > 160) return 'dark'
      if (num >= 145 && num <= 170) return 'success'
      if (num < 145) return 'primary'
      return 'primary'
    },
    save_changes () {
      if (!this.validateForm) return
      const payload = {
        id: this.user.id,
        name: this.name,
        type: this.type,
        seo_title: this.seo_title,
        seo_description: this.seo_description
      }
      this.$store.dispatch('user/updateCompany', payload)
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
      this.name = this.user.company.name
      this.type = this.user.company.type
      this.seo_title = this.user.company.seo_title
      this.seo_description = this.user.company.seo_description
    }

  }

}
</script>
