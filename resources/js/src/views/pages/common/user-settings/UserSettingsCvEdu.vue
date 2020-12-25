<template>
  <vx-card no-shadow>

    <div class="mt-8 mb-base">
        <vs-upload   id="CvUpload"
                     accept=".doc,.docx,.pdf"
                     :text="$t('UploadCV')"
                     automatic :action="fileUploadApiEndpoint"
                     fileName="file"
                     @on-success="successUpload" />
      <span>{{$t('Max_file_size_is_5MB_Suitable_files_are_doc_docx_rft_pdf')}}</span>
    </div>
    <vs-divider></vs-divider>

    <vx-card no-shadow v-for="(option,index)  in EduData" :key="index">
        <vs-input :label="$t('SchoolName')"  v-model="option.school" class="mt-5 w-full"  />
        <vs-input :label="$t('SchoolDegree')"  v-model="option.degree" class="mt-5 w-full"  />
        <vs-input :label="$t('SchoolStudy')"  v-model="option.study" class="mt-5 w-full"  />
        <vs-input :label="$t('SchoolStartYear')"  v-model="option.start_year" class="mt-5 w-full"  />
        <vs-input :label="$t('SchoolGraduateYear')"  v-model="option.end_year" class="mt-5 w-full"  />
        <vs-button class="bg-danger" @click="removeEduData(index)" >{{$t('RemoveThis')}}</vs-button>
    </vx-card>
    <vs-button class="demo-text-dark" @click="AddEduData" >{{$t('AddNew')}}</vs-button>
    <vs-divider></vs-divider>


    <vx-card no-shadow v-for="(option,index)  in WorkData" :key="index">
        <vs-input :label="$t('WorkTitle')"  v-model="option.title" class="mt-5 w-full"  />
        <vs-input :label="$t('Company')"  v-model="option.company" class="mt-5 w-full"  />
        <vs-input :label="$t('Excerpt')"  v-model="option.excerpt" class="mt-5 w-full"  />
        <vs-input :label="$t('StartYear')"  v-model="option.start_year" class="mt-5 w-full"  />
        <vs-input :label="$t('EndYear')"  v-model="option.end_year" class="mt-5 w-full"  />
        <vs-button class="bg-danger" @click="removeWorkData(index)" >{{$t('RemoveThis')}}</vs-button>
    </vx-card>
    <vs-button class="demo-text-dark" @click="AddWorkData" >{{$t('AddWorkExperience')}}</vs-button>
    <vs-divider></vs-divider>


     <vs-divider></vs-divider>
    <vx-card no-shadow v-for="(option,index)  in contracts" :key="index">
        <vs-input :label="$t('ContractName')"  v-model="option.contractName" class="mt-5 w-full"  />
        <vs-input :label="$t('ContractUrl')" :label-placeholder="$t('CopyWithFileManager')" v-model="option.ContractUrl" class="mt-5 w-full"  />
        <vs-button class="bg-danger" @click="removeContractData(index)" >{{$t('RemoveThis')}}</vs-button>
    </vx-card>
    <vs-button class="demo-text-dark" @click="AddContractData" >{{$t('AddNew')}}</vs-button>
    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2"  @click="SaveEdu">{{$t('Save')}}</vs-button>
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
  data () {
    return {
       site_url:process.env.MIX_APP_URL,
      fileUploadApiEndpoint: '/api/uploadCv',
      EduData: [
        {
          school: '',
          degree: '',
          study: '',
          start_year: '',
          end_year: ''
        }
      ],
      WorkData: [
        {
          title: '',
          company: '',
          excerpt: '',
          start_year: '',
          end_year: ''
        }
      ],
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
      default: () => {
      }
    }
  },
  watch: {},
  computed: {
    validateForm () {
      return !this.errors.any()
    }
  },
  methods: {
    AddEduData () {
      this.EduData.push({
        school: '',
        degree: '',
        study: '',
        start_year: '',
        end_year: ''
      })
    },
    AddWorkData () {
      this.WorkData.push({
        title: '',
        company: '',
        excerpt: '',
        start_year: '',
        end_year: ''
      })
    },
    removeEduData (index) {
      this.EduData.splice(index, 1)
    },
    removeWorkData (index) {
      this.WorkData.splice(index, 1)
    },
     AddContractData () {
      this.contracts.push({
        contractName: '',
        ContractUrl: ''
      })
    },
    removeContractData (index) {
      this.contracts.splice(index, 1)
    },
    SaveEdu () {
      const obj = {
        id: this.user.id,
        user_data: {
          EduData: this.EduData,
          WorkData: this.WorkData,
          contracts: this.contracts
        }

      }
      this.$store.dispatch('user/updateUser', obj).then((response) => {
        this.$vs.notify({
          title: 'Başarılı',
          text: ' İçerik Başarıyla Eklendi',
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
    successUpload (event) {
      this.$vs.notify({color: 'success', title: 'Upload Success', text: 'Lorem ipsum dolor sit amet, consectetur'})
    },
    appendData () {

      if (this.user.user_data.EduData !== 'undefined') {
        this.EduData.push(this.user.user_data.EduData)
        this.EduData.splice(0, 1)
        this.EduData = this.EduData[0]
      }
      if (this.user.user_data.WorkData !== 'undefined') {
        this.WorkData.push(this.user.user_data.WorkData)
        this.WorkData.splice(0, 1)
        this.WorkData = this.WorkData[0]
      }


    }
  },
  created () {
    this.appendData()
  }
}
</script>
