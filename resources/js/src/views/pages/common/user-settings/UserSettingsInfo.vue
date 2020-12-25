<template>
  <vx-card no-shadow>
<span>{{$t('VideoAboutYou')}}</span><br>
  <div class="flex flex-wrap items-center mb-base">
      <video :src="video"  height="250px" width="250px" class="mr-4 mb-4" />
      <div>
        <input type="file" class="hidden" ref="updateImgInput" @change="update_video" accept="video/*">
        <vs-button class="mr-4 sm:mb-0 mb-2" @click="$refs.updateImgInput.click()">{{$t('UploadVideoAboutYou')}}</vs-button>
        <p v-show="video !== null">{{$t('saveYourVideo')}}</p>
      </div>
    </div>
    <!-- Bio -->
    <vs-textarea label="Bio" v-model="bio" placeholder="Your bio..." />
      <span>{{$t('Work Areas')}}</span>
      <v-select taggable push-tags multiple :closeOnSelect="false" v-model="tags"  :dir="$vs.rtl ? 'rtl' : 'ltr'" /><br>
    <!-- DOB -->
    <div class="mt-8">
      <label class="text-sm">Birth Date</label>
      <flat-pickr v-model="dob" :config="{ dateFormat: 'Y-m-d' }" class="w-full" />
    </div>

     <!-- <div class="mt-8">
      <label class="text-sm">Experience From</label>
      <flat-pickr v-model="experience" :config="{ dateFormat: 'Y-m-d' }" class="w-full" />
    </div> -->

    <!-- Country
    <label class="text-sm">{{$t('Country')}}</label>
    <v-select

                            class="w-full mt-5"
                            v-model="country"
                            @input="findCity(country.code)"
                            :options="countries"
                            @search="query => search = query"
                            :getOptionLabel="option => option.name"
                            :filterable="true"/>
    <label class="text-sm">{{$t('City')}}</label>
                            <v-select

                            class="w-full mt-5"
                            v-model="city"
                            :options="cities"
                            @search="query => search = query"
                            :getOptionLabel="option => option.name"
                            :filterable="true"/>


    <div class="mt-8">
      <label class="text-sm">Languages</label>
      <v-select v-model="lang_known" multiple :closeOnSelect="false" :options="langOptions" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
    </div>


    <vs-input class="w-full mt-8" :label-placeholder="$t('Profession')" v-model="profession" />
    <vs-input class="w-full mt-8" :label-placeholder="$t('current_salary')" v-model="current_salary" />
    <vs-input class="w-full mt-8" :label-placeholder="$t('expected_salary')" v-model="expected_salary" /> -->

    <!-- <vs-input class="w-full mt-8" label-placeholder="Website" v-model="website" />


    <div class="mt-8 mb-base">
      <label class="text-sm">Gender</label>
      <div class="mt-2">
        <vs-radio v-model="gender" vs-value="male" class="mr-4">Male</vs-radio>
        <vs-radio v-model="gender" vs-value="female" class="mr-4">Female</vs-radio>
        <vs-radio v-model="gender" vs-value="other">Other</vs-radio>
      </div>
    </div> -->

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
import i18n from '@/i18n/i18n'

export default {
  components: {
    flatPickr,
    vSelect
  },
  data () {
    return {
      bio: null,
      dob: null,
      country: '',
      city: '',
      profession: '',
      search: '',
      experience: '',
      lang_known: [],
      langOptions: [
        { label: 'English',  value: 'english'  },
        { label: 'Spanish',  value: 'spanish'  },
        { label: 'French',   value: 'french'   },
        { label: 'Russian',  value: 'russian'  },
        { label: 'German',   value: 'german'   },
        { label: 'Arabic',   value: 'arabic'   },
        { label: 'Turkish', value: 'turkish' }
      ],
      gender: '',
      website: '',
      current_salary: '',
      expected_salary: '',
      video: '',
        tags:[],

    }
  },
  props: {
    user: {
      type: [Object,Array],
      default: () => {}
    },
    // countryOptions: {
    //   type: Array,
    //   default: []
    // },
  },
  watch: {

  },
  computed: {
    validateForm () {
      return !this.errors.any()
    },
    countries () {
      return this.$store.state.post.countries
    },
    cities () {
      return this.$store.state.post.cities
    },
    filtered () {
      return this.countries.filter(country => country.includes(this.search))
    }
  },
  methods:{
    save_changes () {
      if (!this.validateForm) return
      const payload = {
        id: this.user.id,
        about_data :{
          bio: this.bio,
          dob: this.dob,
          profession: this.profession,
          country: this.country,
          city: this.city,
          lang_known: this.lang_known,
          website: this.website,
          experience: this.experience,
          current_salary: this.current_salary,
          expected_salary: this.expected_salary,
          gender: this.gender,
          tags: this.tags
        },
        video: this.video
      }
      console.log(payload)
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
      this.bio = this.user.about_data[0].bio
      this.dob = this.user.about_data[0].dob
      this.profession = this.user.about_data[0].profession
      this.country = this.user.about_data[0].country
      this.lang_known = this.user.about_data[0].lang_known
      this.experience = this.user.about_data[0].experience
      this.current_salary = this.user.about_data[0].current_salary
      this.expected_salary = this.user.about_data[0].expected_salary
      this.gender = this.user.about_data[0].gender
      this.website = this.user.about_data[0].website
      this.video = this.user.about_data[0].video
      this.city = this.user.about_data[0].city
      this.tags = this.user.about_data[0].tags
    },
    update_video (input) {

      if (input.target.files[0].size > 100388000) {
        this.showAlert(i18n.t('Error'), i18n.t('Max100MbUploadLimited'), 'icon-alert-circle', 'danger')
      } else if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()
        reader.onload = e => {
          this.video = e.target.result
          //console.log('IMAGEURL',e.target.result)
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
    showAlert (title, text, icon, color) {
      this.$vs.notify({
        title,
        text,
        iconPack: 'feather',
        icon,
        color
      })
    },
    findCity (code) {
      //console.log('code',code)
      if (code !== 'undefined' || code !== '') {
        this.$store.dispatch('post/fetchCities', code)
      }
      return false
    }

  },
  created () {
    this.$store.dispatch('post/fetchItems')
    this.$store.dispatch('post/fetchCountries')
    this.appendData()
  }

}
</script>
