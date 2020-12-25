<template>
   <div id="global-file-manager-list" class="mx-5">
        <div class="vx-row ">
          <selected-media-sidebar
                      v-show="sidebarOpened"
                      :isSidebarActive="sidebarOpened"
                      @closeSidebar="toggleDataSidebar"
                      @embed-media-from-sidebar="embedMedia"
                      :data="sidebarData" />
         </div>
        <div class="vx-row ">
               <template class="block">
                 <div class="con-input-search vs-table--search my-5 mr-5">
                <input v-model="search" class="input-search vs-table--search-input py-5 w-64" type="text" />
                <vs-icon icon="search"></vs-icon>
              </div>
            </template>
         </div>
        <div class="vx-row ">
                <template>
                    <div
                    class="vx-col sm:w-1/8 mb-5"
                    v-for="(file, index) in List.data"
                    :key="index">
                    <vx-card
                        :ref="'image-' + file.id"
                        :class="{
                            selected: selected && clickedRef === `image-${file.id}`
                        }"
                        @click="emitFile(file, `image-${file.id}`)">
                        <template slot="no-body">
                            <img
                                class="responsive  w-40 h-32"
                                :src="
                                    file.type === 'png' ||
                                    file.type === 'jpeg' ||
                                    file.type === 'jpg'
                                        ? file.slug
                                        : '/images/site_settings/file.png'" />
                        </template>
                    </vx-card>
            </div>
                </template>
        </div>
        <div class="vx-row ">
              <div class="flex flex-wrap items-center p-6" slot="footer" >
                    <vx-tooltip :title="$t('loadMore')" color="success" :text="$t('forLoadMoreMediaPleaseClickToButton')">
                        <vs-button class="mr-6" color="#32CD32" @click="loadMore">{{$t('loadMore')}}</vs-button>
                    </vx-tooltip>
                </div>

              <div class="flex flex-wrap items-center p-6" slot="footer">
                    <vx-tooltip :title="$t('info')" color="danger" :text="$t('thereIsNoMoreMedia')">
                        <vs-button class="mr-6"  color="#10163A" v-show="thereIsNoMedia" @click="showPage1">{{$t('showPage1')}}</vs-button>
                    </vx-tooltip>
                </div>
         </div>
   </div>
</template>

<script>
import Swal from "sweetalert2";
import i18n from "@/i18n/i18n";
import SelectedMediaSidebar from './SelectedMediaSidebar.vue'

export default {
    components: {
    SelectedMediaSidebar
    },
    data() {
        return {
            selected: false,
            sidebarOpened: false,
            thereIsNoMedia: false,
            sidebarData: {},
            clickedRef: "",
            search: ""
        };
    },
    computed: {
        isSmallerScreen() {
            return this.$store.state.windowWidth < 768;
        },
        List() {
            return this.$store.state.gallery.galleryList;
        }
    },
    watch : {
        search : function(key){
            if(key.length === 0) return this.searchMedia(key='show-all-media')
            if(key.length >= 3) return this.searchMedia(key)
        }
    },
    methods: {
        emitFile(file, ref) {
            this.selected = false;
            let $ref = this.$refs[ref][0].$refs.card;
            this.selected = true;
            this.clickedRef = ref;
            $ref.classList.add("selected");
            this.sidebarData = file
            this.toggleDataSidebar(true)
            return this.sidebarOpened = true;
        },
     embedMedia(event){
        this.$emit('embed-media-from-file-manager-list',event)
        this.popupShow = false
    },
    toggleDataSidebar (val = false) {
      this.sidebarOpened = val
    },
        searchMedia (key){
            return this.$store.dispatch("gallery/searchItems",key)
        },
        loadMore (){
            if(this.List.last_page <= this.List.current_page ) {
                 this.$vs.notify({
                   title: i18n.t('info'),
                    text: i18n.t('thereIsNoMoreMedia'),
                    color: 'danger',
                    iconPack: 'feather',
                    position: 'top-center',
                    icon:'icon-file'
            });
                this.thereIsNoMedia = true
                return false
            }
            return this.$store.dispatch('gallery/showPage',(this.List.current_page)+(1))

        },
        showPage1 (){
            this.thereIsNoMedia = false
            return this.$store.dispatch('gallery/showPage',1)
        },
        deleteData(id) {
            Swal.fire({
                type: "warning",
                title: i18n.t("areYouSureToDeleteThis"),
                text: i18n.t("areYouSureToDeleteData"),
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonText: i18n.t("ok"),
                cancelButtonText: i18n.t("cancel")
            })
                .then(result => {
                    if (result.value) {
                        console.log(result);
                        this.$store
                            .dispatch("gallery/removeItem", id)
                            .then(response => {
                                this.$vs.notify({
                                    title: "Başarılı",
                                    text: "içerik silindi",
                                    iconPack: "feather",
                                    icon: "icon-success",
                                    color: "success"
                                });
                            })
                            .catch(error => {
                                this.$vs.notify({
                                    title: "Hata",
                                    text: "İçerik Silinemedi.",
                                    iconPack: "feather",
                                    icon: "icon-alert-circle",
                                    color: "danger"
                                });
                            });
                    }
                })
                .catch(error => {
                    console.log("ERROR:", error);
                });
        }
    },
    created() {
        this.$store.dispatch("gallery/fetchItems");
    }
};
</script>

<style lang="scss" scoped>
.selected {
    border: 2px solid #5c9dd9;
    margin: 0;
}
</style>
