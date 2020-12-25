<template>
  <vs-tabs v-show="activeUser.type === 'company'" :position="isSmallerScreen ? 'top' : 'top'" class="tabs-shadow-none" id="profile-tabs" :key="isSmallerScreen">

    <!-- GENERAL -->
    <vs-tab icon-pack="feather" icon="icon-user" :label="!isSmallerScreen ? $t('Account') : ''">
      <div class="tab-general md:ml-4 md:mt-10 mt-4 ml-0">
        <user-settings-general />
      </div>
    </vs-tab>

     <vs-tab icon-pack="feather" icon="icon-lock" :label="!isSmallerScreen ? $t('PasswordManagement') : ''">
      <div class="tab-change-pwd md:ml-4 md:mt-10 mt-4 ml-0">
        <user-settings-change-password />
      </div>
    </vs-tab>


    <vs-tab icon-pack="feather" icon="icon-anchor" :label="!isSmallerScreen ? $t('Company') : ''">
      <div class="tab-text md:ml-4 md:mt-10 mt-4 ml-0">
        <user-settings-company
        v-if="upgradePackage_remaining_days
         !== 'NoSubscripton'" :user="activeUser" />
         <user-settings-company-free v-else :user="activeUser" />
          <user-settings-get-premium v-show="upgradePackage_remaining_days === 'NoSubscripton'" :user="activeUser"/>
      </div>
    </vs-tab>

    <vs-tab icon-pack="feather" icon="icon-check" :label="!isSmallerScreen ? $t('VerifyAccount') : ''">
      <div class="tab-text md:ml-4 md:mt-10 mt-4 ml-0">
        <user-settings-verify-account v-if="upgradePackage_remaining_days !== 'NoSubscripton'" :user="activeUser" />
          <user-settings-get-premium v-else :user="activeUser" />
      </div>
    </vs-tab>

     <vs-tab icon-pack="feather" icon="credit-card" :label="!isSmallerScreen ? $t('BankInfo') : ''">
      <div class="tab-text md:ml-4 md:mt-10 mt-4 ml-0">
        <user-settings-bank-info v-if="upgradePackage_remaining_days !== 'NoSubscripton'" :user="activeUser" />
          <user-settings-get-premium v-else :user="activeUser" />
      </div>
    </vs-tab>


  </vs-tabs>
</template>

<script>
import UserSettingsGeneral from './UserSettingsGeneral.vue'
import UserSettingsBankInfo from './UserSettingsBankInfo.vue'
import UserSettingsGetPremium from './UserSettingsGetPremium.vue'
import UserSettingsCompany from './UserSettingsCompany.vue'
import UserSettingsCompanyFree from './UserSettingsCompanyFree.vue'
import UserSettingsChangePassword from './UserSettingsChangePassword.vue'
import userManagement from '@/store/user-management/moduleUserManagement'
import UserSettingsVerifyAccount from './UserSettingsVerifyAccount.vue'

export default {
  components: {
     UserSettingsBankInfo,
    UserSettingsVerifyAccount,
    UserSettingsGetPremium,
    UserSettingsCompanyFree,
    UserSettingsCompany,
    UserSettingsGeneral,
    UserSettingsChangePassword,

  },
  data () {
    return {

    }
  },
  computed: {
    isSmallerScreen () {
      return this.$store.state.windowWidth < 768
    },
    upgradePackage_remaining_days () {
      return this.$store.state.user.upgradePackage_remaining_days
    },
    activeUser () {
      return this.$store.state.auth.user
    }

  },
  created () {
    if (!userManagement.isRegistered) {
      this.$store.registerModule('userManagement', userManagement)
      userManagement.isRegistered = true
    }
    //this.$store.dispatch('user/fetchUser')
    //this.$store.dispatch('user/fetchPackageInformation')
  }
}
</script>

<style lang="scss">
#profile-tabs {
  .vs-tabs--content {
    padding: 0;
  }
}
</style>
