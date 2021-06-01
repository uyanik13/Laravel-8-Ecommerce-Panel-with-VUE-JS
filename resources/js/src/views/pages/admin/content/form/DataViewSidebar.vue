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
      <h4>{{ dataName }} - {{ dataSubject }}</h4>
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
              <div
                v-for="(option, index) in FormData"
                :key="index"
                class="vx-col w-full md:w-12/12 mb-base"
              >
                <vs-input
                  :label="$t(option.key)"
                  v-model="option.value"
                  class="mt-5 w-full"
                />
                <vs-divider></vs-divider>
              </div>
            </vx-card>
          </div>
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
      console.log(this.data.FormData);
      const map = new Map(Object.entries(JSON.parse(this.data.FormData)));
      for (const [key, value] of map) {
        this.FormData.push({
          key,
          value,
        });
      }
      this.FormData.splice(0, 2);
      if (Object.entries(this.data).length === 0) {
        this.initValues();
        this.$validator.reset();
      } else {
        const { id } = JSON.parse(JSON.stringify(this.data));
        //console.log('active:', this.data)
        this.dataId = id;
      }
    },
  },
  data() {
    return {
      isMounted: false,
      dataId: null,
      dataName: "",
      dataEmail: "",
      dataSubject: "",
      dataMessage: "",
      FormData: [
        {
          key: "",
          value: "",
        },
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
          //this.$validator.reset()
          //this.initValues()
        }
      },
    },
  },
  mounted() {
    this.isMounted = true;
  },
  methods: {},
  components: {
    VuePerfectScrollbar,
  },
};
</script>

<style lang="scss" scoped>
.add-new-data-sidebar {
  ::v-deep .vs-sidebar--background {
    z-index: 52010;
  }

  .vs-sidebar {
    max-width: 720px !important;
  }
  ::v-deep .vs-sidebar {
    z-index: 52010;
    width: 720px !important;
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
