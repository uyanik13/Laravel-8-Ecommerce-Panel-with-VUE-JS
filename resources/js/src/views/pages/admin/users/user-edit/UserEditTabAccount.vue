<!-- =========================================================================================
  File Name: UserEditTabInformation.vue
  Description: User Edit Information Tab content
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
========================================================================================== -->

<template>
  <div id="user-edit-tab-info">
    <!-- Avatar Row -->
    <div class="vx-row">
      <div class="vx-col w-full">
        <div class="flex items-start flex-col sm:flex-row">
          <img :src="data_local.avatar" class="mr-8 rounded h-24 w-24" />
          <!-- <vs-avatar :src="data.avatar" size="80px" class="mr-4" /> -->
          <div>
            <p class="text-lg font-medium mb-2 mt-4 sm:mt-0">{{ data.name }}</p>
            <input
              type="file"
              class="hidden"
              ref="updateImgInput"
              @change="update_avatar"
              accept="image/*"
            />
            <vs-button
              class="mr-4 sm:mb-0 mb-2"
              @click="$refs.updateImgInput.click()"
              >{{ $t("change_avatar") }}</vs-button
            >

            <vs-button type="border" color="danger">{{
              $t("remove_avatar")
            }}</vs-button>
          </div>
        </div>
      </div>
    </div>

    <!-- Content Row -->
    <div class="vx-row">
      <div class="vx-col md:w-1/2 w-full">
        <vs-input
          class="w-full mt-4"
          :label="$t('name')"
          v-model="data.name"
          v-validate="'required|alpha_spaces'"
          name="name"
        />
        <span class="text-danger text-sm" v-show="errors.has('name')">{{
          errors.first("name")
        }}</span>

        <vs-input
          class="w-full mt-4"
          :label="$t('email')"
          v-model="data.email"
          type="email"
          v-validate="'required|email'"
          name="email"
        />
        <span class="text-danger text-sm" v-show="errors.has('email')">{{
          errors.first("email")
        }}</span>
        <vs-input
          class="w-full mt-4"
          :label="$t('Phone')"
          v-model="data.phone"
          v-validate="{ regex: '^\\+?([0-9]+)$' }"
          name="phone"
        />
        <span class="text-danger text-sm" v-show="errors.has('phone')">{{
          errors.first("phone")
        }}</span>
      </div>

      <div class="vx-col md:w-1/2 w-full">
        <div class="mt-4">
          <label class="vs-input--label">{{ $t("Status") }}</label>
          <v-select
            v-model="status_local"
            :clearable="false"
            :options="statusOptions"
            v-validate="'required'"
            :dir="$vs.rtl ? 'rtl' : 'ltr'"
          />
          <span class="text-danger text-sm" v-show="errors.has('status')">{{
            errors.first("status")
          }}</span>
        </div>

        <div class="mt-4">
          <label class="vs-input--label">{{ $t("Role") }}</label>
          <v-select
            v-model="role_local"
            :clearable="false"
            :options="roleOptions"
            v-validate="'required'"
            :dir="$vs.rtl ? 'rtl' : 'ltr'"
          />
          <span class="text-danger text-sm" v-show="errors.has('role')">{{
            errors.first("role")
          }}</span>
        </div>

        <vs-input
          class="w-full mt-4"
          :label="$t('Address')"
          v-model="data.address"
          v-validate="'alpha_spaces'"
          name="address"
        />
        <span class="text-danger text-sm" v-show="errors.has('address')">{{
          errors.first("address")
        }}</span>
      </div>
    </div>

    <!--   &lt;!&ndash; Permissions &ndash;&gt;
    <vx-card class="mt-base" no-shadow card-border>

      <div class="vx-row">
        <div class="vx-col w-full">
          <div class="flex items-end px-3">
            <feather-icon svgClasses="w-6 h-6" icon="LockIcon" class="mr-2" />
            <span class="font-medium text-lg leading-none">Permissions</span>
          </div>
          <vs-divider />
        </div>
      </div>

      <div class="block overflow-x-auto">
        <table class="w-full">
          <tr>
            &lt;!&ndash;
              You can also use `Object.keys(Object.values(data_local.permissions)[0])` this logic if you consider,
              our data structure. You just have to loop over above variable to get table headers.
              Below we made it simple. So, everyone can understand.
             &ndash;&gt;
            <th class="font-semibold text-base text-left px-3 py-2" v-for="heading in ['Module', 'Read', 'Write', 'Create', 'Delete']" :key="heading">{{ heading }}</th>
          </tr>

          <tr v-for="(val, name) in data_local.permissions" :key="name">
            <td class="px-3 py-2">{{ name }}</td>
            <td v-for="(permission, name) in val" class="px-3 py-2" :key="name+permission">
              <vs-checkbox v-model="val[name]" />
            </td>
          </tr>
        </table>
      </div>

    </vx-card>-->

    <!-- Save & Reset Button -->
    <div class="vx-row">
      <div class="vx-col w-full">
        <div class="mt-8 flex flex-wrap items-center justify-end">
          <vs-button
            class="ml-auto mt-2"
            @click="save_changes"
            :disabled="!validateForm"
            >{{ $t("Save") }}</vs-button
          >
          <!--<vs-button class="ml-4 mt-2" type="border" color="warning" @click="reset_data">Reset</vs-button>-->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vSelect from "vue-select";

export default {
  components: {
    vSelect,
  },
  props: {
    data: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      avatar: null,
      data_local: JSON.parse(JSON.stringify(this.data)),

      statusOptions: [
        { label: "Active", value: 1 },
        { label: "Deactivated", value: 0 },
      ],
      roleOptions: [
        { label: "Admin", value: "admin" },
        { label: "User", value: "user" },
        { label: "Staff", value: "staff" },
      ],
    };
  },
  computed: {
    status_local: {
      get() {
        return { label: this.data_local.status, value: this.data_local.status };
      },
      set(obj) {
        this.data_local.status = obj.value;
      },
    },
    role_local: {
      get() {
        return { label: this.data_local.role, value: this.data_local.role };
      },
      set(obj) {
        this.data_local.role = obj.value;
      },
    },
    validateForm() {
      return !this.errors.any();
    },
  },
  methods: {
    // capitalize(str) {
    //   return str.slice(0,1).toUpperCase() + str.slice(1,str.length)
    // },
    save_changes() {
      if (!this.validateForm) return;
      const payload = {
        id: this.data.id,
        name: this.data.name,
        avatar: this.data_local.avatar,
        address: this.data.address,
        email: this.data.email,
        phone: this.data.phone,
        status: this.status_local.value,
        role: this.role_local.value,
      };
      this.$store
        .dispatch("user/updateUser", payload)
        .then((response) => {
          this.$vs.notify({
            title: "Başarılı",
            text: "Değişiklikler Başarıyla Düzenlendi",
            iconPack: "feather",
            icon: "icon-success",
            color: "success",
          });
        })
        .catch((error) => {
          this.$vs.notify({
            title: "Hata",
            text: "Değişiklikler Kaydedilemedi.",
            iconPack: "feather",
            icon: "icon-alert-circle",
            color: "danger",
          });
        });
    },

    reset_data() {
      this.data_local = JSON.parse(JSON.stringify(this.data));
    },
    update_avatar(input) {
      if (input.target.files && input.target.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.data_local.avatar = e.target.result;
          console.log("IMAGEURL", e.target.result);
        };
        reader.readAsDataURL(input.target.files[0]);
      }
    },
  },
};
</script>
