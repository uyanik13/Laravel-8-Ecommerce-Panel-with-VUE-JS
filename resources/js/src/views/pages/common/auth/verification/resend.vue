<!-- =========================================================================================
    File Name: ForgotPassword.vue
    Description: FOrgot Password Page
    ----------------------------------------------------------------------------------------


    Author URL: https://github.com/uyanik13
========================================================================================== -->


<template>
  <div class="h-screen flex w-full bg-img">
    <div
      class="vx-col w-4/5 sm:w-4/5 md:w-3/5 lg:w-3/4 xl:w-3/5 mx-auto self-center"
    >
      <vx-card>
        <div slot="no-body" class="full-page-bg-color">
          <div class="vx-row">
            <div
              class="vx-col hidden sm:hidden md:hidden lg:block lg:w-1/2 mx-auto self-center"
            >
              <img
                src="@assets/images/pages/forgot-password.png"
                alt="login"
                class="mx-auto"
              />
            </div>
            <div
              class="vx-col sm:w-full md:w-full lg:w-1/2 mx-auto self-center d-theme-dark-bg"
            >
              <div class="p-8">
                <div class="vx-card__title mb-8">
                  <h4 class="mb-4">Hesabınızı Onaylayın</h4>
                  <p>
                    Lütfen e-posta adresinizi girin, Hesap Onaylama Linkini
                    Tekrar Gönderelim.
                  </p>
                </div>

                <vs-input
                  type="email"
                  name="email"
                  label-placeholder="Email"
                  v-model="form.email"
                  :class="{ 'is-invalid': form.errors.has('email') }"
                  class="w-full mb-8"
                />
                <has-error :form="form" field="email" />
                <vs-button
                  type="border"
                  to="/panel/login"
                  class="px-4 w-full md:w-auto"
                  >Girişe Dön</vs-button
                >

                <vs-button
                  @click="send()"
                  :loading="form.busy"
                  class="float-right px-4 w-full md:w-auto mt-3 mb-8 md:mt-0 md:mb-0"
                  >Onay Linki Gönder</vs-button
                >
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
    return { title: this.$t("verify_email") };
  },

  data: () => ({
    email: "",
    status: "",
  }),

  created() {
    if (this.$route.query.email) {
      this.email = this.$route.query.email;
    }
  },

  methods: {
    async send() {
      await axios
        .post("/api/email/resend", { email: this.email, status: this.status })
        .then((response) => {
          this.status = response.status;
          this.$vs.notify({
            title: "Başarılı",
            text: "E-posta Adresinize Doğrulama İsteği Gönderdik.",
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
            text: "Bu Hesap Zaten Onaylı",
            iconPack: "feather",
            icon: "icon-alert-circle",
            color: "danger",
          });
        });
    },
  },
};
</script>
