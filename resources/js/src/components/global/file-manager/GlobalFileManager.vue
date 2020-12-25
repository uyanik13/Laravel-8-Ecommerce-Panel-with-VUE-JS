<!-- =========================================================================================
SET THESE STATES IN TO THE YOUR COMPONENTS DATA ->
-- {
    showPopup: false,
    dataInner: "",
}

THEN SET CLICK EVENT ON YOUR MODEL INPUT -> @click="embedImage('twitter_image')"

LAST COPY THESE METHODS TO YOUR METHODS

embedMediaFromPopup(event) {
         this[this.dataInner] = event;
        },
 embedImage(data) {
           this.dataInner = data;
    return this.showPopup = !this.showPopup;
        }
========================================================================================== -->


<template>
<div class="align-content-center" >
<vs-popup background-color="rgba(152,152,152,.7)"
            fullscreen
            :background-color-popup="colorx"
            class="bg-primary-gradient"
            :title="$t('fileManager')" :active.sync="popupShow">

<vs-tabs :position="'top'" class="tabs-shadow-none" >

<!-- GENERAL -->
<vs-tab icon-pack="feather" icon="icon-upload" :label="$t('uploadFiles')">
    <div class="tab-general md:ml-4 md:mt-10 mt-4 ml-0" >
        <dro-upload multiple
            id="primaryImageUploadId"
            :text="$t('FileUpload')"
            :action="fileUploadApiEndpoint"
            fileName="files[]"
            @on-success="successUpload"
            @get-all-Images="getAllImages"
            />
    </div>
</vs-tab>


<vs-tab icon-pack="feather"  @click="fetchImages" icon="icon-file" :label="$t('mediaLibrary')" class="mt-5 text-lg">

 <div class="tab-general mx-48 mt-10 bg-gray-100">
 <file-manager-list  @embed-media-from-file-manager-list="embedMedia"/>
 </div>
</vs-tab>






</vs-tabs>





</vs-popup>
</div>
</template>

<script>
import SelectedMediaSidebar from './SelectedMediaSidebar.vue'
import i18n from '@/i18n/i18n'
import DroUpload from './DroUpload.vue'
import FileManagerList from './FileManagerList.vue'


export default {
    name: 'GlobalFileManager',
components: {
    DroUpload,
    FileManagerList,
    SelectedMediaSidebar,

},

props: {
     showPopup: {
      type: Boolean,
      required: true,
      default: false,
    },
},
  watch: {
            showPopup (val) {
                       if(val){
                            this.popupShow = true

                       }
                }

        },
data() {
    return {
        images:[],
        colorx:"#ffffff",
        sidebarOpened: false,
        popupShow: false,
        sidebarData: {},
        dataToOur:'',
        fileUploadApiEndpoint: '/api/gallery'
    }
},
computed: {
List () {
    return this.$store.state.gallery.galleryList
}
},
methods: {
      embedMedia(event){
        this.$emit('embed-media-from-popup',event)
        this.popupShow = false
    },
    successUpload (event) {
    //console.log(event)
    this.$vs.notify(
    {
        color:'success',
        title:i18n.t('Success'),
        text:i18n.t('uploadSuccessfull'),
        } )

},
getAllImages (event) {
    //console.log('event',event)
    this.images.push(event.src)

},
fetchImages (event) {
    return this.$store.dispatch('gallery/fetchItems')

},
copySlug () {
    this.$vs.notify({
    title: 'Başarılı',
    text: 'Link Kopyalandı',
    color: 'success',
    iconPack: 'feather',
    position: 'top-center',
    icon:'icon-check-circle'
    })
},
deleteData (id) {
    Swal.fire({
    type: 'warning',
    title: i18n.t('areYouSureToDeleteThis'),
    text: i18n.t('areYouSureToDeleteData'),
    showCancelButton: true,
    reverseButtons: true,
    confirmButtonText: i18n.t('ok'),
    cancelButtonText: i18n.t('cancel')
    }).then((result) => {
    if (result.value) {
        console.log(result)
        this.$store.dispatch('gallery/removeItem', id)
        .then((response) => {
            this.$vs.notify({
            title: 'Başarılı',
            text: 'içerik silindi',
            iconPack: 'feather',
            icon: 'icon-success',
            color: 'success'
            })

        })
        .catch(error => {
            this.$vs.notify({
            title: 'Hata',
            text: 'İçerik Silinemedi.',
            iconPack: 'feather',
            icon: 'icon-alert-circle',
            color: 'danger'
            })
        })
    }
    }).catch((error) => {
    console.log('ERROR:', error)
    })
}
},
created () {
this.$store.dispatch('gallery/fetchItems')
}



}
</script>


<style lang="scss" scoped>
    .add-new-data-sidebar {
        ::v-deep .vs-sidebar--background {
            z-index: 52010;
        }

        ::v-deep .vs-sidebar {
            z-index: 52010;
            width: 450px !important;
            top: -50px !important;
            max-width: 90vw ;

        }
    }

    .scroll-area--data-list-add-new {
        // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
        height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 82px);
    }


</style>
