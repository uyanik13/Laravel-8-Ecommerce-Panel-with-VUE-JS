<template>
  <div class="vx-col w-full md:w-12/12 mb-base">


           <vx-card v-for="(option,index)  in AboutUSMembers" :key="index" class="mb-5 ml-2 mr-5 mt-5" >
                    <div class="vx-row">

                        <div class="vx-col sm:w-1/2 lg:w-1/1 mb-2">
                             <vs-input :label="'Name'"  v-model="option.name" class="mt-5 w-full"  />
                         </div>

                        <div class="vx-col sm:w-1/2 lg:w-1/1 mb-2">
                           <vs-input :label="'Position'"  v-model="option.position" class="mt-5 w-full"  />
                        </div>

                        <div class="vx-col sm:w-1/2 lg:w-1/1 mb-2">
                            <vs-input :label="'facebook'"  v-model="option.facebook" class="mt-5 w-full"  />
                        </div>
                        <div class="vx-col sm:w-1/2 lg:w-1/1 mb-2">
                            <vs-input :label="'twitter'"  v-model="option.twitter" class="mt-5 w-full"  />
                        </div>
                        <div class="vx-col sm:w-1/2 lg:w-1/1 mb-2">
                            <vs-input :label="'linkedin'"  v-model="option.linkedin" class="mt-5 w-full"  />
                        </div>

                        <div class="vx-col sm:w-1/2 lg:w-1/1 mb-2">
                            <div class="flex flex-wrap items-center mb-base ml-3 mt-2">
                          <img v-if="!option.image"  src="https://via.placeholder.com/150.png"  height="150px"  width="150px" class="card-img-top" />
                          <img v-else :src="option.image"   height="150px"  width="150px" class="card-img-top" />
                        <div>
                            <input type="file"  class="hidden" :ref="'AboutUSMembers'+index" @change="sliderUpload($event,index,'AboutUSMembers')" accept="image/*">
                            <vs-button class="ml-3 sm:mb-0 mb-2" @click="openFileInput('AboutUSMembers'+index)">{{$t('AboutUSMembers')}}</vs-button>
                        </div>
                        </div>
                        </div>


                    </div>
                    <vs-button class="bg-danger mt-3" @click="removeThis(index,'AboutUSMembers')" >{{$t('removeThisSection')}}</vs-button>
                </vx-card>

                <vs-button class="mr-6" @click="addOptions('AboutUSMembers')" >{{$t('AddNew')}}</vs-button>
                <div class="flex flex-wrap items-center justify-end">
                    <vs-button class="ml-auto mt-2" @click="SaveData('AboutUSMembers')">{{$t('save')}}</vs-button>
                </div>



  </div>

</template>

<script>
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import vSelect from 'vue-select'
export default {
  components: {
    flatPickr,
    vSelect
  },
  data () {
    return {

        AboutUSMembers:
            [
                {
                name: '',
                position: '',
                image: '',
                facebook: '',
                twitter: '',
                linkedin: ''
                }
            ],
    }
  },
  methods:{
      sliderUpload (input,index,type) {
        //console.log(input.target.files[0])
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()
        reader.onload = e => {
         return this[type][index].image = e.target.result
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
    openFileInput (type) {
      return this.$refs[type][0].click()
    },
    addOptions (type) {
      this[type].push({})
    },
    removeThis (index, type) {
      this[type].splice(index, 1)
    },
    SaveData (dataType) {
      const obj = {
        [dataType]: this[dataType],
        type: dataType
      }
      console.log(obj)
      this.$store.dispatch('custom/addItem', obj).then((response) => {
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
  },
  computed: {
    activeUserInfo () {
      return this.$store.state.auth.user
    }
  },
  created () {
    this.$store.dispatch('custom/fetchItems')
      .then((response) => {
        response.data.forEach(element => {
          if (element.type === 'AboutUSMembers' || element.type === 'fourBox') {
            this[element.type].push(JSON.parse(element.JsonData)[element.type])
            this[element.type].splice(0, 1)
            this[element.type] = this[element.type][0]
          } else {
            this[element.type] = JSON.parse(element.JsonData)[element.type]
          }
        })
      })
      .catch((error) => { console.log(error) })
  }
}
</script>
