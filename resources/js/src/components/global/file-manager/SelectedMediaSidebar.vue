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
    default-index="1"
    color="primary"
    parent="#global-file-manager-list"
    class="add-new-data-sidebar items-no-padding"
    spacer
    v-model="isSidebarActiveLocal"
  >
    <div class="mt-6 flex items-center justify-between px-6">
      <h4>{{ $t("image_details") }}</h4>
      <feather-icon
        icon="XIcon"
        @click.stop="isSidebarActiveLocal = false"
        class="cursor-pointer"
      ></feather-icon>
    </div>
    <vs-divider class="mb-0"></vs-divider>
    <vue-perfect-scrollbar
      class="scroll-area--data-list-add-new"
      :key="$vs.rtl"
    >
      <div class="p-6">
        <div class="vx-row">
          <vx-card class="overlay-card overflow-hidden">
            <template slot="no-body">
              <img
                :src="slug"
                :alt="slug"
                width="430px"
                height="300px"
                class="m-5"
              />
            </template>

            <vs-input
              :label="$t('URL')"
              v-clipboard:copy="slug"
              v-clipboard:success="copySlug"
              v-model="slug"
              class="mt-5 w-full"
              disabled
            />
            <vs-input
              :label="$t('file_name')"
              v-model="file_name"
              class="mt-2 w-full"
              disabled
            />
            <vs-input
              :label="$t('alt_text')"
              v-model="alt_text"
              class="mt-2 w-full"
            />
          </vx-card>
        </div>

        <div class="flex flex-wrap items-center p-6" slot="footer">
          <vs-button class="mt-3 mr-2" @click="save">{{
            $t("save")
          }}</vs-button>
          <vs-button class="mt-3 mr-2" @click="embed" color="#0D122E">{{
            $t("embed")
          }}</vs-button>
          <vs-button
            class="mt-3 mr-2"
            color="danger"
            type="gradient"
            @click="deleteImage"
            >{{ $t("delete") }}</vs-button
          >
          <vs-button
            class="mt-3"
            type="border"
            color="danger"
            @click="isSidebarActiveLocal = false"
            >{{ $t("cancel") }}</vs-button
          >
        </div>
      </div>
    </vue-perfect-scrollbar>
  </vs-sidebar>
</template>

<script>
import i18n from "@/i18n/i18n";
import VuePerfectScrollbar from "vue-perfect-scrollbar";
export default {
  components: {
    VuePerfectScrollbar,
  },
  data() {
    return {
      site_url: process.env.MIX_APP_URL,
      slug: "",
      file_name: "",
      alt_text: "",
      isMounted: false,
    };
  },
  methods: {
    embed() {
      this.$emit("embed-media-from-sidebar", this.slug);
      this.$emit("closeSidebar");
    },
    copySlug() {
      this.$vs.notify({
        title: i18n.t("success"),
        text: i18n.t("url_copied"),
        color: "success",
        iconPack: "feather",
        position: "top-center",
        icon: "icon-check-circle",
      });
    },
    save() {
      const obj = {
        id: this.data.id,
        alt_text: this.alt_text,
      };
      this.$vs.loading();
      this.$store
        .dispatch("gallery/updateItem", obj)
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
    },
    deleteImage() {
      this.$vs.loading();
      this.$store
        .dispatch("gallery/removeItem", this.data.id)
        .then((response) => {
          this.$vs.loading.close();
          this.$vs.notify({
            title: i18n.t("success"),
            text: i18n.t("SuccessfullyDeleted"),
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
            text: i18n.t("CouldntDeleted"),
            iconPack: "feather",
            icon: "icon-alert-circle",
            color: "danger",
          });
        });
    },
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
      //console.log(this.data)
      this.slug = this.site_url + this.data.slug;
      this.file_name = this.data.file_name;
      this.alt_text = this.data.alt_text;
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
        }
      },
    },
  },
  created() {},
};
</script>
<style lang="scss" scoped>
.add-new-data-sidebar {
  ::v-deep .vs-sidebar--background {
    z-index: 52010;
  }

  ::v-deep .vs-sidebar {
    z-index: 52010;
    width: 450px !important;
    max-width: 90vw;
  }

  ::v-deep .vs-sidebar.vs-sidebar-parent {
    position: fixed !important;
  }
}

.scroll-area--data-list-add-new {
  // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
  height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 82px);
}
</style>
