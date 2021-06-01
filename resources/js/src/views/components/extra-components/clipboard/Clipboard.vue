<!-- =========================================================================================
    File Name: Clipboard.vue
    Description: Clipboard demo
    ----------------------------------------------------------------------------------------

      Author: uyanik13

========================================================================================== -->


<template>
  <div id="page-clipboard-demo">
    <clipboard-directive></clipboard-directive>
    <clipboard-without-directive></clipboard-without-directive>
  </div>
</template>

<script>
import ClipboardDirective from "./ClipboardDirective.vue";
import ClipboardWithoutDirective from "./ClipboardWithoutDirective.vue";

export default {
  components: {
    ClipboardDirective,
    ClipboardWithoutDirective,
  },
};
</script>
