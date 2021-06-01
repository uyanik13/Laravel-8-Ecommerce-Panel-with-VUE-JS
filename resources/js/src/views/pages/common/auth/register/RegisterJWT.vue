<!-- =========================================================================================
File Name: RegisterJWT.vue
Description: Register Page for JWT
----------------------------------------------------------------------------------------
Item Name: Ogur Uyanik Admin Dashboard

Author URL: https://github.com/uyanik13
========================================================================================== -->


<template>
  <div class="clearfix">
    <vs-input
      v-validate="'required|min:3'"
      data-vv-validate-on="blur"
      :label-placeholder="$t('NameAndSurname')"
      name="name"
      v-model="name"
      class="w-full"
    />
    <span class="text-danger text-sm">{{
      errors.first("name") ? $t("NameRequried") : ""
    }}</span>

    <vs-input
      v-validate="'required|email'"
      data-vv-validate-on="blur"
      name="email"
      type="email"
      :label-placeholder="$t('Email')"
      v-model="email"
      class="w-full mt-6"
    />
    <span class="text-danger text-sm">{{
      errors.first("email") ? $t("EmailRequried") : ""
    }}</span>

    <!--<vs-input
      v-validate="'required|min:10|max:12'"
      data-vv-validate-on="blur"
      name="phone"
      type="phone"
      label-placeholder="Telefon Numarası"
      placeholder="Telefon Numaranızı Giriniz"
      v-model="phone"
      class="w-full mt-6" />
    <span class="text-danger text-sm">{{ errors.first('phone') ? 'Telefon No Gerekli' : ''}}</span>-->

    <vs-input
      ref="password"
      type="password"
      data-vv-validate-on="blur"
      v-validate="'required|min:6|max:10'"
      name="password"
      :label-placeholder="$t('Password')"
      v-model="password"
      class="w-full mt-6"
    />
    <span class="text-danger text-sm">{{
      errors.first("password") ? $t("PasswordRequired") : ""
    }}</span>

    <vs-input
      type="password"
      v-validate="'min:6|max:10|confirmed:password'"
      data-vv-validate-on="blur"
      data-vv-as="password"
      name="confirm_password"
      :label-placeholder="$t('PasswordConfirm')"
      v-model="confirm_password"
      class="w-full mt-6"
    />
    <span class="text-danger text-sm">{{
      errors.first("confirm_password") ? $t("PasswordConfirmRequired") : ""
    }}</span>

    <vs-checkbox v-model="isTermsConditionAccepted" class="mt-6">{{
      $t("TermsAndConditions")
    }}</vs-checkbox>
    <vs-button type="border" @click="loginUser()" class="mt-6">{{
      $t("login")
    }}</vs-button>
    <vs-button
      class="float-right mt-6"
      @click="register"
      :disabled="!validateForm"
      >{{ $t("Register") }}</vs-button
    >
  </div>
</template>

<script>
import i18n from "@/i18n/i18n";
import Cookies from "js-cookie";
export default {
  created() {
    this.checkAuth();
  },
  data() {
    return {
      name: "",
      email: "",
      phone: "",
      type: "",
      password: "",
      confirm_password: "",
      isTermsConditionAccepted: true,
    };
  },
  computed: {
    validateForm() {
      return (
        !this.errors.any() &&
        this.name != "" &&
        this.email != "" &&
        this.password != "" &&
        this.confirm_password != "" &&
        this.isTermsConditionAccepted === true
      );
    },
  },
  methods: {
    // checkLogin () {
    //   // If user is already logged in notify
    //   if (this.$acl.check('user')) {
    //     return this.$router.push({ name: 'dashboard'})
    //   } else if (this.$acl.check('admin')) {
    //     return this.$router.push({ name: 'admin-dashboard'})
    //   }
    //   return true
    // },
    register() {
      if (!this.validateForm) return;
      this.$vs.loading();
      const payload = {
        name: this.name,
        phone: this.phone,
        email: this.email,
        password: this.password,
        confirm_password: this.confirm_password,
      };
      this.$store
        .dispatch("auth/register", payload)
        .then((response) => {
          this.$vs.loading.close();
          this.showAlert(
            i18n.t("Success"),
            i18n.t("yourAccountCreated"),
            "icon-success",
            "success"
          );
          this.$router.push({ name: "login" });
        })
        .catch((error) => {
          this.$vs.loading.close();
          this.showAlert(
            i18n.t("Error"),
            i18n.t("you_should_use_unique_email_address"),
            "icon-alert-circle",
            "warning"
          );
        });
    },
    loginUser() {
      this.$router.push({ name: "login" }).catch(() => {});
    },
    checkAuth() {
      const user = Cookies.get("user") ? JSON.parse(Cookies.get("user")) : null;
      if (user) {
        if (user.role === "user") {
          //this.showAlert(i18n.t('Error'), i18n.t('you_are_logged_in'), 'icon-alert-circle', 'warning')
          return this.$router.push({ name: "user.dashboard" });
        } else if (user.role === "admin") {
          //this.showAlert(i18n.t('Error'), i18n.t('you_are_logged_in'), 'icon-alert-circle', 'warning')
          return this.$router.push({ name: "admin.dashboard" });
        }
      }
    },
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
};
</script>
