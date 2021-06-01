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
            ? $t("addPost")
            : $t("updatePost")
        }}
      </h4>
      <feather-icon
        icon="XIcon"
        @click.stop="isSidebarActiveLocal = false"
        class="cursor-pointer"
      ></feather-icon>
    </div>
    <vs-divider class="mb-0"></vs-divider>

    <VuePerfectScrollbar
      class="scroll-area--data-list-add-new"
      :settings="settings"
      :key="$vs.rtl"
    >
      <div class="p-6">
        <div class="vx-row match-height">
          <div class="vx-col w-full md:w-11/12 mb-base">
            <vx-card>
              <vs-tabs>
                <vs-tab :label="$t('textArea')" class="mt-5">
                  <div class="mt-3">
                    <!-- NAME -->
                    <vs-input
                      :label="$t('postName')"
                      v-model="title"
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

                    <div class="flex flex-wrap items-center mb-20 mt-20 h-full">
                      <span>{{ $t("postContent") }}</span>
                      <quill-editor
                        :label="$t('postContent')"
                        name="dataDescription"
                        v-model="content"
                      ></quill-editor>
                      <span
                        class="text-danger text-sm"
                        v-show="errors.has('content')"
                        >{{
                          errors.first("content")
                            ? $t("descriptionRequired")
                            : ""
                        }}</span
                      >
                    </div>

                    <span>{{ $t("tags") }}</span>
                    <v-select
                      taggable
                      push-tags
                      multiple
                      :closeOnSelect="false"
                      v-model="tags"
                      :dir="$vs.rtl ? 'rtl' : 'ltr'"
                    /><br />

                    <!--  CATEGORY -->
                    <!-- <vs-select v-model="category_id" :label="$t('category')"  name="category_id" class="mt-5 w-full">
                                    <vs-select-item :key="category.id" :value="category.id" :text="category.title" v-for="category in data.categories" />
                                    <span class="text-danger text-sm" v-show="errors.has('category_id')">{{ errors.first('category_id') ? $t('categoryRequired') : '' }}</span>
                                    </vs-select> -->

                    <!--  STATUS -->
                    <vs-select
                      v-model="status"
                      :label="$t('status')"
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
                  </div>
                </vs-tab>
                <vs-tab :label="$t('thumbnailArea')" class="mt-5">
                  <div class="vx-col w-full sm:w-10/12 lg:w-2/5 mb-base">
                    <vx-card class="overlay-card overflow-hidden">
                      <template slot="no-body">
                        <img
                          v-if="!thumbnail"
                          src="@assets/images/place-holders/image-to-here.png"
                          height="380px"
                          width="380px"
                          class="responsive"
                        />
                        <img
                          v-else
                          :src="thumbnail"
                          height="380px"
                          width="380px"
                          class="responsive"
                        />
                      </template>
                    </vx-card>
                    <div class="flex justify-between flex-wrap">
                      <input
                        type="file"
                        class="hidden"
                        ref="updateImgInput"
                        @change="update_avatar"
                        accept="thumbnail/*"
                      />
                    </div>
                    <vs-button
                      class="mr-4 sm:mb-0 mb-2 mt-5"
                      @click="$refs.updateImgInput.click()"
                      >{{
                        $t("thumbnailUpload") ? $t("thumbnailRequired") : ""
                      }}</vs-button
                    >
                  </div>
                </vs-tab>

                <vs-tab :label="$t('SeoArea')">
                  <div class="mt-3">
                    <!-- SEO TITLE -->
                    <vs-input
                      :label="$t('seoTitle')"
                      v-model="seo_title"
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
                      :percent="Number(seo_title.length)"
                      :color="getPopularityColorTitle(Number(seo_title.length))"
                      class="shadow-md"
                    />

                    <!-- SEO DESCRIPTION -->
                    <vs-input
                      :label="$t('seoDescription')"
                      v-model="seo_description"
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
                      :percent="Number(seo_description.length)"
                      :color="
                        getPopularityColorDescription(
                          Number(seo_description.length)
                        )
                      "
                      class="shadow-md"
                    />
                  </div>
                </vs-tab>
              </vs-tabs>
            </vx-card>
          </div>
        </div>

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
import vSelect from "vue-select";
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
      if (!val) return;
      if (this.data.newData) {
        this.initValues();
        this.$validator.reset();
      } else {
        const {
          id,
          title,
          content,
          status,
          category,
          thumbnail,
          seo_title,
          seo_description,
        } = JSON.parse(JSON.stringify(this.data.data));
        // console.log('active:', JSON.parse(JSON.stringify(this.data.data)))
        this.id = id;
        this.title = title;
        this.content = content;
        this.seo_title = seo_title;
        this.seo_description = seo_description;
        this.status = status;
        this.thumbnail = thumbnail;
        this.category_id = Number(JSON.stringify(category.id));
        this.tags = JSON.parse(this.data.data.options).tags;
        //this.initValues()
      }
      // Object.entries(this.data).length === 0 ? this.initValues() : { this.id, this.title, this.category_id, this.dataOrder_status, this.dataUsage_amount } = JSON.parse(JSON.stringify(this.data))
    },
  },
  data() {
    return {
      type: "post",
      tags: [],
      isMounted: false,
      thumbnail: null,
      video: null,
      id: null,
      title: "",
      content: "",
      seo_title: "",
      seo_description: "",
      status: "",
      category_id: "",
      title: "",
      status: "",
      category: "",
      categories: [],
      status_choices: [
        { text: i18n.t("active"), value: 1 },
        { text: i18n.t("deActive"), value: 0 },
      ],
      settings: {
        // perfectscrollbar settings
        maxScrollbarLength: 60,
        wheelSpeed: 0.6,
      },
      editorOption: {
        // Some Quill options...
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
      categories() {
        return this.$store.state.post.categories;
      },
    },
    isFormValid() {
      return !this.errors.any() && this.title && this.content;
    },
  },
  created() {
    if (!modulePostList.isRegistered) {
      this.$store.registerModule("blogPosts", modulePostList);
      modulePostList.isRegistered = true;
    }
    this.$store.dispatch("blogPosts/fetchItems");
  },
  mounted() {
    this.isMounted = true;
  },
  methods: {
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
    initValues() {
      if (this.data.id) return;
      this.id = null;
      this.title = i18n.t("title");
      this.content = i18n.t("content");
      this.seo_title = i18n.t("seo_title");
      this.seo_description = i18n.t("seo_description");
      this.status = 1;
      this.category_id = 2;
    },
    submitData() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          const obj = {
            id: this.id,
            title: this.title,
            category_id: this.category_id,
            content: this.content,
            seo_title: this.seo_title,
            seo_description: this.seo_description,
            options: { tags: this.tags },
            thumbnail: this.thumbnail,
            status: this.status,
            type: this.type,
          };
          if (this.id !== null && this.id >= 0) {
            this.$store
              .dispatch("post/updateItem", obj)
              .then((response) => {
                this.$vs.notify({
                  title: "Başarılı",
                  text: `${response.data.title} || Adlı içerik Başarıyla Düzenlendi`,
                  iconPack: "feather",
                  icon: "icon-success",
                  color: "success",
                });
              })
              .catch((error) => {
                this.$vs.notify({
                  title: "Hata",
                  text: "İçerik Düzenlenemedi.",
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
                this.$vs.notify({
                  title: "Başarılı",
                  text: `${response.data.title} || Adlı içerik Eklendi`,
                  iconPack: "feather",
                  icon: "icon-success",
                  color: "success",
                });
              })
              .catch((error) => {
                this.$vs.notify({
                  title: "Hata",
                  text: `İçerik Eklenemedi.${error}`,
                  iconPack: "feather",
                  icon: "icon-alert-circle",
                  color: "danger",
                });
              });
          }
          this.$emit("closeSidebar");
          this.initValues();
        }
      });
    },
    update_avatar(input) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
          this.thumbnail = e.target.result;
          console.log("thumbnailURL", e.target.result);
        };
        reader.readAsDataURL(input.target.files[0]);
      }
    },
  },
  components: {
    VuePerfectScrollbar,
    quillEditor,
    "v-select": vSelect,
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
