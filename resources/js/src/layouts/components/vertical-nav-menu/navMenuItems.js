
export default [

  {
    url: '/panel/user-dashboard',
    slug: '/panel/user-dashboard',
    name: 'user.dashboard',
    // tag: "2",
    // tagColor: "warning",
    icon: 'HomeIcon',
    i18n: 'UserDashboard'
  },
  {
    url: '/panel/admin-dashboard',
    slug: '/panel/admin-dashboard',
    name: 'admin.dashboard',
    // tag: "2",
    // tagColor: "warning",
    icon: 'HomeIcon',
    i18n: 'AdminDashboard'
  },
  {
    url: '/panel/ecommerce-dashboard',
    slug: '/panel/ecommerce-dashboard',
    name: 'ecommerce.dashboard',
     //tag: "2",
     //tagColor: "warning",
    icon: 'ShoppingCartIcon',
    i18n: 'EcommerceDashboard'
  },
  {
    header: 'Menu',
    icon: 'PackageIcon',
    i18n: 'Menu',
    rule:'admin',
    items: [
      {
        url:'/panel/settings',
        slug: '/panel/settings',
        name: 'settings',
        icon: 'SettingsIcon',
        i18n: 'settings'
      },
      {
        url: '/panel/users',
        slug: '/panel/users',
        name: 'Users',
        icon: 'UserIcon',
        i18n: 'Users'
      }

    ]
  },
  {
    url: '/panel/packages',
    slug: '/panel/packages',
    name: 'packages',
    icon: 'PackageIcon',
    i18n: 'Packages'
  },
    {
    url: '/panel/file-manager-list',
    slug: '/panel/file-manager-list',
    name: 'FileList',
    icon: 'UploadIcon',
    i18n: 'FileManager',
  },
  //admin
  {
    url: '/panel/pages',
    name: 'pages',
    icon: 'FileIcon',
    i18n: 'Content',
    submenu:[
      {
        url:'/panel/pages',
        slug: '/panel/pages',
        name: 'pages',
        icon: 'FileIcon',
        i18n: 'Pages'
      },
      {
        url:'/panel/posts',
        slug: '/panel/posts',
        name: 'posts',
        icon: 'FileTextIcon',
        i18n: 'Posts'
      },
      {
        url:'/panel/services',
        slug: '/panel/services',
        name: 'services',
        icon: 'FileTextIcon',
        i18n: 'services'
      },
      {
        url:'/panel/portfolios',
        slug: '/panel/portfolios',
        name: 'portfolios',
        icon: 'FileTextIcon',
        i18n: 'portfolios'
      },
      {
        url:'/panel/categories',
        slug: '/panel/categories',
        name: 'Categories',
        icon: 'PauseIcon',
        i18n: 'Categories'
      },
      {
        url:'/panel/forms',
        slug: '/panel/forms',
        name: 'Forms',
        icon: 'PauseIcon',
        i18n: 'Forms'
      }
    ]
  },
  {
    url:'/panel/products',
    name: 'products',
    icon: 'ShoppingCartIcon',
    i18n: 'ECommerce',
    submenu:[
      {
        url:'/panel/products',
        slug: '/panel/products',
        name: 'products',
        icon: 'FileTextIcon',
        i18n: 'Products'
      },
      {
        url: '/panel/orders',
        slug: '/panel/orders',
        name: 'orders',
        icon: 'PackageIcon',
        i18n: 'Orders'
      },
      {
        url: '/panel/payments',
        slug: '/panel/payments',
        name: 'payments',
        icon: 'PackageIcon',
        i18n: 'payments'
      }

    ]
  },
    //user
  {
    url: '/panel/blog-posts',
    name: 'blog-posts',
    icon: 'FileIcon',
    i18n: 'Content',
    submenu:[

      {
        url:'/panel/blog-posts',
        slug: '/panel/blog-posts',
        name: 'blog-posts',
        icon: 'FileTextIcon',
        i18n: 'Posts'
      },
    ]
  },
  {
    url:'/panel/front-side-language',
    name: 'front-side-language',
    icon: 'GlobeIcon',
    i18n: 'language',
    submenu:[
      {
        url:'/panel/front-side-language',
        slug: '/panel/front-side-language',
        name: 'front-side-language',
        icon: 'FileIcon',
        i18n: 'frontSideLanguage'
      },
      {
        url:'/panel/back-side-language',
        slug: '/panel/back-side-language',
        name: 'back-side-language',
        icon: 'FileTextIcon',
        i18n: 'backSideLanguage'
      },

    ]
  },



]
