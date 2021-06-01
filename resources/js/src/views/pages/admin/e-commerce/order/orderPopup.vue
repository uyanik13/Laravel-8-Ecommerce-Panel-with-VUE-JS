<!-- =========================================================================================
    File Name: PopupBackground.vue
    Description: Change background when popup opens
    ----------------------------------------------------------------------------------------


    Author URL: https://github.com/uyanik13
========================================================================================== -->


<template>
  <div class="align-content-center mt-5">
    <feather-icon
      icon="EyeIcon"
      svgClasses="w-7 h-7 hover:text-danger stroke-current"
      class="ml-2"
      @click="popupActive = true"
    />

    <vs-popup
      background-color="rgba(152,152,152,.7)"
      fullscreen
      :background-color-popup="colorx"
      class="bg-primary-gradient"
      :title="String(item.order_id)"
      :active.sync="popupActive"
    >
      <order-detail :item="item" />
    </vs-popup>
  </div>
</template>

<script>
import i18n from "@/i18n/i18n";
import Swal from "sweetalert2";
import OrderDetail from "./orderDetail";

export default {
  components: {
    OrderDetail,
  },
  props: {
    item: {},
  },
  data() {
    return {
      colorx: "#ffffff",
      popupActive: false,
    };
  },
  methods: {
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

  created() {
    //this.$store.dispatch('post/fetchMyCases')
  },
};
</script>

