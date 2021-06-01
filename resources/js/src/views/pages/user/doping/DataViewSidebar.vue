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
                <vs-tab :label="$t('textArea')">
                  <div class="mt-3">
                    <!-- NAME -->
                    <vs-input
                      :label="$t('postName')"
                      v-model="dataName"
                      class="mt-5 w-full"
                      name="dataName"
                      v-validate="'required'"
                    />
                    <span
                      class="text-danger text-sm"
                      v-show="errors.has('dataName')"
                      >{{
                        errors.first("dataName") ? "Başlık Gerekli" : ""
                      }}</span
                    >

                    <div class="flex flex-wrap items-center mb-20 mt-20 h-full">
                      <span>{{ $t("postContent") }}</span>
                      <quill-editor
                        @change="onEditorChange($event)"
                        :options="editorOption"
                        :label="$t('postContent')"
                        name="dataDescription"
                        v-model="dataDescription"
                      ></quill-editor>
                      <span
                        class="text-danger text-sm"
                        v-show="errors.has('dataDescription')"
                        >{{
                          errors.first("dataDescription")
                            ? "İçerik Gerekli"
                            : ""
                        }}</span
                      >
                    </div>
                    <!--  CATEGORY -->
                    <vs-select
                      v-model="dataCategory"
                      :label="$t('category')"
                      name="dataCategory"
                      class="mt-5 w-full"
                    >
                      <vs-select-item
                        :key="category.id"
                        :value="category.id"
                        :text="category.title"
                        v-for="category in data.categories"
                      />
                      <span
                        class="text-danger text-sm"
                        v-show="errors.has('dataCategory')"
                        >{{
                          errors.first("dataCategory") ? "Kategori Gerekli" : ""
                        }}</span
                      >
                    </vs-select>

                    <!--  STATUS -->
                    <vs-select
                      v-model="dataStatus"
                      :label="$t('status')"
                      name="dataStatus"
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
                        v-show="errors.has('dataStatus')"
                        >{{
                          errors.first("dataStatus") ? "Durum Gerekli" : ""
                        }}</span
                      >
                    </vs-select>
                  </div>
                </vs-tab>
                <vs-tab :label="$t('ImageArea')">
                  <div class="vx-col w-full sm:w-10/12 lg:w-2/5 mb-base">
                    <vx-card>
                      <div slot="no-body">
                        <img
                          :src="image"
                          alt="Resim Yükle"
                          class="responsive card-img-top"
                        />
                      </div>
                      <div class="flex justify-between flex-wrap">
                        <input
                          type="file"
                          class="hidden"
                          ref="updateImgInput"
                          @change="update_avatar"
                          accept="image/*"
                        />
                        <vs-button
                          class="mr-4 sm:mb-0 mb-2"
                          @click="$refs.updateImgInput.click()"
                          >{{
                            $t("ImageUpload") ? "Resim Gerekli" : ""
                          }}</vs-button
                        >
                      </div>
                    </vx-card>
                  </div>
                </vs-tab>
                <vs-tab v-show="dataCategory === 5" :label="$t('VideoArea')">
                  <div class="vx-col w-full sm:w-10/12 lg:w-2/5 mb-base">
                    <vx-card>
                      <div class="flex justify-between flex-wrap">
                        <vs-input
                          :label="$t('YouCanAlsoInputUrl')"
                          v-model="video"
                          class="mt-5 w-full"
                          name="dataName"
                          v-validate="'required'"
                        />
                      </div>
                    </vx-card>
                  </div>
                </vs-tab>
                <vs-tab :label="$t('SeoArea')">
                  <div class="mt-3">
                    <!-- SEO TITLE -->
                    <vs-input
                      :label="$t('seoTitle')"
                      v-model="dataSeoTitle"
                      class="mt-5 w-full"
                      name="dataSeoTitle"
                      v-validate="'required'"
                    />
                    <span
                      class="text-danger text-sm"
                      v-show="errors.has('dataSeoTitle')"
                      >{{
                        errors.first("dataSeoTitle")
                          ? "Seo Başlığı Gerekli ve max 71 karakter"
                          : ""
                      }}</span
                    >
                    <vs-progress
                      :percent="Number(dataSeoTitle.length)"
                      :color="
                        getPopularityColorTitle(Number(dataSeoTitle.length))
                      "
                      class="shadow-md"
                    />

                    <!-- SEO DESCRIPTION -->
                    <vs-input
                      :label="$t('seoDescription')"
                      v-model="dataSeoDescription"
                      class="mt-5 w-full"
                      name="dataSeoDescription"
                      v-validate="'required'"
                    />
                    <span
                      class="text-danger text-sm"
                      v-show="errors.has('dataSeoDescription')"
                      >{{
                        errors.first("dataSeoDescription")
                          ? "Seo Açıklaması Gerekli ve max 160 karakter"
                          : ""
                      }}</span
                    >
                    <vs-progress
                      :percent="Number(dataSeoDescription.length)"
                      :color="
                        getPopularityColorDescription(
                          Number(dataSeoDescription.length)
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
      if (!this.data.data) {
        this.initValues();
        this.$validator.reset();
      } else {
        let {
          id,
          title,
          content,
          status,
          image,
          video,
          seo_title,
          seo_description,
        } = JSON.parse(JSON.stringify(this.data.data));
        //console.log('active:',JSON.parse(JSON.stringify(this.data.data)))
        this.dataId = id;
        this.dataName = title;
        this.dataDescription = content;
        this.dataSeoTitle = seo_title;
        this.dataSeoDescription = seo_description;
        this.dataStatus = status;
        this.image = image;
        this.video = video;
        this.dataCategory = data.categories;
        this.initValues();
      }
      // Object.entries(this.data).length === 0 ? this.initValues() : { this.dataId, this.dataName, this.dataCategory, this.dataOrder_status, this.dataUsage_amount } = JSON.parse(JSON.stringify(this.data))
    },
  },
  data() {
    return {
      type: "post",
      isMounted: false,
      image: null,
      video: null,
      dataId: null,
      dataName: "",
      dataDescription: "",
      dataSeoTitle: "",
      dataSeoDescription: "",
      dataStatus: "",
      dataCategory: "",
      title: "",
      status: "",
      category: "",
      categories: [],
      status_choices: [
        { text: "Aktif", value: 1 },
        { text: "DeAktif", value: 0 },
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
      return !this.errors.any() && this.dataName && this.dataDescription;
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
      this.dataId = null;
      this.dataName = "Yazı Başlığı";
      this.dataSeoTitle = "SEO Başlığı";
      this.dataSeoDescription = "SEO Açıklaması";
      this.dataDescription = "İçerik";
      this.image = "";
      this.video = "";
      this.dataStatus = 1;
      this.dataCategory = "";
    },
    submitData() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          const obj = {
            id: this.dataId,
            title: this.dataName,
            category: this.dataCategory,
            content: this.dataDescription,
            seo_title: this.dataSeoTitle,
            seo_description: this.dataSeoDescription,
            image: this.image,
            video: this.video,
            status: this.dataStatus,
            type: this.type,
          };
          if (this.dataId !== null && this.dataId >= 0) {
            this.$store
              .dispatch("post/updateItem", obj)
              .then((response) => {
                this.$vs.notify({
                  title: "Başarılı",
                  text:
                    response.data.post_title +
                    " || Adlı içerik Başarıyla Düzenlendi",
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
                  text: response.data.post_title + " || Adlı içerik Eklendi",
                  iconPack: "feather",
                  icon: "icon-success",
                  color: "success",
                });
              })
              .catch((error) => {
                this.$vs.notify({
                  title: "Hata",
                  text: "İçerik Eklenemedi." + error,
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
        var reader = new FileReader();
        reader.onload = (e) => {
          this.image = e.target.result;
          console.log("IMAGEURL", e.target.result);
        };
        reader.readAsDataURL(input.target.files[0]);
      }
    },
    update_video(input) {
      if (input.target.files && input.target.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.video = e.target.result;
          console.log("video", e.target.result);
        };
        reader.readAsDataURL(input.target.files[0]);
      }
    },
    onEditorChange(event) {
      //console.log('onEditorChange',event)
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
