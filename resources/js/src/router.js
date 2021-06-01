/*=========================================================================================
  File Name: router.js
  Description: Routes for vue-router. Lazy loading is enabled.
  Object Strucutre:
                    path => router path
                    name => router name
                    component(lazy loading) => component to load
                    meta : {
                      rule => which user can have access (ACL)
                      breadcrumb => Add breadcrumb to specific page
                      pageTitle => Display title besides breadcrumb
                    }
  ----------------------------------------------------------------------------------------


  Author URL: https:dijitalreklam.org
==========================================================================================*/


import Vue from 'vue'
import Router from 'vue-router'


Vue.use(Router)

const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    scrollBehavior() {
        return {
            x: 0,
            y: 0
        }
    },
    routes: [

        {
            // =============================================================================
            // MAIN LAYOUT ROUTES
            // =============================================================================
            path: '',
            component: () => import('./layouts/main/Main.vue'),
            children: [
                // =============================================================================
                // Theme Routes
                // =============================================================================

                {
                    path: '/',
                    redirect: '/panel/user-dashboard'
                },
                {
                    path: '/panel/user-dashboard',
                    name: 'user.dashboard',
                    component: () => import('./views/UserDashboard.vue'),
                    meta: {
                        rule: 'user'

                    }
                },
                {
                    path: '/panel/admin-dashboard',
                    name: 'admin.dashboard',
                    component: () => import('./views/AdminDashboard.vue'),
                    meta: {
                        rule: 'admin'

                    }
                },
                {
                    path: '/panel/ecommerce-dashboard',
                    name: 'ecommerce.dashboard',
                    component: () => import('./views/EcommerceDashboard.vue'),
                    meta: {
                        rule: 'admin'

                    }
                },

                // =============================================================================
                //                        USER CONTENT PAGES
                // =============================================================================




                {
                    path: '/panel/file-manager-list',
                    name: 'FileList',
                    component: () => import('@/components/global/file-manager/FileManagerList.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Anasayfa',
                                url: '/'
                            },
                            {
                                title: 'FileList'
                            },
                            {
                                title: 'List',
                                active: true
                            }
                        ],
                        pageTitle: 'FileList',
                        rule: 'admin'
                    }
                },


                ///////////////////////   USER CONTENT PAGES - END  /////////////////////////////


                // =============================================================================
                //                        ADMIN CONTENT PAGES
                // =============================================================================

                // ============================
                // =======SITE SETTINGS========
                // ============================
                {
                    path: '/panel/settings',
                    name: 'settings',
                    component: () => import('@/views/pages/admin/site-settings/component/component-settings.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Anasayfa',
                                url: '/'
                            },
                            {
                                title: 'settings'
                            },
                            {
                                title: 'List',
                                active: true
                            }
                        ],
                        pageTitle: 'settings',
                        rule: 'admin'
                    }
                },


                // ============================
                // =======POST & PAGE========
                // ============================

                {
                    path: '/panel/pages',
                    name: 'pages',
                    component: () => import('@/views/pages/admin/content/page/pageList.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Anasayfa',
                                url: '/'
                            },
                            {
                                title: 'Pages'
                            },
                            {
                                title: 'List',
                                active: true
                            }
                        ],
                        pageTitle: 'Pages',
                        rule: 'admin'
                    }
                },
                {
                    path: '/panel/posts',
                    name: 'posts',
                    component: () => import('@/views/pages/admin/content/post/postList.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Anasayfa',
                                url: '/'
                            },
                            {
                                title: 'Posts'
                            },
                            {
                                title: 'List',
                                active: true
                            }
                        ],
                        pageTitle: 'Posts',
                        rule: 'admin'
                    }
                }, // FOR USERS & ADMIN
                {
                    path: '/panel/packages',
                    name: 'packages',
                    component: () => import('@/views/pages/admin/content/package/list.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'HomePage',
                                url: '/'
                            },
                            {
                                title: 'Packages'
                            },
                            {
                                title: 'List',
                                active: true
                            }
                        ],
                        pageTitle: 'Packages',
                        rule: 'admin'
                    }
                },
                {
                    path: '/panel/blog-posts',
                    name: 'blog-posts',
                    component: () => import('@/views/pages/user/blog-post/postList.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Anasayfa',
                                url: '/'
                            },
                            {
                                title: 'Posts'
                            },
                            {
                                title: 'List',
                                active: true
                            }
                        ],
                        pageTitle: 'Posts',
                        rule: 'user'
                    }
                }, // FOR USERS & ADMIN
                {
                    path: '/panel/services',
                    name: 'services',
                    component: () => import('@/views/pages/admin/content/service/services.vue'),
                    meta: {
                        pageTitle: 'services',
                        rule: 'admin'
                    }
                },
                {
                    path: '/panel/portfolios',
                    name: 'portfolios',
                    component: () => import('@/views/pages/admin/content/portfolio/portfolioList.vue'),
                    meta: {
                        pageTitle: 'portfolios',
                        rule: 'admin'
                    }
                },
                {
                    path: '/panel/categories',
                    name: 'categories',
                    component: () => import('@/views/pages/admin/content/category/categoryList.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Anasayfa',
                                url: '/'
                            },
                            {
                                title: 'Categories'
                            },
                            {
                                title: 'List',
                                active: true
                            }
                        ],
                        pageTitle: 'Categories',
                        rule: 'admin'
                    }
                },
                {
                    path: '/panel/forms',
                    name: 'Forms',
                    component: () => import('@/views/pages/admin/content/form/list/formList.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Anasayfa',
                                url: '/'
                            },
                            {
                                title: 'Forms'
                            },
                            {
                                title: 'List',
                                active: true
                            }
                        ],
                        pageTitle: 'Forms',
                        rule: 'admin'
                    }
                },

                // {
                //   path: '/panel/packages',
                //   name: 'packages',
                //   component: () => import('@/views/pages/admin/e-commer/package/list.vue'),
                //   meta: {
                //     breadcrumb: [
                //       {title: 'HomePage', url: '/'},
                //       {title: 'Packages'},
                //       {title: 'List', active: true}
                //     ],
                //     pageTitle: 'Packages',
                //     rule: 'admin'
                //   }
                // },

                ////////////////////ECOMMERCE
                {
                    path: '/panel/products',
                    name: 'products',
                    component: () => import('@/views/pages/admin/e-commerce/product/productList.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Anasayfa',
                                url: '/'
                            },
                            {
                                title: 'Products'
                            },
                            {
                                title: 'List',
                                active: true
                            }
                        ],
                        pageTitle: 'Products',
                        rule: 'admin'
                    }
                },
                {
                    path: '/panel/orders',
                    name: 'orders',
                    component: () => import('@/views/pages/admin/e-commerce/order/orderList.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'HomePage',
                                url: '/'
                            },
                            {
                                title: 'Orders'
                            },
                            {
                                title: 'List',
                                active: true
                            }
                        ],
                        pageTitle: 'Orders',
                        rule: 'admin'
                    }
                },
                {
                    path: '/panel/payments',
                    name: 'payments',
                    component: () => import('@/views/pages/admin/e-commerce/payment/paymentList.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'HomePage',
                                url: '/'
                            },
                            {
                                title: 'Payments'
                            },
                            {
                                title: 'List',
                                active: true
                            }
                        ],
                        pageTitle: 'payments',
                        rule: 'admin'
                    }
                },

                {
                    path: '/panel/front-side-language',
                    name: 'front-side-language',
                    component: () => import('@/views/pages/admin/language/FrontSideLanguage.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'language'
                            },
                        ],
                        pageTitle: 'Front Side Edit',
                        rule: 'admin'

                    }
                },
                {
                    path: '/panel/back-side-language',
                    name: 'back-side-language',
                    component: () => import('@/views/pages/admin/language/BackSideLanguage.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'language'
                            },
                        ],
                        pageTitle: 'Back Side Edit',
                        rule: 'admin'

                    }
                },

                // ============================
                // ==========USERS=============
                // ============================
                {
                    path: '/panel/users',
                    name: 'users',
                    component: () => import('@/views/pages/admin/users/user-list/UserList.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'Users'
                            },
                            {
                                title: 'List',
                                active: true
                            }
                        ],
                        pageTitle: 'Users',
                        rule: 'admin'

                    }
                },
                {
                    path: '/panel/users/user-view/:userId',
                    name: 'app-user-view',
                    component: () => import('@/views/pages/admin/users/UserView.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'User'
                            },
                            {
                                title: 'View',
                                active: true
                            }
                        ],
                        pageTitle: 'User View',
                        rule: 'admin'

                    }
                },
                {
                    path: '/panel/users/edit/:userId',
                    name: 'user-edit',
                    component: () => import('@/views/pages/admin/users/user-edit/UserEdit.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'User'
                            },
                            {
                                title: 'Edit',
                                active: true
                            }
                        ],
                        pageTitle: 'User Edit',
                        rule: 'admin'

                    }
                },

                ///////////////////////   ADMIN CONTENT PAGES - END  /////////////////////////////


                // =============================================================================
                //                        COMMON PAGES
                // =============================================================================

                {
                    path: '/panel/profile',
                    name: 'user-settings',
                    component: () => import('@/views/pages/common/user-settings/UserSettings.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Homepage',
                                url: '/'
                            },
                            {
                                title: 'UserSettings',
                                active: true
                            }
                        ],
                        pageTitle: 'UserSettings',
                        rule: 'common'


                    }
                }

                ///////////////////////   COMMON PAGES - END  /////////////////////////////


            ]
        },
        // =============================================================================
        // FULL PAGE LAYOUTS
        // =============================================================================
        {
            path: '',
            component: () => import('@/layouts/full-page/FullPage.vue'),
            children: [
                // =============================================================================
                // PAGES
                // =============================================================================

                {
                    path: '/panel/login',
                    name: 'login',
                    component: () => import('@/views/pages/common/auth/login/Login.vue'),
                    meta: {
                        rule: 'guest'
                    }
                },
                {
                    path: '/panel/register',
                    name: 'register',
                    component: () => import('@/views/pages/common/auth/register/Register.vue'),
                    meta: {
                        rule: 'guest'
                    }
                },

                {
                    path: '/panel/email/verify/:id',
                    name: 'verification.verify',
                    component: () => import('@/views/pages/common/auth/verification/verify.vue'),
                    meta: {
                        rule: 'guest'
                    }
                },
                {
                    path: '/panel/email/resend',
                    name: 'verification.resend',
                    component: () => import('@/views/pages/common/auth/verification/resend.vue'),
                    meta: {
                        rule: 'guest'


                    }
                },
                {
                    path: '/panel/password/email',
                    name: 'password.email',
                    component: () => import('@/views/pages/common/auth/password/email.vue'),
                    meta: {
                        rule: 'guest'

                    }
                },
                {
                    path: '/panel/password/reset',
                    name: 'password.reset',
                    component: () => import('@/views/pages/common/auth/password/reset.vue'),
                    meta: {
                        rule: 'guest'
                    }
                },

                {
                    path: '/panel/comingsoon',
                    name: 'page-coming-soon',
                    component: () => import('@/views/pages/common/errors/ComingSoon.vue'),
                    meta: {
                        rule: 'user'
                    }
                },
                {
                    path: '/panel/404',
                    name: '404',
                    component: () => import('@/views/pages/common/errors/Error404.vue'),
                    meta: {
                        rule: '*'
                    }
                },
                {
                    path: '/panel/error-500',
                    name: 'page-error-500',
                    component: () => import('@/views/pages/common/errors/Error500.vue'),
                    meta: {
                        rule: '*'
                    }
                },
                {
                    path: '/panel/not-authorized',
                    name: 'page-not-authorized',
                    component: () => import('@/views/pages/common/errors/NotAuthorized.vue'),
                    meta: {
                        rule: '*'
                    }
                },
                {
                    path: '/panel/maintenance',
                    name: 'page-maintenance',
                    component: () => import('@/views/pages/common/errors/Maintenance.vue'),
                    meta: {
                        rule: '*'
                    }
                }
            ]
        },
        // Redirect to 404 page, if no match found
        {
            path: '*',
            redirect: '/404'
        }
    ]
})

router.afterEach(() => {
    // Remove initial loading
    const appLoading = document.getElementById('loading-bg')
    if (appLoading) {
        appLoading.style.display = 'none'
    }
})


export default router
