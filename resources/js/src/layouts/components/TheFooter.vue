<!-- =========================================================================================
    File Name: TheFooter.vue
    Description: Footer component
    Component Name: TheFooter
    ----------------------------------------------------------------------------------------

      Author: uyanik13
    Author URL: https://github.com/uyanik13
========================================================================================== -->


<template functional>
  <footer class="the-footer flex-wrap justify-between" :class="classes">
    <span
      >COPYRIGHT &copy; {{ new Date().getFullYear() }}
      <a href="#" target="_blank" rel="nofollow">dijitalreklam.org</a>, All
      rights Reserved</span
    >
    <span class="md:flex hidden items-center"> </span>
  </footer>
</template>

<script>
export default {
  name: "the-footer",
  props: {
    classes: {
      type: String,
    },
  },
  inject: {
    components: {
      default: {},
    },
  },
};
</script>
