<template>
  <div class="vx-col w-full md:w-12/12 mb-base pr-20 pl-5">
   <global-file-manager :showPopup="showPopup" @embed-media-from-popup="embedMediaFromPopup" />

           <vx-card v-for="(option,index)  in Partners" :key="index" class="mb-5 ml-2 mr-5 mt-5" >
                  <template slot="actions">
                         <feather-icon @click="removeThis(index,'Partners')" icon="XCircleIcon" svgClasses="w-10 h-10 text-red"></feather-icon>
                    </template>

                    <div class="vx-row">

                        <div class="vx-col sm:w-1/2 lg:w-1/1 mb-2">
                             <vs-input :label="'Name'"  v-model="option.name" class="mt-5 w-full"  />
                         </div>

                        <div class="vx-col sm:w-1/2 lg:w-1/1 mb-2">
                            <div class="flex flex-wrap items-center mb-base ml-3 mt-2">
                            <img v-if="!option.image"  src="https://via.placeholder.com/150x60.png"  width="150px"  height="60px"  class="card-img-top" />
                            <img v-else :src="option.image"   width="150px"  height="60px"  class="card-img-top" />
                        <div>
                            <input type="file"  class="hidden" :ref="'Partners'+index" @change="sliderUpload($event,index,'Partners')" accept="image/*">
                            <vs-button
                                            class="ml-5 my-5 center"
                                            color="#F93E0B"
                                            @click="embedImage('Partners',index)">
                                            <feather-icon
                                            icon="CameraIcon" svgClasses="w-25 h-25 text-white">
                                            </feather-icon>
                                           {{$t('select_from_gallery')}}
                                    </vs-button>

                        </div>
                        </div>
                        </div>


                    </div>

                </vx-card>

                    <vs-button
                       class="ml-3 shadow-lg"
                       type="gradient" color="#10163A"
                       gradient-color-secondary="#E8603B"
                       @click="addOptions('Partners')">{{$t('AddNew')}}
                  </vs-button>


                <div class="flex flex-wrap items-center justify-end">
                    <vs-button class="ml-auto mt-2" @click="SaveData('Partners')">{{$t('save')}}</vs-button>
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
         showPopup: false,
          dataInner: {
                    state:'',
                    index:'',
                },
        Partners:
            [
                {
                name: '',
                image: '',
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
     embedMediaFromPopup(event) {
                  this[this.dataInner.state][this.dataInner.index].image = event;
                this.showPopup = !this.showPopup;
            },
            embedImage(state,index) {
                this.dataInner.state = state;
                this.dataInner.index = index;
                this.showPopup = !this.showPopup;
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
          if (element.type === 'Partners' || element.type === 'fourBox') {
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
