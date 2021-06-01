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

    <VuePerfectScrollbar
      class="scroll-area--data-list-add-new"
      :settings="settings"
      :key="$vs.rtl"
    >
      <div class="p-6">
        <div class="vx-row match-height">
          <div class="vx-col w-full md:w-11/12 mb-base">
            <vx-card>
              <!--  USERS -->
              <vs-select
                v-model="user_id"
                :label="$t('Users')"
                name="dataUserId"
                class="mt-5 w-full"
              >
                <vs-select-item
                  :key="user.id"
                  :value="user.id"
                  :text="user.name"
                  v-for="user in userList"
                />
                <span
                  class="text-danger text-sm"
                  v-show="errors.has('user_id')"
                  >{{ errors.first("user_id") }}</span
                >
              </vs-select>

              <!--  PACKAGES -->
              <vs-select
                v-model="package_id"
                :label="$t('Packages')"
                name="dataUserId"
                class="mt-5 w-full"
              >
                <vs-select-item
                  :key="packageData.id"
                  :value="packageData.id"
                  :text="packageData.title"
                  v-for="packageData in packageList"
                />
                <span
                  class="text-danger text-sm"
                  v-show="errors.has('package_id')"
                  >{{ errors.first("package_id") }}</span
                >
              </vs-select>

              <!-- TITLE -->
              <vs-input
                :label="$t('Title')"
                v-model="title"
                class="mt-5 w-full"
                name="title"
                v-validate="'required'"
              />
              <span class="text-danger text-sm" v-show="errors.has('title')">{{
                errors.first("title") ? $t("titleRequired") : ""
              }}</span>

              <br />
              <vs-divider></vs-divider>
              <!-- PRICE -->
              <vs-input
                :label="$t('Price')"
                v-model="amount"
                class="mt-5 w-full"
                v-validate="'required'"
              />

              <vs-divider></vs-divider>
              <span>{{ $t("StartDate") }}</span>
              <datepicker v-model="start_at"></datepicker>
              <br />

              <vs-divider></vs-divider>
              <span>{{ $t("ExpiredDate") }}</span>
              <datepicker
                placeholder="Select Date"
                v-model="ends_at"
              ></datepicker>
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
import i18n from "@/i18n/i18n";
import Datepicker from "vuejs-datepicker";
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
        //cconsole.log(this.data.data)
        const {
          id,
          user_id,
          package_id,
          title,
          start_at,
          ends_at,
          amount,
        } = JSON.parse(JSON.stringify(this.data.data));

        this.dataId = id;
        this.user_id = user_id;
        this.package_id = package_id;
        this.title = title;
        this.amount = amount;
        this.start_at = start_at;
        this.ends_at = ends_at;
      }
      // Object.entries(this.data).length === 0 ? this.initValues() : { this.dataId, this.dataName, this.dataCategory, this.dataOrder_status, this.dataUsage_amount } = JSON.parse(JSON.stringify(this.data))
    },
  },
  data() {
    return {
      dataId: null,
      user_id: "",
      package_id: "",
      title: "",
      amount: "",
      start_at: "",
      ends_at: "",
      types: [
        { text: i18n.t("News"), value: "news" },
        { text: i18n.t("Service"), value: "service" },
        { text: i18n.t("Profile"), value: "profile" },
      ],

      settings: {
        // perfectscrollbar settings
        maxScrollbarLength: 60,
        wheelSpeed: 0.6,
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
      return !this.errors.any() && this.package_id && this.user_id;
    },
    userList() {
      return this.$store.state.user.users;
    },
    packageList() {
      return this.$store.state.package.packages;
    },
  },
  methods: {
    initValues() {
      if (this.data.id) return;
      this.dataId = null;
      this.title = "";
      this.user_id = "";
      this.package_id = "";
      this.amount = "";
      this.start_at = "";
      this.ends_at = "";
      //this.options = ''
    },
    submitData() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          const obj = {
            id: this.dataId,
            title: this.title,
            user_id: this.user_id,
            package_id: this.package_id,
            amount: this.amount,
            start_at: this.start_at,
            ends_at: this.ends_at,
          };
          if (this.dataId !== null && this.dataId >= 0) {
            this.$store
              .dispatch("subscription/updateItem", obj)
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
              .dispatch("subscription/addItem", obj)
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
          this.$emit("closeSidebar");
          this.initValues();
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
  },
  components: {
    VuePerfectScrollbar,
    quillEditor,
    Datepicker,
  },
  created() {
    this.$store.dispatch("user/fetchUsers");
    this.$store.dispatch("package/fetchItems");
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
