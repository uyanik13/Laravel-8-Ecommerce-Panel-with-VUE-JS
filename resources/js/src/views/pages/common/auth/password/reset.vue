<!-- =========================================================================================
    File Name: ResetPassword.vue
    Description: Reset Password Page
    ----------------------------------------------------------------------------------------


    Author URL: https://github.com/uyanik13
========================================================================================== -->


<template>
  <div class="h-screen flex w-full bg-img">
    <div class="vx-col sm:w-3/5 md:w-3/5 lg:w-3/4 xl:w-3/5 mx-auto self-center">
      <vx-card>
        <div slot="no-body" class="full-page-bg-color">
          <div class="vx-row">
            <div
              class="vx-col hidden sm:hidden md:hidden lg:block lg:w-1/2 mx-auto self-center"
            >
              <img
                src="@assets/images/pages/reset-password.png"
                alt="login"
                class="mx-auto"
              />
            </div>
            <div
              class="vx-col sm:w-full md:w-full lg:w-1/2 mx-auto self-center d-theme-dark-bg"
            >
              <div class="p-8">
                <div class="vx-card__title mb-8">
                  <h4 class="mb-4">Şifreni Sıfırla</h4>
                  <p>Lütfen yeni şifrenizi girin.</p>
                </div>
                <form
                  class="user"
                  @submit.prevent="reset"
                  @keydown="form.onKeydown($event)"
                >
                  <vs-input
                    type="email"
                    label-placeholder="Email"
                    v-model="form.email"
                    :class="{ 'is-invalid': form.errors.has('email') }"
                    readonly
                    name="email"
                    class="w-full mb-6"
                  />
                  <vs-input
                    type="password"
                    label-placeholder="Şifre"
                    v-model="form.password"
                    :class="{ 'is-invalid': form.errors.has('password') }"
                    name="password"
                    class="w-full mb-6"
                  />
                  <vs-input
                    type="password"
                    label-placeholder="Şifre Tekrarı"
                    v-model="form.password_confirmation"
                    :class="{
                      'is-invalid': form.errors.has('password_confirmation'),
                    }"
                    name="password_confirmation"
                    class="w-full mb-8"
                  />

                  <div
                    class="flex flex-wrap justify-between flex-col-reverse sm:flex-row"
                  >
                    <vs-button
                      type="border"
                      to="/panel/login"
                      class="w-full sm:w-auto mb-8 sm:mb-auto mt-3 sm:mt-auto"
                      >Girişe Git</vs-button
                    >
                    <vs-button
                      :loading="form.busy"
                      @click="reset()"
                      class="w-full sm:w-auto"
                      >Sıfırla</vs-button
                    >
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </vx-card>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  middleware: "guest",

  metaInfo() {
    return { title: this.$t("reset_password") };
  },

  data: () => ({
    token: "",
    email: "",
    password: "",
    password_confirmation: "",
    status: "",
  }),

  created() {
    console.log("TOKEN", this.$route);
    this.email = this.$route.query.email;
    this.token = this.$route.query.token;
  },

  methods: {
    async reset() {
      await axios
        .post("/password/reset", {
          email: this.email,
          token: this.token,
          password: this.password,
          password_confirmation: this.password_confirmation,
          status: this.status,
        })
        .then((response) => {
          this.status = response.status;
          this.$vs.notify({
            title: "Başarılı",
            text: "Şifreniz Başarıyla Değiştirildi.",
            iconPack: "feather",
            icon: "icon-alert-circle",
            color: "success",
          });
          this.form.reset();
          this.$router.push("/login");
        })
        .catch((error) => {
          this.$vs.loading.close();
          this.$vs.notify({
            title: "Error",
            text: "Hata Oluştu",
            iconPack: "feather",
            icon: "icon-alert-circle",
            color: "danger",
          });
        });
    },
  },
};
</script>
