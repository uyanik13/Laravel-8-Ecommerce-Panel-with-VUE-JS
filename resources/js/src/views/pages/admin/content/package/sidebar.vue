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
    <global-file-manager
      :showPopup="showPopup"
      @embed-media-from-popup="embedMediaFromPopup"
    />
    <VuePerfectScrollbar class="scroll-area--data-list-add-new" :key="$vs.rtl">
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
                $t("packageTitle")
              }}</vs-divider>
              <div class="vx-row mb-10">
                <div class="vx-col sm:w-1/1 w-full">
                  <vs-input
                    :label="$t('packageTitle') + '-' + locale.toUpperCase()"
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
                $t("packageSecondTitle")
              }}</vs-divider>
              <!--  CONTENT -->
              <div class="vx-row mb-10">
                <div class="vx-col sm:w-1/1 w-full">
                  <vs-input
                    :label="
                      $t('packageSecondTitle') + '-' + locale.toUpperCase()
                    "
                    v-model="second_title[locale]"
                    class="mt-5 w-full"
                    name="title"
                    v-validate="'required'"
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('second_title')"
                    >{{
                      errors.first("second_title")
                        ? $t("second_title_required")
                        : ""
                    }}</span
                  >
                </div>
              </div>

              <vs-divider background="primary" color="#ade6d4">{{
                $t("price")
              }}</vs-divider>
              <vs-tabs>
                <vs-tab :label="$t('MonthlyPrice')">
                  <vs-input
                    :label="$t('MonthlyPrice')"
                    v-model="monthly_price"
                    class="mt-5 w-full"
                    name="monthly_price"
                    v-validate="'required'"
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('monthly_price')"
                    >{{
                      errors.first("monthly_price")
                        ? $t("MonthlyPriceRequired")
                        : ""
                    }}</span
                  >
                </vs-tab>
                <vs-tab :label="$t('YearlyPrice')">
                  <vs-input
                    :label="$t('YearlyPrice')"
                    v-model="yearly_price"
                    class="mt-5 w-full"
                    name="yearly_price"
                    v-validate="'required'"
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('yearly_price')"
                    >{{
                      errors.first("yearly_price")
                        ? $t("YearlyPriceRequired")
                        : ""
                    }}</span
                  >
                </vs-tab>
              </vs-tabs>

              <vs-divider background="primary" color="#ade6d4">{{
                $t("others")
              }}</vs-divider>
              <vs-tabs>
                <!-- THUMBNAIL -->
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
                <!-- OPTIONS -->
                <vs-tab
                  :label="$t('options')"
                  icon-pack="material-icons"
                  icon="done_outline"
                >
                  <div
                    class="vx-row my-4 bg-black-400"
                    v-for="(option, index) in description[locale]"
                    :key="index"
                  >
                    <div class="vx-col sm:w-5/12">
                      <vs-input
                        :label="$t('Value')"
                        v-model="option.value"
                        class="mb-1 w-full"
                      />
                    </div>
                    <div class="vx-col sm:w-1/12 mt-12">
                      <feather-icon
                        @click="removeThis(index, locale)"
                        icon="XCircleIcon"
                        svgClasses="w-10 h-10 text-red"
                      ></feather-icon>
                    </div>
                    <div class="vx-col sm:w-1/12 mt-12">
                      <feather-icon
                        @click="addOptions(locale)"
                        icon="PlusCircleIcon"
                        svgClasses="w-10 h-10 text-red"
                      ></feather-icon>
                    </div>
                  </div>
                </vs-tab>
              </vs-tabs>
            </vs-tab>
          </vs-tabs>
        </div>

        <vs-divider class="mb-0"></vs-divider>
        <div class="flex flex-wrap items-center p-6" slot="footer">
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
        </div>
      </div>
    </VuePerfectScrollbar>
  </vs-sidebar>
</template>

