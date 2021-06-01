<!-- =========================================================================================
    File Name: PopupBackground.vue
    Description: Change background when popup opens
    ----------------------------------------------------------------------------------------


    Author URL: https://github.com/uyanik13
========================================================================================== -->


<template>
  <div class="align-content-center mt-5">
    <vs-button @click="popupActive = true" type="filled"
      >Ödeme Seçeneklerini Görün</vs-button
    >
    <vs-popup
      background-color="rgba(152,152,152,.7)"
      :background-color-popup="colorx"
      class="bg-primary-gradient"
      title="Ödeme Seçenekleri"
      :active.sync="popupActive"
    >
      <vx-card no-shadow v-if="shopierData == null">
        <p v-if="normalPrice" class="text-lg font-medium mb-2 mt-4 sm:mt-0">
          Normal Ücret : 49.99₺ Öde
        </p>
        <p v-else class="text-lg font-medium mb-2 mt-4 sm:mt-0">
          Bize Destek Olabileceğiniz Rakam
        </p>

        <vs-switch v-model="normalPrice" />

        <vs-input
          class="w-full my-base"
          v-if="normalPrice"
          name="price"
          disabled=""
          v-model="price"
        ></vs-input>
        <vs-input
          class="w-full my-base"
          v-else
          label-placeholder="Min 49.99₺"
          name="price"
          v-model="price"
        ></vs-input>

        <!-- Save & Reset Button -->
        <div class="flex flex-wrap items-center justify-end">
          <vs-button class="ml-auto mt-2" @click="submitData"
            >Ödemeyi Gerçekleştirin</vs-button
          >
        </div>
      </vx-card>
      <vx-card no-shadow v-else>
        <div v-html="shopierData"></div>
      </vx-card>
    </vs-popup>
  </div>
</template>

<script>
export default {
  data() {
    return {
      shopierData: null,
      normalPrice: true,
      price: 49.99,
      plan_name: "İşletme Paketi",
      colorx: "#ffffff",
      popupActive: false,
    };
  },
  computed: {
    validateForm() {
      return !this.errors.any() && this.price >= 49;
    },
  },
  methods: {
    submitData() {
      if (!this.validateForm) return;
      const payload = {
        price: this.price,
        plan_name: this.plan_name,
      };
      this.$store
        .dispatch("user/createPayment", payload)
        .then((response) => {
          this.$vs.notify({
            title: "Başarılı",
            text: "Şimdi Güvenli Ödeme Yapabilirsiniz.",
            iconPack: "feather",
            icon: "icon-info",
            color: "success",
          });
          console.log("SHOPIER RESPONSE", response);
          this.shopierData = response.data;
        })
        .catch((error) => {
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
};
</script>
