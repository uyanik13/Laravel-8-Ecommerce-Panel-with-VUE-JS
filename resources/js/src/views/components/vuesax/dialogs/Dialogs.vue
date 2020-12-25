<!-- =========================================================================================
    File Name: Dialogs.vue
    Description: Dialogs - Imports all page portions
    ----------------------------------------------------------------------------------------

      
    
========================================================================================== -->


<template>
    <div id="dialog-demo">
        <dialogs-alert></dialogs-alert>
        <dialogs-confirm></dialogs-confirm>
        <dialogs-prompt></dialogs-prompt>
    </div>
</template>

<script>
import DialogsAlert from './DialogsAlert.vue'
import DialogsConfirm from './DialogsConfirm.vue'
import DialogsPrompt from './DialogsPrompt.vue'

export default{
  components: {
    DialogsAlert,
    DialogsConfirm,
    DialogsPrompt
  }
}
</script>
