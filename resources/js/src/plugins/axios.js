import store from '@/store/store.js'
import router from '@/router'
import i18n from '@/i18n/i18n'
import axios from 'axios'
import Api from './api'
import Cookies from 'js-cookie'
import Swal from 'sweetalert2'

//axios.defaults.baseURL = process.env.APP_URL
axios.defaults.headers = { Accept: 'application/json' }
axios.defaults.headers = { Locale: i18n.locale }

const subscribers = []
let isRefreshing = false
let loginRequired = false

function onAccessTokenFetched(accessToken) {
    subscribers.map(callback => callback(accessToken))
}

function addSubscriber(callback) {
    subscribers.push(callback)
}

axios.interceptors.response.use(function(response) {
    return response

}, error => {
    const { config, response: { status } } = error
    const originalRequest = config
    if (status === 401 && error.response.data.token_invalid === true && originalRequest.url !== '/api/login' && originalRequest.url !== '/api/logout') {
        if (!loginRequired) {
            loginRequired = true
            Swal.fire({
                type: 'warning',
                title: i18n.t('token_expired_alert_title'),
                text: i18n.t('token_expired_alert_text'),
                reverseButtons: true,
                confirmButtonText: i18n.t('ok')
            }).then((res) => {
                Api.clearCreds()
                router.push({ path: '/panel/login', query: { sessionExpired: 1 } })
            }).catch((error) => {
                console.log('ERROR:', error)
            })

        }

    }
    if (status === 401 && error.response.data.token_expired === true && originalRequest.url !== '/api/login' && originalRequest.url !== '/api/logout') {
        if (!isRefreshing) {
            isRefreshing = true
            store.dispatch('auth/refreshToken').then((response) => {
                if (!response) return
                    //Api.get(originalRequest.url)
                const access_token = response
                isRefreshing = false
                if (access_token) {
                    Api.setToken(access_token)
                } else if (!access_token || access_token === '') {
                    originalRequest.headers.Authorization = 'Bearer TokenNotFound'
                }
                onAccessTokenFetched(access_token)
            }).catch((e) => {
                //console.log(e)
            })
        }

        return new Promise((resolve) => {
            addSubscriber(accessToken => {
                originalRequest.headers.Authorization = `Bearer ${  accessToken}`
                Api.setToken(accessToken)
                resolve(axios(originalRequest))
            })
        })
    }


    return Promise.reject(error)
})


export default axios