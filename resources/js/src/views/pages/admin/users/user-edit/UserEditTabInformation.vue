<!-- =========================================================================================
  File Name: UserEditTabInformation.vue
  Description: User Edit Information Tab content
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
========================================================================================== -->

<template>
  <div id="user-edit-tab-info">
    <div class="vx-row">
      <div class="vx-col w-full md:w-1/2">
        <!-- Col Header -->
        <div class="flex items-end">
          <feather-icon icon="UserIcon" class="mr-2" svgClasses="w-5 h-5" />
          <span class="leading-none font-medium">{{
            $t("password_management")
          }}</span>
        </div>

        <!-- Col Content -->
        <div>
          <!--          &lt;!&ndash; DOB &ndash;&gt;-->
          <!--          <div class="mt-4">-->
          <!--            <label class="text-sm">Birth Date</label>-->
          <!--            <flat-pickr v-model="data.electric_static" :config="{ dateFormat: 'd F Y', maxDate: new Date() }" class="w-full" v-validate="'required'" name="dob" />-->
          <!--            <span class="text-danger text-sm"  v-show="errors.has('dob')">{{ errors.first('dob') }}</span>-->
          <!--          </div>-->

          <vs-input
            class="w-full mb-base"
            label-placeholder="Eski Şifre"
            v-model="old_password"
          />
          <vs-input
            class="w-full mb-base"
            label-placeholder="Yeni Şifre"
            v-model="new_password"
          />
          <vs-input
            class="w-full mb-base"
            label-placeholder="Yeni Şifre Onayı"
            v-model="confirm_new_password"
          />

          <!--          &lt;!&ndash; Gender &ndash;&gt;-->
          <!--          <div class="mt-4">-->
          <!--            <label class="text-sm">Gender</label>-->
          <!--            <div class="mt-2">-->
          <!--              <vs-radio v-model="data_local.gender" vs-value="male" class="mr-4">Male</vs-radio>-->
          <!--              <vs-radio v-model="data_local.gender" vs-value="female" class="mr-4">Female</vs-radio>-->
          <!--              <vs-radio v-model="data_local.gender" vs-value="other">Other</vs-radio>-->
          <!--            </div>-->
          <!--          </div>-->

          <!--          <div class="mt-6">-->
          <!--            <label>Contact Options</label>-->
          <!--            <div class="flex flex-wrap mt-1">-->
          <!--            <vs-checkbox v-model="data_local.contact_options" vs-value="email" class="mr-4 mb-2">Email</vs-checkbox>-->
          <!--            <vs-checkbox v-model="data_local.contact_options" vs-value="message" class="mr-4 mb-2">Message</vs-checkbox>-->
          <!--            <vs-checkbox v-model="data_local.contact_options" vs-value="Phone" class=" mb-2">Phone</vs-checkbox>-->
          <!--            </div>-->
          <!--          </div>-->
        </div>
      </div>
      <!-- Address Col -->
      <!--      <div class="vx-col w-full md:w-1/2">-->

      <!--          &lt;!&ndash; Col Header &ndash;&gt;-->
      <!--          <div class="flex items-end md:mt-0 mt-base">-->
      <!--            <feather-icon icon="MapPinIcon" class="mr-2" svgClasses="w-5 h-5" />-->
      <!--            <span class="leading-none font-medium">Address</span>-->
      <!--          </div>-->

      <!--          &lt;!&ndash; Col Content &ndash;&gt;-->
      <!--          <div>-->
      <!--            <vs-input class="w-full mt-4" label="Address Line 1" v-model="data_local.location.add_line_1" v-validate="'required'" name="addd_line_1" />-->
      <!--            <span class="text-danger text-sm"  v-show="errors.has('addd_line_1')">{{ errors.first('addd_line_1') }}</span>-->

      <!--            <vs-input class="w-full mt-4" label="Address Line 2" v-model="data_local.location.add_line_2" />-->

      <!--            <vs-input class="w-full mt-4" label="Post Code" v-model="data_local.location.post_code" v-validate="'required|numeric'" name="post_code" />-->
      <!--            <span class="text-danger text-sm"  v-show="errors.has('post_code')">{{ errors.first('post_code') }}</span>-->

      <!--            <vs-input class="w-full mt-4" label="City" v-model="data_local.location.city" v-validate="'required|alpha'" name="city" />-->
      <!--            <span class="text-danger text-sm"  v-show="errors.has('city')">{{ errors.first('city') }}</span>-->

      <!--            <vs-input class="w-full mt-4" label="State" v-model="data_local.location.state" v-validate="'required|alpha'" name="state" />-->
      <!--            <span class="text-danger text-sm"  v-show="errors.has('state')">{{ errors.first('state') }}</span>-->

      <!--            <vs-input class="w-full mt-4" label="Country" v-model="data_local.location.country" v-validate="'required|alpha'" name="country" />-->
      <!--            <span class="text-danger text-sm"  v-show="errors.has('country')">{{ errors.first('country') }}</span>-->

      <!--          </div>-->
      <!--      </div>-->
    </div>

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
          <!--          <vs-button class="ml-4 mt-2" type="border" color="warning" @click="reset_data">Reset</vs-button>-->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
import vSelect from "vue-select";

export default {
  components: {
    vSelect,
    flatPickr,
  },
  props: {
    data: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      data_local: JSON.parse(JSON.stringify(this.data)),
      currentUserData: {},
      old_password: "",
      new_password: "",
      confirm_new_password: "",
      langOptions: [
        { label: "English", value: "english" },
        { label: "Spanish", value: "spanish" },
        { label: "French", value: "french" },
        { label: "Russian", value: "russian" },
        { label: "German", value: "german" },
        { label: "Arabic", value: "arabic" },
        { label: "Sanskrit", value: "sanskrit" },
      ],
    };
  },
  computed: {
    validateForm() {
      return (
        !this.errors.any() &&
        this.old_password != "" &&
        this.new_password != "" &&
        this.confirm_new_password != ""
      );
    },
  },
  methods: {
    save_changes() {
      if (!this.validateForm) return;
      const payload = {
        id: this.currentUserData.id,
        old_password: this.old_password,
        new_password: this.new_password,
        confirm_new_password: this.confirm_new_password,
      };
      this.$store
        .dispatch("user/updateUser", payload)
        .then((response) => {
          this.$vs.loading.close();
          if (response.data)
            this.$vs.notify({
              title: "Success",
              text: "Password Successfully Changed",
              iconPack: "feather",
              icon: "icon-alert-circle",
              color: "success",
            });
        })
        .catch((error) => {
          this.$vs.loading.close();
          this.$vs.notify({
            title: "Error",
            text: error.message,
            iconPack: "feather",
            icon: "icon-alert-circle",
            color: "danger",
          });
        });
    },
  },
  reset_data() {
    this.data_local = Object.assign({}, this.data);
  },
};
</script>
