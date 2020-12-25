
<template>

    <!--- SIDEBAR -->
    <vs-sidebar
             spacer
             color="primary"
             default-index="1"
             click-not-close position-right parent="body"
             class="add-new-data-sidebar items-no-padding"
             v-model="isSidebarActiveLocal">

    <!--- TITLE -->
        <div class="mt-6 flex items-center justify-between px-6">
            <h4>{{ this.data.newData ? $t('addPost'): $t('updatePost') }}</h4>
            <feather-icon icon="XIcon" @click.stop="isSidebarActiveLocal = false" class="cursor-pointer"></feather-icon>
        </div>
        <vs-divider class="mb-0"></vs-divider>

    <!--- SCROLL BAR -->
        <vue-perfect-scrollbar class="scroll-area--data-list-add-new"  :key="$vs.rtl">
         <div class="p-10">

    <!--- TAB -->
            <vs-tabs>
                <vs-tab
                v-for="(locale,index) in locales" :key="index"
                :label="$t(locale)"
                    icon-pack="material-icons"
                    icon="flag">

                        <!-- TITLE -->
                    <vs-input :label="$t('postName') + '-' + locale.toUpperCase()" v-model="title[locale]" class="mt-5 w-full" name="title" v-validate="'required'" />
                    <span class="text-danger text-sm" v-show="errors.has('title')">{{ errors.first('title') ? $t('titleRequired')  : ''}}</span>

                    <!-- CONTENT -->
                    <div class="flex flex-wrap items-center mb-20 mt-20 h-full">
                        <span>{{$t('postContent') + '-' + locale.toUpperCase()}}</span>
                        <quill-editor :label="$t('postContent')" name="content" v-model="content[locale]"></quill-editor>
                        <span class="text-danger text-sm" v-show="errors.has('content')">{{ errors.first('content') ?  $t('descriptionRequired') : ''}}</span>
                    </div>



                    <!--  STATUS -->
                    <vs-select v-model="status" :label="$t('status') + '-' + locale.toUpperCase()"  name="status" class="mt-5 w-full">
                    <vs-select-item :key="status.value" :value="status.value" :text="status.text" v-for="status in status_choices" />
                    <span class="text-danger text-sm" v-show="errors.has('status')">{{ errors.first('status') ?  $t('statusRequired') : '' }}</span>
                    </vs-select>




                    <!-- SEO TITLE -->
                    <vs-input :label="$t('seoTitle') + '-' + locale.toUpperCase()" v-model="seo_title[locale]" class="mt-5 w-full" name="seo_title" v-validate="'required'" />
                    <span class="text-danger text-sm" v-show="errors.has('seo_title')">{{ errors.first('seo_title') ? $t('seoTitleRequiredMax71Char') : '' }}</span>
                    <vs-progress :percent="Number(seo_title[locale].length)" :color="getPopularityColorTitle(Number(seo_title[locale].length))" class="shadow-md" />

                    <!-- SEO DESCRIPTION -->
                    <vs-input :label="$t('seoDescription') + '-' + locale.toUpperCase()" v-model="seo_description[locale]" class="mt-5 w-full" name="seo_description" v-validate="'required'" />
                    <span class="text-danger text-sm" v-show="errors.has('seo_description')">{{ errors.first('seo_description') ? $t('seoDescRequiredMax161Char') : '' }}</span>
                    <vs-progress :percent="Number(seo_description[locale].length)" :color="getPopularityColorDescription(Number(seo_description[locale].length))" class="shadow-md" />



                </vs-tab>
            </vs-tabs>

    <!--- SAVE/CANCEL BUTTONS -->
                <div class="flex flex-wrap items-center p-6" slot="footer">
                    <vs-button class="mr-6" @click="submitData" :disabled="!isFormValid">{{$t('save')}}</vs-button>
                    <vs-button type="border" color="danger" @click="isSidebarActiveLocal = false">{{$t('cancel')}}</vs-button>
                </div>


         </div>
        </vue-perfect-scrollbar>


    </vs-sidebar>
</template>

