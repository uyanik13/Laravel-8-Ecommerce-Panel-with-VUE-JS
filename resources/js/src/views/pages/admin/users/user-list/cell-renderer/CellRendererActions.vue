<template>
    <div :style="{'direction': $vs.rtl ? 'rtl' : 'ltr'}">
      <feather-icon icon="Edit3Icon" svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer" @click="editRecord" />
      <feather-icon icon="Trash2Icon" svgClasses="h-5 w-5 hover:text-danger cursor-pointer" @click="confirmDeleteRecord" />
    </div>
</template>

<script>
    import Cookies from "js-cookie";
    import i18n from "@/i18n/i18n";
    export default {
        name: 'CellRendererActions',
        methods: {
          editRecord() {
            this.$router.push("/panel/users/edit/" + this.params.data.id).catch(() => {})

            /*
              this.$router.push("/apps/user/user-edit/" + this.params.data.id).catch(() => {})
            */
          },
          confirmDeleteRecord() {
            this.$vs.dialog({
              type: 'confirm',
              color: 'danger',
              title: i18n.t('areYouSureToDeleteThis'),
              text: `${i18n.t('areYouSureToDeleteThis')} "${this.params.data.name}"`,
              accept: this.deleteRecord,
              acceptText: i18n.t('Delete')
            })
          },
          deleteRecord() {
            /* UnComment below lines for enabling true flow if deleting user */
            this.$store.dispatch("userManagement/removeRecord", this.params.data.id)
              .then(()   => { this.showDeleteSuccess() })
              .catch(err => { console.error(err)       })
          },
          showDeleteSuccess() {
            this.$vs.notify({
              color: 'success',
              title: i18n.t('content_deleted'),
              text: i18n.t('selected_content_deleted'),
            })
          }
        }
    }
</script>
