<template>
  <div class="vx-col w-full md:w-12/12 mb-base">
      <vx-card no-shadow v-for="(option,index)  in Faq" :key="index" class="mb-5 ml-2 mr-5 mt-5" >
            <div  class="vx-col  w-full md:w-12/12 mb-base">
              <vs-input :label="'Question'"  v-model="option.question" class="mt-5 w-full"  />
              <vs-input :label="'Answer'"  v-model="option.answer" class="mt-5 w-full"  />
<!--              <vs-input :label="'Brand Url (ex = https://google.com)'"  v-model="option.url" class="mt-5 w-full"  />-->
              <vs-button class="bg-danger mt-5"  @click="removeThis(index,'Faq')" >{{$t('RemoveThis')}}</vs-button>
            </div>
            <vs-divider></vs-divider>
          </vx-card>
          <vs-button class="mr-6 mt-5" @click="addOptions('Faq')" >{{$t('AddNew')}}</vs-button>
          <div class="flex flex-wrap items-center justify-end">
            <vs-button class="ml-auto mt-2" @click="SaveData('Faq')">{{$t('save')}}</vs-button>
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
      Faq:
      [
        {
          question: '',
          answer: '',
        }
      ],

    }
  },
  methods:{
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
      return this.$store.state.AppActiveUser
    }
  },
  created () {
    this.$store.dispatch('custom/fetchItems')
      .then((response) => {
        response.data.forEach(element => {
          if (element.type === 'References') {
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
