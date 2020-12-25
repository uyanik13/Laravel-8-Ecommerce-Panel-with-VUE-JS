<template>
  <vs-tabs  :position="isSmallerScreen ? 'top' : 'top'" class="tabs-shadow-none" id="profile-tabs" :key="isSmallerScreen">

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

    <!-- <vs-tab icon-pack="feather"  icon="icon-info" :label="!isSmallerScreen ? $t('Info') : ''">
      <div class="tab-info md:ml-4 md:mt-10 mt-4 ml-0">
        <user-settings-info
          v-if="upgradePackage_remaining_days !== 'NoSubscripton'"
          :user="activeUser"
           />

          <user-settings-get-premium v-else />

      </div>
    </vs-tab> -->
    <!-- <vs-tab icon-pack="feather" icon="icon-octagon" :label="!isSmallerScreen ? $t('CV_Education_Work') : ''">
      <div class="tab-info md:ml-4 md:mt-10 mt-4 ml-0">
        <user-settings-cv-edu
         v-if="upgradePackage_remaining_days !== 'NoSubscripton'"
          :user="activeUser" />
          <user-settings-get-premium v-else />
      </div>
    </vs-tab> -->

    <!-- <vs-tab icon-pack="feather" icon="icon-github" :label="!isSmallerScreen ? $t('SocialLinks') : ''">
      <div class="tab-social-links md:ml-4 md:mt-10 mt-4 ml-0">
        <user-settings-social-links v-if="upgradePackage_remaining_days !== 'NoSubscripton'" :user="activeUser"  />
        <user-settings-get-premium v-else />
      </div>
    </vs-tab> -->

    <!-- <vs-tab icon-pack="feather" icon="icon-bell" :label="!isSmallerScreen ?  $t('Notifications') : ''">
      <div class="tab-text md:ml-4 md:mt-10 mt-4 ml-0">
        <user-settings-notifications :user="activeUser"  v-if="upgradePackage_remaining_days !== 'NoSubscripton'" />
         <user-settings-get-premium v-else />
      </div>
    </vs-tab> -->

    <!-- <vs-tab icon-pack="feather" icon="icon-check" :label="!isSmallerScreen ? $t('VerifyAccount') : ''">
      <div class="tab-text md:ml-4 md:mt-10 mt-4 ml-0">
        <user-settings-verify-account v-if="upgradePackage_remaining_days !== 'NoSubscripton'" :user="activeUser" />
          <user-settings-get-premium v-else :user="activeUser" />
      </div>
    </vs-tab>

    <vs-tab icon-pack="feather" icon="icon-credit-card" :label="!isSmallerScreen ? $t('BankInfo') : ''">
      <div class="tab-text md:ml-4 md:mt-10 mt-4 ml-0">
        <user-settings-bank-info v-if="upgradePackage_remaining_days !== 'NoSubscripton'" :user="activeUser" />
          <user-settings-get-premium v-else :user="activeUser" />
      </div>
    </vs-tab> -->


  </vs-tabs>


</template>

<script>
import UserSettingsBankInfo from './UserSettingsBankInfo.vue'
import UserSettingsLegal from './UserSettingsLegal.vue'
import UserSettingsVerifyAccount from './UserSettingsVerifyAccount.vue'
import UserSettingsGeneral from './UserSettingsGeneral.vue'
import UserSettingsGetPremium from './UserSettingsGetPremium.vue'
import UserSettingsCvEdu from './UserSettingsCvEdu.vue'
import UserSettingsChangePassword from './UserSettingsChangePassword.vue'
import UserSettingsInfo from './UserSettingsInfo.vue'
import UserSettingsSocialLinks from './UserSettingsSocialLinks.vue'
import UserSettingsConnections from './UserSettingsConnections.vue'
import UserSettingsNotifications from './UserSettingsNotifications.vue'
import userManagement from '@/store/user-management/moduleUserManagement'

export default {
  components: {
    UserSettingsBankInfo,
    UserSettingsLegal,
    UserSettingsGetPremium,
    UserSettingsCvEdu,
    UserSettingsVerifyAccount,
    UserSettingsGeneral,
    UserSettingsInfo,
    UserSettingsChangePassword,
    UserSettingsSocialLinks,
    UserSettingsConnections,
    UserSettingsNotifications
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
