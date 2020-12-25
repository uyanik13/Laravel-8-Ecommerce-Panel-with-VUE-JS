<template>
  <vx-card no-shadow>
    <vs-divider></vs-divider>
    <vx-card no-shadow v-for="(option,index)  in contracts" :key="index">
        <vs-input :label="$t('ContractName')"  v-model="option.contractName" class="mt-5 w-full"  />
        <vs-input :label="$t('ContractUrl')" :label-placeholder="$t('CopyWithFileManager')" v-model="option.ContractUrl" class="mt-5 w-full"  />
        <vs-button class="bg-danger" @click="removeContractData(index)" >{{$t('RemoveThis')}}</vs-button>
    </vx-card>
    <vs-button class="demo-text-dark" @click="AddContractData" >{{$t('AddNew')}}</vs-button>


    <vs-divider></vs-divider>
    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2"  @click="Save">{{$t('Save')}}</vs-button>
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

    AddContractData () {
      this.contracts.push({
        contractName: '',
        ContractUrl: ''
      })
    },
    removeContractData (index) {
      this.contracts.splice(index, 1)
    },

    Save () {
      const obj = {
        id: this.user.id,
        user_data: {
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
