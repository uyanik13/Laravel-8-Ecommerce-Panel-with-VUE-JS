<template>
  <vx-card no-shadow>

    <p v-if="debtIncOrDec" class="text-lg font-medium mb-2 mt-4 sm:mt-0">Normal Ücret : 49.99₺ Öde  </p>
    <p v-else class="text-lg font-medium mb-2 mt-4 sm:mt-0">Borç Düş </p>


    <vs-switch v-model="debtIncOrDec" />

    <vs-input class="w-full my-base" label-placeholder="Bize Destek Olabileceğiniz Rakam" name="price" v-model="price"></vs-input>

    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2" @click="save_changes">49.99₺ Öde</vs-button>
    </div>
  </vx-card>
</template>

<script>
  import axios from 'axios';
export default {
  created() {
    axios.get("/api/user")
      .then((response) => { this.currentUserData = response.data })
      .catch((error) => { console.log(error) })
    //console.log('PHOTOURL',this.photo_url)
  },
  data() {
    return {
      debtIncOrDec : true,
      price : 49.99
    }
  },
  computed: {
    validateForm() {
      return !this.errors.any()
    },
  },
  methods:{
    save_changes() {
      if(!this.validateForm) return
      const payload = {
        price: this.price,
      }
      this.$store.dispatch('user/updateUser',payload)
        .then((response) => { this.$vs.loading.close()
          if(response.data)
            this.$vs.notify({
              title: 'Success',
              text: 'Succesfully updated',
              iconPack: 'feather',
              icon: 'icon-alert-circle',
              color: 'success'
            })
        })
        .catch(error => {
          this.$vs.loading.close()
          this.$vs.notify({
            title: 'Error',
            text: error.message,
            iconPack: 'feather',
            icon: 'icon-alert-circle',
            color: 'danger'
          })
        })

    },

    reset_data() {
      this.data_local = JSON.parse(JSON.stringify(this.data))
    },
    update_avatar(input) {
      if (input.target.files && input.target.files[0]) {
            var reader = new FileReader()
            reader.onload = e => {
              this.photo_url = e.target.result
              //console.log('IMAGEURL',e.target.result)
            }
            reader.readAsDataURL(input.target.files[0])
          }
    },

  }
}
</script>
