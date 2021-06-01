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
                  <h4 class="mb-4">Hesap Doğrulama</h4>
                </div>
                <card :title="$t('verify_email')">
                  <template v-if="success">
                    <div class="alert alert-success" role="alert">
                      {{ success }}
                    </div>
                  </template>
                  <template v-else>
                    <div class="alert alert-danger" role="alert">
                      {{ error || $t("failed_to_verify_email") }}
                    </div>

                    <router-link
                      :to="{ name: 'verification.resend' }"
                      class="small float-right"
                    >
                      {{ $t("send_verification_link") }}
                    </router-link>
                  </template>
                </card>

                <a
                  href="https://play.google.com/store/apps/details?id=com.dijitalreklam.storeapp"
                  >Uygulamaya Git</a
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

const qs = (params) =>
  Object.keys(params)
    .map((key) => `${key}=${params[key]}`)
    .join("&");

export default {
  middleware: "guest",

  metaInfo() {
    return { title: this.$t("verify_email") };
  },

  async beforeRouteEnter(to, from, next) {
    try {
      const { data } = await axios.post(
        `/api/email/verify/${to.params.id}?${qs(to.query)}`
      );

      next((vm) => {
        vm.success = data.status;
      });
    } catch (e) {
      next((vm) => {
        vm.error = e.response.data.status;
      });
    }
  },

  data: () => ({
    error: "",
    success: "",
  }),
};
</script>
