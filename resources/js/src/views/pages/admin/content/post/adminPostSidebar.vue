<template>
    <!--- SIDEBAR -->
    <vs-sidebar
        spacer
        color="primary"
        default-index="1"
        click-not-close
        position-right
        parent="body"
        class="add-new-data-sidebar items-no-padding"
        v-model="isSidebarActiveLocal"
    >
        <!--- TITLE -->
        <div class="mt-6 flex items-center justify-between px-6">
            <h4>{{ this.data.newData ? $t("addPost") : $t("updatePost") }}</h4>
            <feather-icon
                icon="XIcon"
                @click.stop="isSidebarActiveLocal = false"
                class="cursor-pointer"
            ></feather-icon>
        </div>
        <vs-divider class="mb-0"></vs-divider>
        <global-file-manager
                :showPopup="showPopup"
                @embed-media-from-popup="embedMediaFromPopup"
            />
        <!--- SCROLL BAR -->
        <vue-perfect-scrollbar
            class="scroll-area--data-list-add-new"
            :key="$vs.rtl"
        >
            <div class="p-10">
                <!--- TAB -->
                <vs-tabs>
                    <vs-tab
                        v-for="(locale, index) in locales"
                        :key="index"
                        :label="$t(locale)"
                        icon-pack="material-icons"
                        :ref="'tab-'+locale"
                        icon="flag">
                        <!-- TITLE -->
                        <vs-input
                            :label="$t('postName') + '-' + locale.toUpperCase()"
                            v-model="title[locale]"
                            class="mt-5 w-full"
                            name="title"
                            v-validate="'required'"/>
                        <span
                            class="text-danger text-sm"
                            v-show="errors.has('title')">{{ errors.first("title") ? $t("titleRequired") : ""}}</span>
                        <div class="vx-row ml-3 mt-2">
                            <vs-button
                                v-for="(lang, index) in locales"
                                :key="index"
                                class="mr-2"
                                color="danger"
                                type="gradient"
                                @click="getDataFrom('title', locale, lang)"
                                icon-pack="material-icons"
                                icon="flag">
                                {{ $t("get") + " " + $t("postName") + " " +$t("from") + " | " +$t(lang) + " | " }}
                            </vs-button>
                        </div>


                        <!-- CONTENT -->
                         <div class="vx-row my-10">
                            <div class="vx-col w-full ">
                                  <froala
                                    id="post"
                                    :tag="'textarea'"
                                    :config="config"
                                    v-model="content[locale]"
                                   ></froala>
                                <span class="text-danger text-sm" v-show="errors.has('content')">{{ errors.first('content') ?  $t('descriptionRequired') : ''}}</span>
                             </div>
                             <div class="vx-row ml-3 mt-2">
                                <vs-button
                                    v-for="(lang, index) in locales"
                                    :key="index"
                                    class="mr-2"
                                    color="danger"
                                    type="gradient"
                                    @click="getDataFrom('content', locale, lang)"
                                    icon-pack="material-icons"
                                    icon="flag" >
                                    {{ $t("get") + " " + $t("postContent") + " " +$t("from") + " | " +$t(lang) + " | " }}
                                </vs-button>
                            </div>
                         </div>



                        <!-- TAGS -->
                        <span>{{ $t("tags") + "-" + locale.toUpperCase() }}</span>
                        <v-select
                            taggable
                            push-tags
                            multiple
                            :closeOnSelect="false"
                            v-model="tags[locale]"
                            :dir="$vs.rtl ? 'rtl' : 'ltr'"/><br />

                        <!--  CATEGORY -->
                        <span>{{$t("categories") + "-" + locale.toUpperCase() }}</span>
                        <v-select
                            :label="$t('parentName')"
                            class="w-full mt-5"
                            v-model="category_id"
                            :options="getChildCategories()"
                            @search="query => (search = query)"
                            :getOptionLabel="option => option.title[locale]"
                            :filterable="true" />

                        <!--  STATUS -->
                        <vs-select
                            v-model="status"
                            :label="$t('status') + '-' + locale.toUpperCase()"
                            name="status"
                            class="mt-5 w-full">
                            <vs-select-item
                                :key="status.value"
                                :value="status.value"
                                :text="status.text"
                                v-for="status in status_choices" />
                            <span
                                class="text-danger text-sm"
                                v-show="errors.has('status')" >{{ errors.first("status") ? $t("statusRequired") : ""  }}</span >
                        </vs-select>

                        <!-- THUMBNAIL -->
                        <div class="vx-row ml-3 mt-5">
                            <div class="vx-col sm:w-3/12  mt-5">
                                 <vs-button
                                    class="my-auto block"
                                    color="primary"
                                    type="gradient"
                                    @click="embedImage('thumbnail',locale)">{{$t('select_from_gallery')}}</vs-button>
                              <vs-button
                                v-for="(lang, index) in locales"
                                :key="index"
                                color="danger"
                                type="gradient"
                                class="my-auto block mt-5"
                                @click="getDataFrom('thumbnail', locale, lang)"
                                icon-pack="material-icons"
                                icon="flag">
                                 {{ $t("get") + " " + $t("thumbnail") + " " +$t("from") + " | " +$t(lang) + " | " }}
                            </vs-button>
                             </div>
                            <div class="vx-col sm:w-9/12 ">
                                  <img
                                :src="thumbnail[locale]"
                                :alt="$t('thumbnailUpload')"
                                height="400px"
                                width="660px"
                                class="m-5"/>
                             </div>
                        </div>

                        <!-- SEO TITLE -->
                        <vs-input
                            :label="$t('seoTitle') + '-' + locale.toUpperCase()"
                            v-model="seo_title[locale]"
                            class="mt-5 w-full"
                            name="seo_title"
                            v-validate="'required'"
                        />
                        <span
                            class="text-danger text-sm"
                            v-show="errors.has('seo_title')"
                            >{{
                                errors.first("seo_title")
                                    ? $t("seoTitleRequiredMax71Char")
                                    : ""
                            }}</span
                        >
                        <vs-progress
                            :percent="Number(seo_title[locale].length)"
                            :color="
                                getPopularityColorTitle(
                                    Number(seo_title[locale].length)
                                )
                            "
                            class="shadow-md"
                        />

                        <!-- SEO DESCRIPTION -->
                        <vs-input
                            :label="
                                $t('seoDescription') +
                                    '-' +
                                    locale.toUpperCase()
                            "
                            v-model="seo_description[locale]"
                            class="mt-5 w-full"
                            name="seo_description"
                            v-validate="'required'"
                        />
                        <span
                            class="text-danger text-sm"
                            v-show="errors.has('seo_description')"
                            >{{
                                errors.first("seo_description")
                                    ? $t("seoDescRequiredMax161Char")
                                    : ""
                            }}</span
                        >
                        <vs-progress
                            :percent="Number(seo_description[locale].length)"
                            :color="
                                getPopularityColorDescription(
                                    Number(seo_description[locale].length)
                                )
                            "
                            class="shadow-md"
                        />
                    </vs-tab>
                </vs-tabs>
            </div>
        </vue-perfect-scrollbar>
         <!--- SAVE/CANCEL BUTTONS -->
                <div class="flex flex-wrap items-end p-6" slot="footer">
                    <vs-button
                        class="mr-6"
                        @click="submitData"
                        :disabled="!isFormValid"
                        >{{ $t("save") }}</vs-button
                    >
                    <vs-button
                        type="border"
                        color="danger"
                        @click="isSidebarActiveLocal = false"
                        >{{ $t("cancel") }}</vs-button
                    >
                    <!-- <vs-button
                                    v-for="(lang, index) in locales"
                                    :key="index"
                                    class="mr-2"
                                    type="gradient" color="#10163A"
                                    gradient-color-secondary="#E8603B"
                                    @click="changeTab('tab-'+lang,index)"
                                    icon-pack="material-icons"
                                    icon="flag" >
                                    {{ $t(lang)}}
                                </vs-button> -->
                </div>
    </vs-sidebar>
