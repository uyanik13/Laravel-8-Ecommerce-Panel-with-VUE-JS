<template>
  <div class="vx-col w-full md:w-12/12 mb-base">
    <vx-card no-shadow v-for="(option,index)  in VideoGallery" :key="index">
      <div  class="vx-col  w-full md:w-12/12 mb-base">
        <vs-input :label="'Video URL'"  v-model="option.url" class="mt-5 w-full"  />
        <vs-input :label="'Video Başlığı'"  v-model="option.title" class="mt-5 w-full"  />
        <vs-button class="bg-danger" @click="removeVideoGallery(index)" >{{$t('RemoveThis')}}</vs-button>
      </div>
      <vs-divider></vs-divider>
    </vx-card>
    <vs-button class="mr-6" @click="AddVideoGallery" >{{$t('AddNew')}}</vs-button>
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2" @click="SaveVideoGallery">{{$t('save')}}</vs-button>
    </div>
  </div>

</template>

<script>
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import vSelect from 'vue-select'
import axios from 'axios';

export default {
  components: {
    flatPickr,
    vSelect
  },

  data() {
    return {
      VideoGallery: [
        {
          url: '' ,
          title: '',
        }
      ],
    }
  },
  methods:{
    AddVideoGallery() {
      this.VideoGallery.push({
        url: '' ,
        title: '',
      });
    },
    removeVideoGallery(index) {
      this.VideoGallery.splice(index,1);
    },

    SaveVideoGallery() {

      const obj = {
        VideoGallery: this.VideoGallery,
        type: 'VideoGallery',
        }
         this.$store.dispatch("custom/addItem", obj).then((response) => {
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
    }
  },
  computed: {
    activeUserInfo() {
      return this.$store.state.AppActiveUser
    },
  },
  created(){
    this.$store.dispatch("custom/fetchItems")
      .then((response) => {
        response.data.forEach(element =>{
         element.type === 'VideoGallery' ? this.VideoGallery.push(JSON.parse(element.JsonData).VideoGallery) : '';
        });
        this.VideoGallery.splice(0,1)
        this.VideoGallery = this.VideoGallery[0]
      })
      .catch((error) => { console.log(error)})

  }
}
</script>
