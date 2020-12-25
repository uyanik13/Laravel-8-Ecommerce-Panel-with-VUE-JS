<!-- =========================================================================================
    File Name: ChatLog.vue
    Description: Chat Application - Log of chat
    ----------------------------------------------------------------------------------------

      
    
========================================================================================== -->

<template>
      <div id="component-chat-log" class="m-8" v-if="chatData">
        <div v-for="(msg, index) in chatData" class="msg-grp-container" :key="index">

            <!-- If previous msg is older than current time -->
            <template v-if="chatData[index-1]">
                <vs-divider v-if="!isSameDay(msg.created_at, chatData[index-1].created_at)" class="msg-time">
                    <span>{{ toDate(msg.created_at) }}</span>
                </vs-divider>
                <div class="spacer mt-8" v-if="!hasSentPreviousMsg(chatData[index-1].from, msg.from)"></div>
            </template>


            <div class="flex items-start" :class="[{'flex-row-reverse' : msg.to === userId}]">
                <template v-if="chatData[index-1]">
                    <template v-if="(!hasSentPreviousMsg(chatData[index-1].from, msg.from) || !isSameDay(msg.created_at, chatData[index-1].created_at))">
                        <vs-avatar size="40px" class="border-2 shadow border-solid border-white m-0 flex-shrink-0"
                                   :class="msg.to === userId ? 'sm:ml-5 ml-3' : 'sm:mr-5 mr-3'"
                                   :src="msg.to === userId ? activeUser.avatar : userDetails.avatar"></vs-avatar>
                    </template>
                </template>

                <template v-if="index == 0">
                    <vs-avatar    size="40px" class="border-2 shadow border-solid border-white m-0 flex-shrink-0"
                                  :class="msg.to === userId ? 'sm:ml-5 ml-3' : 'sm:mr-5 mr-3'"
                                  :src="msg.to === userId ? activeUser.avatar : userDetails.avatar"></vs-avatar>
                </template>

                <template v-if="chatData[index-1]">
                    <div class="mr-16" v-if="!(!hasSentPreviousMsg(chatData[index-1].from, msg.from) || !isSameDay(msg.created_at, chatData[index-1].created_at))"></div>
                </template>

                <div class="msg break-words relative shadow-md rounded py-3 px-4 mb-2 rounded-lg max-w-sm" :class="msg.to === userId ? 'bg-primary-gradient text-white': 'border border-solid border-transparent bg-white'">
                    <span>{{ msg.msg }}</span>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default{
  props: ['userId', 'activeUser', 'userDetails'],
  data () {
    return {

    }
  },
  computed: {
    chatData () {
      return this.$store.getters['chat/chatOrdered'](this.userId)
    },
    hasSentPreviousMsg () {
      return (last_sender, current_sender) => last_sender === current_sender
    }
  },
  methods: {
    isSameDay (time_to, time_from) {
      const date_time_to = new Date(Date.parse(time_to))
      const date_time_from = new Date(Date.parse(time_from))
      return date_time_to.getFullYear() === date_time_from.getFullYear() &&
                date_time_to.getMonth() === date_time_from.getMonth() &&
                date_time_to.getDate() === date_time_from.getDate()
    },
    toDate (time) {
      const locale = 'en-us'
      const date_obj = new Date(Date.parse(time))
      const monthName = date_obj.toLocaleString(locale, {
        month: 'short'
      })
      return `${date_obj.getDate()  } ${ monthName}`
    },
    scrollToBottom () {
      this.$nextTick(() => {
        this.$parent.$el.scrollTop = this.$parent.$el.scrollHeight
      })
    }
  },
  updated () {
    this.scrollToBottom()
  },
  mounted () {
    this.scrollToBottom()
  }
}
</script>

