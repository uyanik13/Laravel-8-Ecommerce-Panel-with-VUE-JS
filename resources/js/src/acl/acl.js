import Vue from 'vue'
import {AclInstaller, AclCreate, AclRule } from 'vue-acl'
Vue.use(AclInstaller)
import router from '@/router'
let initialRole = 'guest'
import Cookies from 'js-cookie'
import store from '@/store/store.js'

const userInfo = Cookies.get('user') ? JSON.parse(Cookies.get('user')) : null
if (userInfo && userInfo.role) initialRole = userInfo.role


export default new AclCreate({


    initial: initialRole,
    notfound: '/panel/login',
    router,
    acceptLocalRules: true,
    globalRules: {
        admin: new AclRule('admin').generate(),
        user: new AclRule('user').generate(),
        common: new AclRule('user').or('admin').generate(),
        guest: new AclRule('guest').generate()
        // public: new AclRule("public").or("admin").or("editor").generate(),
    }
//   middleware: async acl => {
//     axios.get('/api/user')
//       .then((response) => {
//         console.log('user', response.data)
//         userInfo = response.data
//         acl.change(response.data.role)
//       })
//   }


})