<script>
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";
import modulePostList from "@/store/post/modulePostList";
import { quillEditor } from "vue-quill-editor";
import i18n from "@/i18n/i18n";

export default {
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
  data() {
    return {
      id: null,
      thumbnail: {
        en: "https://via.placeholder.com/800.png",
        tr: "https://via.placeholder.com/800.png",
        de: "https://via.placeholder.com/800.png",
      },
      title: {
        en: "En Title",
        tr: "",
        de: "",
      },
      second_title: {
        en: "",
        tr: "",
        de: "",
      },
      monthly_price: "",
      yearly_price: "",
      description: {
        en: [{ value: "" }],
        tr: [{ value: "" }],
        de: [{ value: "" }],
      },
      type: "",
      types: [
        { text: i18n.t("Package"), value: "package" },
        { text: i18n.t("Service"), value: "service" },
        { text: i18n.t("Profile"), value: "profile" },
        { text: i18n.t("Token"), value: "token" },
      ],
      popular: true,
      isMounted: false,
      showPopup: false,
      dataInner: {
        state: "",
        index: "",
      },
    };
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
      return !this.errors.any() && this.title && this.second_title;
    },
    locales() {
      return this.$store.state.locales;
    },
  },
  methods: {
    watchDataWhenSidebarActive(val) {
      if (!val) return;
      if (this.data.newData) {
        this.initValues();
        this.$validator.reset();
      } else {
        //console.log(this.data.data)
        let {
          id,
          title,
          second_title,
          description,
          thumbnail,
          monthly_price,
          yearly_price,
          type,
          popular,
        } = JSON.parse(JSON.stringify(this.data.data));
        //console.log('active:',)
        this.id = id;
        this.title = title;
        this.second_title = second_title;
        this.thumbnail = thumbnail;
        this.monthly_price = monthly_price;
        this.yearly_price = yearly_price;
        this.type = type;
        this.popular = popular;
        this.description = description;
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
      this.second_title = {
        en: "en - " + i18n.t("second_title"),
        tr: "tr - " + i18n.t("second_title"),
        de: "de - " + i18n.t("second_title"),
      };
      this.monthly_price = 60;
      this.yearly_price = 600;
      this.type = "news";
      this.popular = 0;
    },
    submitData() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          const obj = {
            id: this.id,
            title: this.title,
            thumbnail: this.thumbnail,
            second_title: this.second_title,
            description: this.description,
            monthly_price: this.monthly_price,
            yearly_price: this.yearly_price,
            type: this.type,
            popular: this.popular,
          };
          if (this.id !== null && this.id >= 0) {
            this.$store
              .dispatch("package/updateItem", obj)
              .then((response) => {
                this.showAlert(
                  i18n.t("Success"),
                  i18n.t("SuccessfullyUpdated"),
                  "icon-success",
                  "success"
                );
              })
              .catch((error) => {
                this.showAlert(
                  i18n.t("Error"),
                  i18n.t("CouldntUpdated"),
                  "icon-alert-circle",
                  "danger"
                );
              });
          } else {
            delete obj.id;
            this.$store
              .dispatch("package/addItem", obj)
              .then((response) => {
                this.showAlert(
                  i18n.t("Success"),
                  i18n.t("SuccessfullyAdded"),
                  "icon-success",
                  "success"
                );
              })
              .catch((error) => {
                this.showAlert(
                  i18n.t("Error"),
                  i18n.t("CouldntAdd"),
                  "icon-alert-circle",
                  "danger"
                );
              });
          }
        }
      });
    },
    showAlert(title, text, icon, color) {
      this.$vs.notify({
        title,
        text,
        iconPack: "feather",
        icon,
        color,
      });
    },
    addOptions(locale) {
      this.description[locale].push({});
    },
    removeThis(index, locale) {
      this.description[locale].splice(index, 1);
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
  components: {
    VuePerfectScrollbar,
    quillEditor,
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
