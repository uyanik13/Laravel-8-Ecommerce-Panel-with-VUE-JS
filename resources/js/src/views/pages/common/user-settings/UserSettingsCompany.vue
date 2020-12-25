<template>
  <vx-card no-shadow>
 <div class="md:ml-4 md:mt-5 mt-4 ml-0">
<vs-tabs position="left" >
                <vs-tab :label="$t('LogoVideoCv')">
                  <div class="mt-3">
                <div class="flex flex-wrap items-center mb-base">
                    <vs-avatar :src="logo" v-if="logo === null" size="70px" class="mr-4 mb-4" />
                    <vs-avatar :src="logo" v-else size="70px" class="mr-4 mb-4" />
                    <div>
                        <input type="file" class="hidden" ref="updateImgInput" @change="update_avatar" accept="image/*">
                        <vs-button class="mr-4 sm:mb-0 mb-2" @click="$refs.updateImgInput.click()">{{$t('UploadLogo')}}</vs-button>
                        <p v-show="logo !== null"> {{$t('SaveYourLogo')}}</p>
                    </div>
                    </div>

                    <!-- <div class="flex flex-wrap items-center mb-base">
                    <video :src="video"  height="250px" width="250px" class="mr-4 mb-4" />
                    <div>
                        <input type="file" class="hidden" ref="updateImgInput" @change="update_video" accept="video/*">
                        <vs-button class="mr-4 sm:mb-0 mb-2" @click="$refs.updateImgInput.click()">{{$t('UploadVideoAboutYou')}}</vs-button>
                        <p v-show="video !== null">{{$t('saveYourVideo')}}</p>
                    </div>
                    </div> -->


                <div class="mt-8 mb-base">
                        <vs-upload   id="CvUpload"
                                    accept=".doc,.docx,.pdf"
                                    :text="$t('UploadCompanyCV')"
                                    automatic :action="fileUploadApiEndpoint"
                                    fileName="file"
                                    @on-success="successUpload" />
                    <span>{{$t('Max_file_size_is_5MB_Suitable_files_are_doc_docx_rft_pdf')}}</span>
                    </div>
                    <vs-divider></vs-divider>
                  </div>
                </vs-tab>
                <vs-tab :label="$t('aboutData')">
                  <div cleass="vx-col w-full sm:w-10/12 lg:w-5/5 mb-base">
                   <vs-input class="w-full mb-base" name="name" :label="$t('CompanyName')" :placeholder="$t('CompanyName')" v-model="name"></vs-input>
    <vs-input class="w-full mb-base" name="profession" :label="$t('profession')" :placeholder="$t('profession')" v-model="profession"></vs-input>

    <!-- Bio -->
    <vs-textarea :label="$t('AboutYourCompany')" v-model="bio" :placeholder="$t('AboutYourCompany')" />

    <!-- <div class="mt-8 mb-base">
      <label class="text-sm">{{$t('CompanyType')}}</label>
      <div class="mt-2">
        <vs-radio v-model="type" vs-value="law" class="mr-4">{{$t('Law')}}</vs-radio>
        <vs-radio v-model="type" vs-value="other">{{$t('Other')}}</vs-radio>
      </div>
    </div> -->


    <vs-input class="w-full mb-base"
              v-validate="'required|min:10|max:13'"
              :label="$t('PhoneNumber')"
              :placeholder="$t('PhoneNumber')"
              name="phone"
              v-model="phone"></vs-input>
    <span class="text-danger text-sm"
          v-show="errors.has('phone')">
      {{ errors.first('phone') ? $t('Valid Phone Number Required') : '' }}</span>

    <vs-input class="w-full mb-base"
              v-validate="'email'"
               name="email"
              :label="$t('Email')"
              :placeholder="$t('Email')"
              v-model="email"></vs-input>
    <span class="text-danger text-sm"
          v-show="errors.has('email')">
      {{ errors.first('email') ? $t('Valid Email Required') : '' }}</span>


    <vs-input class="w-full mb-base"
              :label="$t('Address')"
              :placeholder="$t('Address')"
              v-model="address"></vs-input>

    <!-- Website  -->
    <vs-input class="w-full mt-8"
              :label="$t('Website')"
              :label-placeholder="$t('Website')"
              v-model="website" />

                   </div>
                </vs-tab>

                 <vs-tab :label="$t('socialArea')">
                 <vs-input class="w-full mb-base" v-model="twitter" icon-pack="feather" icon="icon-twitter" :label="$t('Twitter')" icon-no-border />
                <vs-input class="w-full mb-base" v-model="facebook" icon-pack="feather" icon="icon-facebook" :label="$t('Facebook')"  icon-no-border />
                <vs-input class="w-full mb-base" v-model="instagram" icon-pack="feather" icon="icon-instagram" :label="$t('Instagram')"  icon-no-border />
                <vs-input class="w-full mb-base" v-model="github" icon-pack="feather" icon="icon-github" :label="$t('Github')"  icon-no-border />
                <vs-input class="w-full mb-base" v-model="linkedin" icon-pack="feather" icon="icon-linkedin" :label="$t('Linkedin')"  icon-no-border />
                <vs-input class="w-full mb-base" v-model="slack" icon-pack="feather" icon="icon-slack" :label="$t('Slack')"  icon-no-border />
                <vs-input class="w-full mb-base" v-model="youtube" icon-pack="feather" icon="icon-youtube" :label="$t('Youtube')"  icon-no-border />
                </vs-tab>

                 <vs-tab :label="$t('LegalArea')">
                 <div class="mt-3">
                     <vx-card no-shadow v-for="(option,index)  in contracts" :key="index">
                    <vs-input :label="$t('ContractName')"  v-model="option.contractName" class="mt-5 w-full"  />
                    <vs-input :label="$t('ContractUrl')" :label-placeholder="$t('CopyWithFileManager')" v-model="option.ContractUrl" class="mt-5 w-full"  />
                    <vs-button class="bg-danger" @click="removeContractData(index)" >{{$t('RemoveThis')}}</vs-button>
                     </vx-card>
                <vs-button class="demo-text-dark" @click="AddContractData" >{{$t('AddNew')}}</vs-button>
                 </div>
                </vs-tab>



                <vs-tab :label="$t('SeoArea')">
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
                </vs-tab>

              </vs-tabs>

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
import i18n from '@/i18n/i18n'

