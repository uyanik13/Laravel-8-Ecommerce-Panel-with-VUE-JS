<!-- =========================================================================================
  File Name: AddNewDataSidebar.vue
  Description: Add New Data - Sidebar component
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
========================================================================================== -->


<template>
  <vs-sidebar
    click-not-close
    position-right
    parent="body"
    default-index="1"
    color="primary"
    class="add-new-data-sidebar items-no-padding"
    spacer
    v-model="isSidebarActiveLocal"
  >
    <div class="mt-6 flex items-center justify-between px-6">
      <h4>
        {{
          Object.entries(this.data).length === 0
            ? $t("addProduct")
            : $t("updateProduct")
        }}
      </h4>
      <feather-icon
        icon="XIcon"
        @click.stop="isSidebarActiveLocal = false"
        class="cursor-pointer"
      ></feather-icon>
    </div>
    <vs-divider class="mb-0"></vs-divider>

    <VuePerfectScrollbar class="scroll-area--data-list-add-new" :key="$vs.rtl">
      <global-file-manager
        :showPopup="showPopup"
        @embed-media-from-popup="embedMediaFromPopup"
      />
      <div class="p-6">
        <div class="vx-row pl-5 pr-16">
          <vs-tabs>
            <vs-tab
              v-for="(locale, index) in locales"
              :key="index"
              :label="$t(locale)"
              icon-pack="material-icons"
              icon="flag"
            >
              <!--  TITLE -->
              <vs-divider background="primary" color="#ade6d4">{{
                $t("postName")
              }}</vs-divider>
              <div class="vx-row mb-10">
                <div class="vx-col sm:w-1/1 w-full">
                  <vs-input
                    :label="$t('postName') + '-' + locale.toUpperCase()"
                    v-model="title[locale]"
                    class="mt-5 w-full"
                    name="title"
                    v-validate="'required'"
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('title')"
                    >{{
                      errors.first("title") ? $t("titleRequired") : ""
                    }}</span
                  >
                </div>
              </div>

              <vs-divider background="primary" color="#ade6d4">{{
                $t("postContent")
              }}</vs-divider>
              <!--  CONTENT -->
              <div class="vx-row mb-10">
                <div class="vx-col w-full">
                  <froala
                    id="post"
                    :tag="'textarea'"
                    :config="config"
                    v-model="content[locale]"
                  ></froala>
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('content')"
                    >{{
                      errors.first("content") ? $t("descriptionRequired") : ""
                    }}</span
                  >
                </div>
              </div>

              <vs-divider background="primary" color="#ade6d4">{{
                $t("others")
              }}</vs-divider>
              <vs-tabs>
                <!-- PRICE -->
                <vs-tab
                  :label="$t('price')"
                  icon-pack="material-icons"
                  icon="attach_money"
                >
                  <vs-input
                    :label="$t('Price')"
                    v-model="price"
                    class="mt-1 w-full"
                  />
                </vs-tab>

                <!-- DISCOUNTED PRICE -->
                <vs-tab
                  :label="$t('discounted_price')"
                  icon-pack="material-icons"
                  icon="money_off"
                >
                  <vs-input
                    :label="$t('discounted_price')"
                    v-model="discounted_price"
                    class="mt-1 w-full"
                  />
                </vs-tab>

                <!-- QUANTITY -->
                <vs-tab
                  :label="$t('quantity')"
                  icon-pack="material-icons"
                  icon="pie_chart"
                >
                  <vs-input-number
                    :label="$t('Quantity')"
                    class="mt-10 w-full"
                    v-model="quantity"
                  />
                </vs-tab>

                <!-- TAGS -->
                <vs-tab
                  :label="$t('tags')"
                  icon-pack="material-icons"
                  icon="local_offer"
                >
                  <span>{{ $t("tags") + "-" + locale.toUpperCase() }}</span>
                  <v-select
                    taggable
                    push-tags
                    multiple
                    :closeOnSelect="false"
                    v-model="tags[locale]"
                    :dir="$vs.rtl ? 'rtl' : 'ltr'"
                  /><br />
                </vs-tab>

                <!-- OPTIONS -->
                <vs-tab
                  :label="$t('options')"
                  icon-pack="material-icons"
                  icon="done_outline"
                >
                  <div
                    class="vx-row my-10 bg-black-400"
                    v-for="(option, index) in options[locale].features"
                    :key="index"
                  >
                    <div class="vx-col sm:w-5/12">
                      <vs-input
                        :label="$t('Key')"
                        v-model="option.key"
                        class="mt-5 w-full"
                      />
                    </div>

                    <div class="vx-col sm:w-5/12">
                      <vs-input
                        :label="$t('Value')"
                        v-model="option.value"
                        class="mt-5 w-full"
                      />
                    </div>

                    <div class="vx-col sm:w-1/12 mt-12">
                      <feather-icon
                        @click="removeThis(index, locale, 'features')"
                        icon="XCircleIcon"
                        svgClasses="w-10 h-10 text-red"
                      ></feather-icon>
                    </div>
                    <div class="vx-col sm:w-1/12 mt-12">
                      <feather-icon
                        @click="addOptions(locale, 'features')"
                        icon="PlusCircleIcon"
                        svgClasses="w-10 h-10 text-red"
                      ></feather-icon>
                    </div>
                  </div>
                </vs-tab>

                <!-- CATEGORIES -->
                <vs-tab
                  :label="$t('categories')"
                  icon-pack="material-icons"
                  icon="category"
                >
                  <div class="vx-col mb-32">
                    <span>{{
                      $t("categories") + "-" + locale.toUpperCase()
                    }}</span>
                    <v-select
                      :label="$t('parentName')"
                      class="w-full mt-5 mb-32"
                      v-model="category_id"
                      :options="getChildCategories()"
                      @search="(query) => (search = query)"
                      :getOptionLabel="(option) => option.title[locale]"
                      :filterable="true"
                    />
                  </div>
                </vs-tab>

                <!-- STATUS -->
                <vs-tab
                  :label="$t('status')"
                  icon-pack="material-icons"
                  icon="pie_chart"
                >
                  <vs-select
                    v-model="status"
                    :label="$t('status') + '-' + locale.toUpperCase()"
                    name="status"
                    class="mt-5 w-full"
                  >
                    <vs-select-item
                      :key="status.value"
                      :value="status.value"
                      :text="status.text"
                      v-for="status in status_choices"
                    />
                    <span
                      class="text-danger text-sm"
                      v-show="errors.has('status')"
                      >{{
                        errors.first("status") ? $t("statusRequired") : ""
                      }}</span
                    >
                  </vs-select>
                </vs-tab>
              </vs-tabs>

              <vs-divider background="primary" color="#ade6d4">{{
                $t("seoSettings")
              }}</vs-divider>

              <vs-tabs>
                <!-- SEO TITLE -->
                <vs-tab
                  :label="$t('seoTitle')"
                  icon-pack="material-icons"
                  icon="toc"
                >
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
                      getPopularityColorTitle(Number(seo_title[locale].length))
                    "
                    class="shadow-md"
                  />
                </vs-tab>
                <!-- SEO DESCRIPTION -->
                <vs-tab
                  :label="$t('seoDescription')"
                  icon-pack="material-icons"
                  icon="description"
                >
                  <vs-input
                    :label="$t('seoDescription') + '-' + locale.toUpperCase()"
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

              <vs-divider background="primary" color="#ade6d4">{{
                $t("imageSettings")
              }}</vs-divider>

              <vs-tabs class="my-10">
                <vs-tab
                  :label="$t('thumbnailUpload')"
                  icon-pack="material-icons"
                  icon="add_a_photo"
                >
                  <div class="vx-row bg-grey">
                    <div class="vx-col sm:w-3/12 mt-5 mb-5">
                      <vx-card class="overlay-card overflow-hidden">
                        <template slot="no-body">
                          <vs-button
                            class="ml-5 my-5 center"
                            color="#F93E0B"
                            @click="embedImage('thumbnail', locale)"
                          >
                            <feather-icon
                              icon="CameraIcon"
                              svgClasses="w-25 h-25 text-white"
                            >
                            </feather-icon>
                            {{ $t("select_from_gallery") }}
                          </vs-button>
                          <vs-button
                            class="ml-5 my-5 center"
                            color="#0D122E"
                            @click="openFileInput('thumbnail' + locale)"
                          >
                            <feather-icon
                              icon="ImageIcon"
                              svgClasses="w-25 h-25 text-white"
                            >
                            </feather-icon>
                            {{ $t("selectImage") }}
                          </vs-button>
                          <input
                            type="file"
                            class="hidden"
                            :ref="'thumbnail' + locale"
                            @change="imageUpload($event, locale, 'thumbnail')"
                            accept="image/*"
                          />
                          <img
                            :src="thumbnail[locale]"
                            :alt="$t('thumbnailUpload')"
                            height="200px"
                            width="200px"
                            class="card-img-top m-5"
                          />
                        </template>
                      </vx-card>
                    </div>
                  </div>
                </vs-tab>
                <vs-tab
                  :label="$t('galleryUpload')"
                  icon-pack="material-icons"
                  icon="collections"
                >
                  <div class="vx-row bg-grey">
                    <div
                      class="vx-col sm:w-3/12 mt-5 mb-5"
                      v-for="(image, index) in images"
                      :key="index"
                    >
                      <vx-card class="overlay-card overflow-hidden">
                        <img
                          v-if="!image.slug"
                          src="https://via.placeholder.com/800.png"
                          height="200px"
                          width="200px"
                          class="card-img-top"
                        />
                        <img
                          v-else
                          :src="image.slug"
                          height="200px"
                          width="200px"
                          class="card-img-top"
                        />
                        <vs-input
                          :label="$t('altText')"
                          v-model="image.alt_text"
                          class="mt-5 w-full"
                        />
                        <input
                          type="file"
                          class="hidden"
                          :ref="'images' + index"
                          @change="galeryUpload($event, index, 'images')"
                          accept="image/*"
                        />

                        <vs-button
                          class="my-3 mx-3"
                          color="#0D122E"
                          @click="openFileInput('images' + index)"
                        >
                          <feather-icon
                            icon="ImageIcon"
                            svgClasses="w-25 h-25 text-red"
                          >
                          </feather-icon>
                        </vs-button>
                        <vs-button
                          class="my-3"
                          @click="removeGalleryImage(index, 'images')"
                        >
                          <feather-icon
                            icon="XCircleIcon"
                            svgClasses="w-25 h-25 text-red"
                          >
                          </feather-icon>
                        </vs-button>
                      </vx-card>
                    </div>

                    <div class="vx-col sm:w-3/12 mt-12">
                      <vs-button
                        class="my-3 sm:mb-0 mb-10 p-10"
                        color="#202124"
                        @click="addGalleryImage('images')"
                      >
                        <feather-icon
                          icon="PlusCircleIcon"
                          svgClasses="w-32 h-32 text-red"
                        ></feather-icon>
                      </vs-button>
                    </div>
                  </div>
                </vs-tab>
              </vs-tabs>
            </vs-tab>
          </vs-tabs>
        </div>
      </div>
    </VuePerfectScrollbar>

    <div class="flex flex-wrap items-center p-6" slot="footer">
      <vs-button class="mr-6" @click="submitData" :disabled="!isFormValid">{{
        $t("save")
      }}</vs-button>
      <vs-button
        type="border"
        color="danger"
        @click="isSidebarActiveLocal = false"
        >{{ $t("cancel") }}</vs-button
      >
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
    "v-select": vSelect,
  },
  data() {
    return {
      id: null,
      thumbnail: {
        en: "https://via.placeholder.com/800.png",
        tr: "https://via.placeholder.com/800.png",
        de: "https://via.placeholder.com/800.png",
      },
      title: {
        en: "EN TItle",
        tr: "",
        de: "",
      },
      content: {
        en: "",
        tr: "",
        de: "",
      },
      seo_title: {
        en: "",
        tr: "",
        de: "",
      },
      seo_description: {
        en: "",
        tr: "",
        de: "",
      },
      tags: {
        en: [],
        tr: [],
        de: [],
      },
      status_choices: [
        { text: i18n.t("active"), value: 1 },
        { text: i18n.t("deActive"), value: 0 },
      ],
      price: "",
      discounted_price: "",
      quantity: "",
      options: {
        en: { features: [{ key: "", value: "" }] },
        tr: { features: [{ key: "", value: "" }] },
        de: { features: [{ key: "", value: "" }] },
      },
      images: [
        {
          alt_text: "",
          slug: "",
        },
      ],
      status: "",
      search: "",
      category_id: "",
      type: "product",
      isMounted: false,
      showPopup: false,
      dataInner: {
        state: "",
        index: "",
      },
      config: {
        imageUploadParam: "imageFile",
        imageUploadURL: "/api/text-editor-upload",
        imageUploadMethod: "POST",
        imageMaxSize: 5 * 1024 * 1024,
        imageAllowedTypes: ["jpeg", "jpg", "png"],
      },
    };
  },
  props: {
    isSidebarActive: {
      type: Boolean,
      required: true,
    },
    data: {
      type: Object,
      default: () => {},
    },
  },
  watch: {
    isSidebarActive(val) {
      this.watchDataWhenSidebarActive(val);
    },
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
      },
    },
    isFormValid() {
      return !this.errors.any() && this.title && this.content;
    },
    locales() {
      return this.$store.state.locales;
    },
    filtered() {
      return this.getChildCategories().filter((category) =>
        category.includes(this.search)
      );
    },
  },
  methods: {
    galeryUpload(input, index, type) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
          return (this[type][index].slug = e.target.result);
        };
        reader.readAsDataURL(input.target.files[0]);
      }
    },
    openFileInput(type) {
      return this.$refs[type][0].click();
    },

    addOptions(locale, type) {
      this.options[locale][type].push({});
    },
    removeThis(index, locale, type) {
      this.options[locale][type].splice(index, 1);
    },

    addGalleryImage(type) {
      this[type].push({});
    },
    removeGalleryImage(index, type) {
      this[type].splice(index, 1);
    },

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
          price,
          discounted_price,
          options,
          quantity,
          thumbnail,
          tags,
          galleries,
          status,
          seo_description,
        } = JSON.parse(JSON.stringify(this.data.data));
        //console.log('active:',)
        this.id = id;
        this.title = title;
        this.content = content;
        this.seo_title = seo_title;
        this.seo_description = seo_description;
        this.tags = tags;
        this.price = price;
        this.discounted_price = discounted_price;
        this.quantity = quantity;
        this.images = galleries;
        this.status = status;
        this.thumbnail = thumbnail;
        this.category_id = this.currentCategory(category_id);
        this.options = options;
      }
      //console.log('active:',this.images)
    },
    initValues() {
      this.id = null;
      this.title = {
        en: "en - " + i18n.t("title"),
        tr: "tr - " + i18n.t("title"),
        de: "de - " + i18n.t("title"),
      };
      this.content = {
        en: "en - " + i18n.t("content"),
        tr: "tr - " + i18n.t("content"),
        de: "de - " + i18n.t("content"),
      };
      this.seo_title = {
        en: "en - " + i18n.t("seo_title"),
        tr: "tr - " + i18n.t("seo_title"),
        de: "de - " + i18n.t("seo_title"),
      };
      this.seo_description = {
        en: "en - " + i18n.t("seo_description"),
        tr: "tr - " + i18n.t("seo_description"),
        de: "de - " + i18n.t("seo_description"),
      };
      this.thumbnail = {
        en: "https://via.placeholder.com/800.png",
        tr: "https://via.placeholder.com/800.png",
        de: "https://via.placeholder.com/800.png",
      };
      this.tags = { en: [], tr: [], de: [] };
      this.price = 100;
      this.discounted_price = 90;
      this.quantity = 1;
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
      return this.$store.getters["category/getChildCategories"](1); //CATEGORY ID 1 = PRODUCTS
    },
    submitData() {
      this.$validator.validateAll().then((result) => {
        this.$vs.loading();
        if (result) {
          const obj = {
            id: this.id,
            title: this.title,
            category_id: this.category_id ? this.category_id.id : 1,
            content: this.content,
            tags: this.tags,
            price: this.price,
            discounted_price: this.discounted_price,
            quantity: this.quantity,
            seo_title: this.seo_title,
            seo_description: this.seo_description,
            options: this.options,
            images: this.images,
            thumbnail: this.thumbnail,
            status: this.status,
            type: this.type,
          };
          if (this.id !== null && this.id >= 0) {
            this.$store
              .dispatch("post/updateItem", obj)
              .then((response) => {
                this.$vs.loading.close();
                this.$vs.notify({
                  title: i18n.t("success"),
                  text: i18n.t("SuccessfullyUpdated"),
                  iconPack: "feather",
                  icon: "icon-success",
                  color: "success",
                });
              })
              .catch((error) => {
                console.log(error);
                this.$vs.loading.close();
                this.$vs.notify({
                  title: i18n.t("error"),
                  text: i18n.t("CouldntUpdated"),
                  iconPack: "feather",
                  icon: "icon-alert-circle",
                  color: "danger",
                });
              });
          } else {
            delete obj.id;
            this.$store
              .dispatch("post/addItem", obj)
              .then((response) => {
                this.$vs.loading.close();
                this.$vs.notify({
                  title: i18n.t("success"),
                  text: i18n.t("SuccessfullyAdded"),
                  iconPack: "feather",
                  icon: "icon-success",
                  color: "success",
                });
              })
              .catch((error) => {
                console.log(error);
                this.$vs.loading.close();
                this.$vs.notify({
                  title: i18n.t("error"),
                  text: i18n.t("CouldntAdd"),
                  iconPack: "feather",
                  icon: "icon-alert-circle",
                  color: "danger",
                });
              });
          }
        }
      });
    },
    imageUpload(input, locale, type) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
          return (this[type][locale] = e.target.result);
        };
        reader.readAsDataURL(input.target.files[0]);
      }
    },
    openFileInput(type) {
      return this.$refs[type][0].click();
    },
    filteringGallery(data) {
      return data.flatMap(({ alt_text, slug }) =>
        Object.assign({ alt_text, slug })
      );
    },
    getDataFrom(state, currentLang, dataLocale) {
      this[state][currentLang] = this[state][dataLocale];
    },
    embedMediaFromPopup(event) {
      this[this.dataInner.state][this.dataInner.index] = event;
      this.showPopup = !this.showPopup;
    },
    embedImage(state, index) {
      this.dataInner.state = state;
      this.dataInner.index = index;
      this.showPopup = !this.showPopup;
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
  },
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
</style>
