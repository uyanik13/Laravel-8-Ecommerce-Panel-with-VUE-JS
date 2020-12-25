<template>
  <div class="vx-col w-full md:w-1/1 mb-base">

              <vs-select  v-model="language"  :label="$t('Languages')"  name="dataStatus" class="mt-5 w-full">
                <vs-select-item :key="lang.value" :value="lang.value" :text="lang.text" v-for="lang in languages" />
              </vs-select>
                <vs-divider/>

                <vs-button class="ml-auto mt-5 mt-5" @click="SaveData(language,selectedLanguage)">{{$t('save')}}</vs-button>
                <vx-card no-shadow v-for="(option,index)  in selectedLanguage" :key="index">
                    <vs-input :label="index"  v-model="selectedLanguage[index]" class="mt-5 w-full"  />
                </vx-card>
                <vs-button class="ml-auto mt-5 mt-5" @click="SaveData(language,selectedLanguage)">{{$t('save')}}</vs-button>
  </div>

</template>

<script>
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import vSelect from 'vue-select'
import axios from 'axios';
import i18n from '@/i18n/i18n'

export default {
  components: {
    flatPickr,
    vSelect
  },

  data() {
    return {
    language: '',
    selectedLanguage : [],
    languages: [
        {text:i18n.t('English'), value:'en'},
        {text:i18n.t('Deutsch'), value:'de'},
        {text:i18n.t('Turkish'), value:'tr'},
      ],
    }
  },
  watch: {
      language : function (value) {
            this.langFetcher(value)
      }
  },
  methods:{
    SaveData(lang,data) {
      const obj = {

        }
         axios.post("/api/lang/front-side-write", {language: lang, file:'lang',data:data}).then((response) => {
        this.$vs.notify({
          title: 'Başarılı',
          text:' İçerik Başarıyla Eklendi',
          iconPack: 'feather',
          icon: 'icon-success',
          color: 'success'
        })

      }).catch(error => {
        this.$vs.notify({
          title: 'Hata',
          text: 'İçerik Eklenemedi.',
          iconPack: 'feather',
          icon: 'icon-alert-circle',
          color: 'danger'
        })
      })
    },
    langFetcher (language) {
                  this.$vs.loading()
        return new Promise((resolve, reject) => {
          axios.post("/api/lang/front-side-read", {language, file:'lang'})
        .then((response) => {
            console.log(response.data)
           this.selectedLanguage = response.data
          this.$vs.loading.close()
        })
        .catch((error) => { reject(error) })
    })
    },
  },
  computed: {
    activeUserInfo() {
      return this.$store.state.AppActiveUser
    },
  },
  created(){


  }
}
</script>
