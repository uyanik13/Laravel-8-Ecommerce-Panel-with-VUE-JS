<template>
  <vs-tabs :position="isSmallerScreen ? 'top' : 'top'" class="tabs-shadow-none" id="profile-tabs" :key="isSmallerScreen">

    <!-- GENERAL -->
    <vs-tab icon-pack="feather" icon="icon-settings" :label="!isSmallerScreen ? $t('general') : ''">
      <div class="tab-general md:ml-4 md:mt-10 mt-4 ml-0">
        <general />
      </div>
    </vs-tab>

    <vs-tab icon-pack="feather" icon="icon-settings" :label="!isSmallerScreen ? $t('seoSettings') : ''">
      <div class="tab-general md:ml-4 md:mt-10 mt-4 ml-0">
        <seo-settings />
      </div>
    </vs-tab>

    <vs-tab icon-pack="feather" icon="icon-menu" :label="!isSmallerScreen ? $t('Menu') : ''">
          <div class="tab-menu md:ml-4 md:mt-10 mt-4 ml-0">
              <Menu />
          </div>
      </vs-tab>

      <vs-tab icon-pack="feather" icon="icon-user" :label="!isSmallerScreen ? $t('AboutUs') : ''">
          <div class="tab-about-us md:ml-4 md:mt-10 mt-4 ml-0">
              <about-us />
          </div>
      </vs-tab>


       <vs-tab icon-pack="feather" icon="icon-message-circle" :label="!isSmallerScreen ? $t('Testimonials') : ''">
          <div class="tab-menu md:ml-4 md:mt-10 mt-4 ml-0">
              <Testimonials />
          </div>
      </vs-tab>

       <vs-tab icon-pack="feather" icon="icon-aperture" :label="!isSmallerScreen ? $t('Partners') : ''">
          <div class="tab-menu md:ml-4 md:mt-10 mt-4 ml-0">
              <Partners />
          </div>
      </vs-tab>



  </vs-tabs>

</template>

<script>
import General from "./General.vue"
import AboutUs from "./AboutUs"
import SeoSettings from "./SeoSettings"
import Testimonials from "./Testimonials"
import Partners from "./Partners"
import Menu from "./Menu"

export default {
  components: {
    General,
    AboutUs,
    Menu,
    Testimonials,
    Partners,
    SeoSettings,

  },
  data() {
    return {


    }
  },
  computed: {
    isSmallerScreen() {
      return this.$store.state.windowWidth < 768
    }
  }
}
</script>

<style lang="scss">
#profile-tabs {
  .vs-tabs--content {
    padding: 0;
  }
}
</style>
