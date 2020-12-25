<template>
  <vs-dropdown vs-custom-content vs-trigger-click class="cursor-pointer">
    <span class="cursor-pointer flex items-center i18n-locale">
      <img class="h-4 w-5" :src="i18n_locale_img" :alt="$i18n.locale" />
      <span class="hidden sm:block ml-2">{{ getCurrentLocaleData.lang }}</span>
    </span>
    <vs-dropdown-menu class="w-48 i18n-dropdown vx-navbar-dropdown">
      <vs-dropdown-item @click="updateLocale('en')"><img class="h-4 w-5 mr-1" src="@assets/images/flags/en.png" alt="en" /> &nbsp;{{$t('English')}}</vs-dropdown-item>
      <vs-dropdown-item @click="updateLocale('tr')"><img class="h-4 w-5 mr-1" src="@assets/images/flags/tr.png" alt="tr" /> &nbsp;{{$t('Turkish')}}</vs-dropdown-item>
      <vs-dropdown-item @click="updateLocale('de')"><img class="h-4 w-5 mr-1" src="@assets/images/flags/de.png" alt="de" /> &nbsp;{{$t('German')}}</vs-dropdown-item>

    </vs-dropdown-menu>
  </vs-dropdown>
</template>

<script>
import axios from 'axios'
export default {
  computed: {
    i18n_locale_img () {
      // Use below code to dynamically fetch image instead of if-else
      // NOTE: We used if-else because laravel throws error in 'yarn prod'.
      // If you are not using laravel + Vue, you can use below code to dynamically get image
      // return require(`@assets/images/flags/${this.$i18n.locale}.png`)

      const locale = this.$i18n.locale
      if (locale === 'en')      return require('@assets/images/flags/en.png')
      else if (locale === 'tr') return require('@assets/images/flags/tr.png')
      else if (locale === 'de') return require('@assets/images/flags/de.png')
      else return require('@assets/images/flags/en.png')
    },
    getCurrentLocaleData () {
      const locale = this.$i18n.locale
      if (locale === 'en')      return { flag: 'us', lang: 'English'    }
      else if (locale === 'tr') return { flag: 'tr', lang: 'Turkish'     }
      else if (locale === 'de') return { flag: 'de', lang: 'German'     }
    }
  },
  methods: {
    updateLocale (locale) {
      axios.post('/lang/setLocale', {language:locale})
        .then((response) => {
          //console.log(response)
          this.$i18n.locale  = response.data
          this.$i18n.fallbackLocale  = response.data
        })
        .catch((error) => { console.log(error) })
    }
  }
}
</script>