export default {
  components: {
    flatPickr,
    vSelect
  },
  created () {
     //this.$store.dispatch('post/fetchCountries')
    this.appendData()
  },
  data () {
    return {
      site_url:process.env.MIX_APP_URL,
      fileUploadApiEndpoint: '/api/UploadCompanyCV',
      bio: null,
      name: null,
      country: null,
      lang_known: [],
      //type: '',
      email: '',
      profession: '',
      address: '',
      phone: '',
      website: '',
      logo: '',
      video: '',
      seo_title: '',
      seo_description: '',
      twitter: null,
      facebook: null,
      instagram: null,
      github: null,
      linkedin: null,
      youtube: null,
      slack: null,
       contracts: [
        {
          contractName: '',
          ContractUrl: ''
        }
      ]

    }
  },
  props: {
    user: {
      type: Object,
      default: () => {}
    }
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
       AddContractData () {
      this.contracts.push({
        contractName: '',
        ContractUrl: ''
      })
    },
    removeContractData (index) {
      this.contracts.splice(index, 1)
    },
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
        bio: this.bio,
        name: this.name,
        email: this.email,
        phone: this.phone,
        profession: this.profession,
        address: this.address,
        website: this.website,
        logo: this.logo,
        social_data :{
          twitter: this.twitter,
          facebook: this.facebook,
          instagram: this.instagram,
          github: this.github,
          linkedin: this.linkedin,
          youtube: this.youtube,
          slack: this.slack,
          video: this.video,
          contracts: this.contracts
        },
        //type: this.type,
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
    if (this.user.company.social_data.contracts) {

        this.contracts.push(this.user.company.social_data.contracts)
        this.contracts.splice(0, 1)
        this.contracts = this.contracts[0]
      }
      this.bio = this.user.company.bio
      this.name = this.user.company.name
      this.email = this.user.company.email
      this.phone = this.user.company.phone
      this.address = this.user.company.address
      this.profession = this.user.company.profession
      this.website = this.user.company.website
      this.logo = this.user.company.logo
      this.twitter = this.user.company.social_data.twitter
      this.facebook = this.user.company.social_data.facebook
      this.instagram = this.user.company.social_data.instagram
      this.github = this.user.company.social_data.github
      this.linkedin = this.user.company.social_data.linkedin
      this.youtube = this.user.company.social_data.youtube
      this.slack = this.user.company.social_data.slack
      this.video = this.user.company.social_data.video
      //this.type = this.user.company.type
      this.seo_title = this.user.company.seo_title
      this.seo_description = this.user.company.seo_description


    },
    update_avatar (input) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()
        reader.onload = e => {
          this.logo = e.target.result
          //console.log('IMAGEURL',e.target.result)
        }
        reader.readAsDataURL(input.target.files[0])
      }
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

    successUpload (event) {
      this.$vs.notify({color: 'success', title: 'Upload Success', text: 'Lorem ipsum dolor sit amet, consectetur'})
    },

  }

}
</script>
