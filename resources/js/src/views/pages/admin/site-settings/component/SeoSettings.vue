<template>
    <vx-card no-shadow>
        <global-file-manager
            :showPopup="showPopup"
            @embed-media-from-popup="embedMediaFromPopup"
        />
        <vs-input
            class="w-full mb-base"
            icon-pack="feather"
            icon="icon-settings"
            :label-placeholder="$t('google_site_verification')"
            v-model="google_site_verification"
        ></vs-input>
        <vs-input
            class="w-full mb-base"
            icon-pack="feather"
            icon="icon-settings"
            :label-placeholder="$t('publisher')"
            v-model="publisher"
        ></vs-input>
        <vs-input
            class="w-full mb-base"
            icon-pack="feather"
            icon="icon-settings"
            :label-placeholder="$t('geo_region')"
            v-model="geo_region"
        ></vs-input>
        <vs-input
            class="w-full mb-base"
            icon-pack="feather"
            icon="icon-settings"
            :label-placeholder="$t('geo_position')"
            v-model="geo_position"
        ></vs-input>
        <vs-input
            class="w-full mb-base"
            icon-pack="feather"
            icon="icon-settings"
            :label-placeholder="$t('geo_placename')"
            v-model="geo_placename"
        ></vs-input>
        <vs-input
            class="w-full mb-base"
            icon-pack="feather"
            icon="icon-settings"
            :label-placeholder="$t('latitude')"
            v-model="latitude"
        ></vs-input>
        <vs-input
            class="w-full mb-base"
            icon-pack="feather"
            icon="icon-settings"
            :label-placeholder="$t('longitude')"
            v-model="longitude"
        ></vs-input>
        <vs-input
            class="w-full mb-base"
            icon-pack="feather"
            icon="icon-settings"
            :label-placeholder="$t('street_address')"
            v-model="street_address"
        ></vs-input>
        <vs-input
            class="w-full mb-base"
            icon-pack="feather"
            icon="icon-settings"
            :label-placeholder="$t('locality')"
            v-model="locality"
        ></vs-input>
        <vs-input
            class="w-full mb-base"
            icon-pack="feather"
            icon="icon-settings"
            :label-placeholder="$t('country_name')"
            v-model="country_name"
        ></vs-input>
        <vs-input
            class="w-full mb-base"
            icon-pack="feather"
            icon="icon-settings"
            :label-placeholder="$t('postal_code')"
            v-model="postal_code"
        ></vs-input>
        <vs-input
            class="w-full mb-base"
            icon-pack="feather"
            icon="icon-settings"
            :label-placeholder="$t('region')"
            v-model="region"
        ></vs-input>
        <vs-input
            class="w-full mb-base"
            icon-pack="feather"
            icon="icon-settings"
            :label-placeholder="$t('email')"
            v-model="email"
        ></vs-input>
        <vs-input
            class="w-full mb-base"
            icon-pack="feather"
            icon="icon-settings"
            :label-placeholder="$t('phone_number')"
            v-model="phone_number"
        ></vs-input>
        <vs-input
            class="w-full mb-base"
            icon-pack="feather"
            icon="icon-settings"
            :label-placeholder="$t('twitter_site')"
            v-model="twitter_site"
        ></vs-input>

        <p class="text-xs py-2">{{ $t("google_analytic") }}</p>
        <vs-textarea
            class="w-full mb-base"
            icon-pack="feather"
            icon="icon-google"
            :label-placeholder="$t('google_analytic')"
            v-model="google_analytic"
        ></vs-textarea>

        <!-- Save & Reset Button -->
        <div class="flex flex-wrap items-center justify-end">
            <vs-button class="ml-auto mt-2" @click="save_changes"
                >Kaydet</vs-button
            >
            <!--      <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>-->
        </div>
    </vx-card>
</template>

<script>
import setting from "@/store/setting/setting";

export default {
    data() {
        return {
            showPopup: false,
            dataInner: "",
            google_site_verification: "",
            publisher: "",
            geo_region: "",
            geo_position: "",
            geo_placename: "",
            latitude: "",
            longitude: "",
            street_address: "",
            locality: "",
            country_name: "",
            postal_code: "",
            region: "",
            email: "",
            phone_number: "",
            twitter_site: "",
            google_analytic: "",
            settingsDataAll: []
        };
    },
    created() {
        if (!setting.isRegistered) {
            this.$store.registerModule("settings", setting);
            setting.isRegistered = true;
        }
        this.$store.dispatch("settings/fetchItems").then(response => {
            response.data.forEach(element => {
                return (this[element.name] = element.value);
            });
        });
    },
    mounted() {
        this.isMounted = true;
    },
    computed: {
        validateForm() {
            return !this.errors.any();
        },
        settingsData() {
            return this.$store.state.setting.settings;
        }
    },
    methods: {
        embedMediaFromPopup(event) {
            this[this.dataInner] = event;
        },
        embedImage(data) {
            this.dataInner = data;
            this.showPopup = !this.showPopup;
        },
        save_changes() {
            if (!this.validateForm) return;
            const payload = {
                google_site_verification: this.google_site_verification,
                publisher: this.publisher,
                geo_region: this.geo_region,
                geo_position: this.geo_position,
                geo_placename: this.geo_placename,
                latitude: this.latitude,
                longitude: this.longitude,
                street_address: this.street_address,
                locality: this.locality,
                country_name: this.country_name,
                postal_code: this.postal_code,
                region: this.region,
                email: this.email,
                phone_number: this.phone_number,
                twitter_site: this.twitter_site,
                google_analytic: this.google_analytic,

            };
            this.$store
                .dispatch("setting/addItem", payload)
                .then(response => {
                    this.$vs.loading.close();
                    if (response.data)
                        this.$vs.notify({
                            title: "Başarılı",
                            text: "Başarıyla Güncellendi",
                            iconPack: "feather",
                            icon: "icon-alert-circle",
                            color: "success"
                        });
                })
                .catch(error => {
                    this.$vs.loading.close();
                    this.$vs.notify({
                        title: "Hata",
                        text: error.message,
                        iconPack: "feather",
                        icon: "icon-alert-circle",
                        color: "danger"
                    });
                });
        },
        imageUpload(input, type) {
            if (input.target.files && input.target.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    return (this[type] = e.target.result);
                };
                reader.readAsDataURL(input.target.files[0]);
            }
        },
        openFileInput(type) {
            return this.$refs[type].click();
        }
    }
};
</script>
