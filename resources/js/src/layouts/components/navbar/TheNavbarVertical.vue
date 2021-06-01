<!-- =========================================================================================
  File Name: TheNavbar.vue
  Description: Navbar component
  Component Name: TheNavbar
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
========================================================================================== -->

<template>
  <div class="relative">
    <div class="vx-navbar-wrapper" :class="classObj">
      <global-file-manager
        :showPopup="showPopup"
        @embed-media-from-popup="embedMediaFromPopup"
      />

      <vs-navbar
        class="vx-navbar navbar-custom navbar-skelton"
        :color="navbarColorLocal"
        :class="textColor"
      >
        <!-- SM - OPEN SIDEBAR BUTTON -->
        <feather-icon
          class="sm:inline-flex xl:hidden cursor-pointer p-2"
          icon="MenuIcon"
          @click.stop="showSidebar"
        />

        <!--      <bookmarks :navbarColor="navbarColor" v-if="windowWidth >= 992" />-->

        <vs-button
          icon-pack="feather"
          icon="icon-link"
          href="/"
          target="_blank"
          class="shadow-lg btn-back-to-top"
        >
          {{ $t("GoToTheWebSite") }}</vs-button
        >

        <vs-button
          icon-pack="feather"
          icon="icon-file"
          @click="showPopup = !showPopup"
          class="ml-5 center"
          color="#0D122E"
        >
          {{ $t("fileManager") }}</vs-button
        >

        <vs-spacer />

        <i18n />

        <!--        <search-bar />-->

        <!--        <notification-drop-down />-->

        <profile-drop-down />
      </vs-navbar>
    </div>
  </div>
</template>

<script>
import Bookmarks from "./components/Bookmarks.vue";
import I18n from "./components/I18n.vue";
import SearchBar from "./components/SearchBar.vue";
import CartDropDown from "./components/CartDropDown.vue";
import NotificationDropDown from "./components/NotificationDropDown.vue";
import ProfileDropDown from "./components/ProfileDropDown.vue";

export default {
  name: "the-navbar-vertical",
  props: {
    navbarColor: {
      type: String,
      default: "#fff",
    },
  },
  data() {
    return {
      showPopup: false,
      dataInner: "",
    };
  },
  components: {
    Bookmarks,
    I18n,
    SearchBar,
    CartDropDown,
    NotificationDropDown,
    ProfileDropDown,
  },
  computed: {
    navbarColorLocal() {
      return this.$store.state.theme === "dark" && this.navbarColor === "#fff"
        ? "#10163a"
        : this.navbarColor;
    },
    verticalNavMenuWidth() {
      return this.$store.state.verticalNavMenuWidth;
    },
    textColor() {
      return {
        "text-white":
          (this.navbarColor !== "#10163a" &&
            this.$store.state.theme === "dark") ||
          (this.navbarColor !== "#fff" && this.$store.state.theme !== "dark"),
      };
    },
    windowWidth() {
      return this.$store.state.windowWidth;
    },

    // NAVBAR STYLE
    classObj() {
      if (this.verticalNavMenuWidth === "default") return "navbar-default";
      else if (this.verticalNavMenuWidth === "reduced") return "navbar-reduced";
      else if (this.verticalNavMenuWidth) return "navbar-full";
    },
  },
  methods: {
    showSidebar() {
      this.$store.commit("TOGGLE_IS_VERTICAL_NAV_MENU_ACTIVE", true);
    },
    embedMediaFromPopup(event) {
      this[this.dataInner] = event;
    },
    embedImage(data) {
      this.dataInner = data;
      this.showPopup = !this.showPopup;
    },
  },
};
</script>