<script>
    import VuePerfectScrollbar from 'vue-perfect-scrollbar'
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'
    import modulePostList from '@/store/post/modulePostList'
    import { quillEditor } from 'vue-quill-editor'
    import vSelect from 'vue-select'
    import i18n from '@/i18n/i18n'

    export default {
        components: {
            VuePerfectScrollbar,
            quillEditor,
            'v-select': vSelect,
        },
        data () {
            return {
                id: null,

                title:
                     {
                        'en':'EN TItle',
                        'tr':'',
                        'de':'',
                    },
                content:
                     {
                        'en':'',
                        'tr':'',
                        'de':'',
                    },
                seo_title:
                     {
                        'en':'',
                        'tr':'',
                        'de':'',
                    },
                seo_description:
                     {
                        'en':'',
                        'tr':'',
                        'de':'',
                    },
                status_choices:
                    [
                        {text:i18n.t('active'), value:1},
                        {text:i18n.t('deActive'), value:0}
                    ],
                status: '',
                type: 'page',
                isMounted: false,
            }
        },
        props: {
            isSidebarActive: {
                type: Boolean,
                required: true
            },
            data: {
                type: Object,
                default: () => {}
            }
        },
        watch: {
            isSidebarActive (val) {
                this.watchDataWhenSidebarActive(val)
            }
        },
        computed: {
            isSidebarActiveLocal: {
                get () {
                    return this.isSidebarActive
                },
                set (val) {
                    if (!val) {
                        this.$emit('closeSidebar')
                        this.$validator.reset()
                        this.initValues()
                    }
                },
            },
            isFormValid () {
                return !this.errors.any() && this.title && this.content
            },
             locales () {
                    return  this.$store.state.locales
                },
        },
        methods: {
            watchDataWhenSidebarActive (val){
            if(!val) return
                if(this.data.newData) {
                    this.initValues()
                    this.$validator.reset()
                }else {
             let {  id, title,content,seo_title,status,seo_description} = JSON.parse(JSON.stringify(this.data.data))
                    //console.log('active:',this.data)
                    this.id = id
                    this.title = title
                    this.content = content
                    this.seo_title = seo_title
                    this.seo_description = seo_description
                    this.status = status
                }
            },
            initValues () {
                this.id = null
                this.title = {'en': 'en - '+i18n.t('title'),'tr': 'tr - '+i18n.t('title'),'de': 'de - '+i18n.t('title')}
                this.content = {'en': 'en - '+i18n.t('content'),'tr': 'tr - '+i18n.t('content'),'de': 'de - '+i18n.t('content')}
                this.seo_title = {'en': 'en - '+i18n.t('seo_title'),'tr': 'tr - '+i18n.t('seo_title'),'de': 'de - '+i18n.t('seo_title')}
                this.seo_description = {'en': 'en - '+i18n.t('seo_description'),'tr': 'tr - '+i18n.t('seo_description'),'de': 'de - '+i18n.t('seo_description')}
                this.status = 1
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
            submitData () {
                this.$validator.validateAll().then(result => {
                    this.$vs.loading()
                    if (result) {
                        const obj = {
                            id: this.id,
                            title: this.title,
                            content:this.content,
                            seo_title:this.seo_title,
                            seo_description:this.seo_description,
                            status: this.status,
                            type: this.type
                        }
                        if (this.id !== null && this.id >= 0) {
                            this.$store.dispatch('post/updateItem', obj).then((response) => {
                            this.$vs.loading.close()
                            this.$vs.notify({
                                title: i18n.t('success'),
                                text: i18n.t('SuccessfullyUpdated'),
                                iconPack: 'feather',
                                icon: 'icon-success',
                                color: 'success'
                            })

                            }).catch(error => {
                            console.log(error)
                            this.$vs.loading.close()
                            this.$vs.notify({
                                title: i18n.t('error'),
                                text: i18n.t('CouldntUpdated'),
                                iconPack: 'feather',
                                icon: 'icon-alert-circle',
                                color: 'danger'
                            })
                            })
                        } else {
                            delete obj.id
                            this.$store.dispatch('post/addItem', obj).then((response) => {
                            this.$vs.loading.close()
                            this.$vs.notify({
                                title: i18n.t('success'),
                                text: i18n.t('SuccessfullyAdded'),
                                iconPack: 'feather',
                                icon: 'icon-success',
                                color: 'success'
                            })
                            })
                            .catch(error => {
                                console.log(error)
                                this.$vs.loading.close()
                                this.$vs.notify({
                                title: i18n.t('error'),
                                text: i18n.t('CouldntAdd'),
                                iconPack: 'feather',
                                icon: 'icon-alert-circle',
                                color: 'danger'
                                })
                            })
                        }
                        this.$emit('closeSidebar')
                        this.initValues()
                    }
                })
            },

        },

          created () {
            if (!modulePostList.isRegistered) {
                this.$store.registerModule('blogPosts', modulePostList)
                modulePostList.isRegistered = true
            }
            this.$store.dispatch('blogPosts/fetchItems')
            this.$store.dispatch("category/fetchItems")
        },
        mounted () {
            this.isMounted = true
        },
    }
</script>

<style lang="scss" scoped>
    .add-new-data-sidebar {
        ::v-deep .vs-sidebar--background {
            z-index: 52010;
        }

        .vs-sidebar {
            max-width: 1240px !important;
        }
        ::v-deep .vs-sidebar {
            z-index: 52010;
            width: 1240px !important;
            max-width: 90vw ;

            .img-upload {
                margin-top: 2rem;

                .con-img-upload {
                    padding: 0;
                }

                .con-input-upload {
                    width: 100%;
                    margin: 0;
                }
            }
        }
    }

    .scroll-area--data-list-add-new {
        // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
        height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 82px);
    }


</style>
