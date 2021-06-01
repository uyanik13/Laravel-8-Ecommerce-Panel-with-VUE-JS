<!-- =========================================================================================
    File Name: VxBreadcrumb.vue
    Description: Breadcrumb component
    Component Name: VxBreadcrumb
    ----------------------------------------------------------------------------------------


    Author URL: https://github.com/uyanik13
========================================================================================== -->


<template>
  <div class="vx-breadcrumb">
    <ul class="flex flex-wrap items-center">
      <li class="inline-flex items-end">
        <router-link to="/">
          <feather-icon
            icon="HomeIcon"
            svgClasses="h-5 w-5 mb-1 stroke-current text-primary"
          />
        </router-link>
        <span class="breadcrumb-separator mx-2"
          ><feather-icon
            :icon="$vs.trl ? 'ChevronsLeftIcon' : 'ChevronsRightIcon'"
            svgClasses="w-4 h-4"
        /></span>
      </li>
      <li
        v-for="(link, index) in $route.meta.breadcrumb.slice(1, -1)"
        :key="index"
        class="inline-flex items-center"
      >
        <router-link :to="link.url" v-if="link.url">{{
          $t(link.title)
        }}</router-link>
        <span class="text-primary cursor-default" v-else>{{
          $t(link.title) || link.title
        }}</span>
        <span class="breadcrumb-separator mx-2 flex items-start"
          ><feather-icon
            :icon="$vs.trl ? 'ChevronsLeftIcon' : 'ChevronsRightIcon'"
            svgClasses="w-4 h-4"
        /></span>
      </li>
      <li class="inline-flex">
        <span
          v-if="$route.meta.breadcrumb.slice(-1)[0].active"
          class="cursor-default"
          >{{ $t($route.meta.breadcrumb.slice(-1)[0].title) }}</span
        >
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "vx-breadcrumb",
};
</script>