</template>

<script>
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";
import modulePostList from "@/store/post/modulePostList";
import { quillEditor } from "vue-quill-editor";
import vSelect from "vue-select";
import i18n from "@/i18n/i18n";

export default {
    components: {
        VuePerfectScrollbar,
        quillEditor,
        "v-select": vSelect
    },
    data() {
        return {
            id: null,
            thumbnail: {
                en: "https://via.placeholder.com/500.png",
                tr: "https://via.placeholder.com/500.png",
                de: "https://via.placeholder.com/500.png"
            },
            title: {
                en: "EN TItle",
                tr: "",
                de: ""
            },
            content: {
                en: "",
                tr: "",
                de: ""
            },
            seo_title: {
                en: "",
                tr: "",
                de: ""
            },
            seo_description: {
                en: "",
                tr: "",
                de: ""
            },
            tags: {
                en: [],
                tr: [],
                de: []
            },
            status_choices: [
                { text: i18n.t("active"), value: 1 },
                { text: i18n.t("deActive"), value: 0 }
            ],
            status: "",
            search: "",
            category_id: "",
            type: "post",
            isMounted: false,
            showPopup: false,
            dataInner: {
                state:'',
                index:'',
            },
            config: {
                imageUploadParam: "imageFile",
                imageUploadURL: "/api/text-editor-upload",
                imageUploadMethod: "POST",
                imageMaxSize: 5 * 1024 * 1024,
                imageAllowedTypes: ["jpeg", "jpg", "png"]
            }
        };
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
        isSidebarActive(val) {
            this.watchDataWhenSidebarActive(val);
        }
    },
    computed: {
        isSidebarActiveLocal: {
            get() {
                return this.isSidebarActive;
            },
            set(val) {
                if (!val) {
                    this.$emit("closeSidebar");
                    this.$validator.reset();
                    this.initValues();
                }
            }
        },
        isFormValid() {
            return !this.errors.any() && this.title && this.content;
        },
        locales() {
            return this.$store.state.locales;
        },
        filtered() {
            return this.getChildCategories().filter(category =>
                category.includes(this.search)
            );
        }
    },
    methods: {
        watchDataWhenSidebarActive(val) {
            if (!val) return;
            if (this.data.newData) {
                this.initValues();
                this.$validator.reset();
            } else {
                let {
                    id,
                    title,
                    content,
                    seo_title,
                    category_id,
                    thumbnail,
                    tags,
                    status,
                    seo_description
                } = JSON.parse(JSON.stringify(this.data.data));
                //console.log('active:',this.data)
                this.id = id;
                this.title = title;
                this.content = content;
                this.seo_title = seo_title;
                this.seo_description = seo_description;
                this.tags = tags;
                this.status = status;
                this.thumbnail = thumbnail;
                this.category_id = this.currentCategory(category_id);
            }
        },
        initValues() {
            this.id = null;
            this.title = {
                en: "en - " + i18n.t("title"),
                tr: "tr - " + i18n.t("title"),
                de: "de - " + i18n.t("title")
            };
            this.content = {
                en: "en - " + i18n.t("content"),
                tr: "tr - " + i18n.t("content"),
                de: "de - " + i18n.t("content")
            };
            this.seo_title = {
                en: "en - " + i18n.t("seo_title"),
                tr: "tr - " + i18n.t("seo_title"),
                de: "de - " + i18n.t("seo_title")
            };
            this.seo_description = {
                en: "en - " + i18n.t("seo_description"),
                tr: "tr - " + i18n.t("seo_description"),
                de: "de - " + i18n.t("seo_description")
            };
            this.thumbnail = {
                en: "https://via.placeholder.com/500.png",
                tr: "https://via.placeholder.com/500.png",
                de: "https://via.placeholder.com/500.png"
            };
            this.tags = { en: [], tr: [], de: [] };
            this.status = 1;
            this.category_id;
        },
        getPopularityColorTitle(num) {
            if (num > 71) return "dark";
            if (num >= 60 && num <= 71) return "success";
            if (num < 60) return "primary";
            return "primary";
        },
        getPopularityColorDescription(num) {
            if (num > 160) return "dark";
            if (num >= 145 && num <= 170) return "success";
            if (num < 145) return "primary";
            return "primary";
        },
        currentCategory(catID) {
            return this.$store.getters["category/currentCategory"](catID);
        },
        getChildCategories() {
            return this.$store.getters["category/getChildCategories"](2); //CATEGORY ID 2 = POSTS
        },
        submitData() {
            this.$validator.validateAll().then(result => {
                this.$vs.loading();
                if (result) {
                    const obj = {
                        id: this.id,
                        title: this.title,
                        category_id: this.category_id? this.category_id.id : 2,
                        content: this.content,
                        tags: this.tags,
                        seo_title: this.seo_title,
                        seo_description: this.seo_description,
                        options: "",
                        thumbnail: this.thumbnail,
                        status: this.status,
                        type: this.type
                    };
                    if (this.id !== null && this.id >= 0) {
                        this.$store
                            .dispatch("post/updateItem", obj)
                            .then(response => {
                                this.$vs.loading.close();
                                this.$vs.notify({
                                    title: i18n.t("success"),
                                    text: i18n.t("SuccessfullyUpdated"),
                                    iconPack: "feather",
                                    icon: "icon-success",
                                    color: "success"
                                });
                            })
                            .catch(error => {
                                console.log(error);
                                this.$vs.loading.close();
                                this.$vs.notify({
                                    title: i18n.t("error"),
                                    text: i18n.t("CouldntUpdated"),
                                    iconPack: "feather",
                                    icon: "icon-alert-circle",
                                    color: "danger"
                                });
                            });
                    } else {
                        delete obj.id;
                        this.$store
                            .dispatch("post/addItem", obj)
                            .then(response => {
                                this.$vs.loading.close();
                                this.$vs.notify({
                                    title: i18n.t("success"),
                                    text: i18n.t("SuccessfullyAdded"),
                                    iconPack: "feather",
                                    icon: "icon-success",
                                    color: "success"
                                });
                            })
                            .catch(error => {
                                console.log(error);
                                this.$vs.loading.close();
                                this.$vs.notify({
                                    title: i18n.t("error"),
                                    text: i18n.t("CouldntAdd"),
                                    iconPack: "feather",
                                    icon: "icon-alert-circle",
                                    color: "danger"
                                });
                            });
                    }
                }
            });
        },
        imageUpload(input, locale, type) {
            if (input.target.files && input.target.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    return (this[type][locale] = e.target.result);
                };
                reader.readAsDataURL(input.target.files[0]);
            }
        },
        openFileInput(type) {
            return this.$refs[type][0].click();
        },
        getDataFrom(state, currentLang, dataLocale) {
            this[state][currentLang] = this[state][dataLocale];
        },
        embedMediaFromPopup(event) {
            this[this.dataInner.state][this.dataInner.index] = event;
            this.showPopup = !this.showPopup;
        },
        embedImage(state,index) {
            this.dataInner.state = state;
            this.dataInner.index = index;
            this.showPopup = !this.showPopup;
        },
        changeTab(ref,index) {
            //let $ref = this.$refs[ref][0].$parent.$refs.li[index];
            let $ref = this.$refs[ref][0];
             console.log($ref)
             console.log($ref.active)
             $ref.active = true;
             console.log($ref.active)
            // console.log($ref)
            //return  $ref.click();

        },
    },

    created() {
        if (!modulePostList.isRegistered) {
            this.$store.registerModule("blogPosts", modulePostList);
            modulePostList.isRegistered = true;
        }
        this.$store.dispatch("blogPosts/fetchItems");
        this.$store.dispatch("category/fetchItems");
    },
    mounted() {
        this.isMounted = true;
    }
};
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
        max-width: 90vw;

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

.dropdown-button-container {
    display: flex;
    align-items: center;

    .btnx {
        border-radius: 5px 0px 0px 5px;
    }

    .btn-drop {
        border-radius: 0px 5px 5px 0px;
        border-left: 1px solid rgba(255, 255, 255, 0.2);
    }
}
</style>
