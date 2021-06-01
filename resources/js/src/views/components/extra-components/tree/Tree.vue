<!-- =========================================================================================
    File Name: Tree.vue
    Description: Tree demo
    ----------------------------------------------------------------------------------------


    Author URL: https://github.com/uyanik13
========================================================================================== -->
<template>
  <div id="page-tree-demo">
    <tree-dropdown></tree-dropdown>
    <tree-search-tree></tree-search-tree>
    <tree-async-tree></tree-async-tree>
  </div>
</template>

<script>
import TreeDropdown from "./TreeDropdown.vue";
import TreeSearchTree from "./TreeSearchTree.vue";
import TreeAsyncTree from "./TreeAsyncTree.vue";

export default {
  components: {
    TreeDropdown,
    TreeSearchTree,
    TreeAsyncTree,
  },
};
</script>
