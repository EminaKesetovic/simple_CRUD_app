const Welcome = () => import('./components/Welcome.vue' /* webpackChunkName: "resource/js/components/welcome" */)

const CityList = () => import('./components/city/List.vue' /* webpackChunkName: "resource/js/components/city/list" */)
const CityCreate = () => import('./components/city/Add.vue' /* webpackChunkName: "resource/js/components/city/add" */)
const CityEdit = () => import('./components/city/Edit.vue' /* webpackChunkName: "resource/js/components/city/edit" */)

const ContactTypeList = () => import('./components/contact_type/List.vue' /* webpackChunkName: "resource/js/components/contact_type/list" */)
const ContactTypeCreate = () => import('./components/contact_type/Add.vue' /* webpackChunkName: "resource/js/components/contact_type/add" */)
const ContactTypeEdit = () => import('./components/contact_type/Edit.vue' /* webpackChunkName: "resource/js/components/contact_type/edit" */)

const CountryList = () => import('./components/country/List.vue' /* webpackChunkName: "resource/js/components/country/list" */)
const CountryCreate = () => import('./components/country/Add.vue' /* webpackChunkName: "resource/js/components/country/add" */)
const CountryEdit = () => import('./components/country/Edit.vue' /* webpackChunkName: "resource/js/components/country/edit" */)

const IndustryTypeList = () => import('./components/industry_type/List.vue' /* webpackChunkName: "resource/js/components/industry_type/list" */)
const IndustryTypeCreate = () => import('./components/industry_type/Add.vue' /* webpackChunkName: "resource/js/components/industry_type/add" */)
const IndustryTypeEdit = () => import('./components/industry_type/Edit.vue' /* webpackChunkName: "resource/js/components/industry_type/edit" */)

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Welcome
    },
    {
        name: 'cityList',
        path: '/city',
        component: CityList
    },
    {
        name: 'cityEdit',
        path: '/city/:id/edit',
        component: CityEdit
    },
    {
        name: 'cityAdd',
        path: '/city/add',
        component: CityCreate
    },

    {
        name: 'contactTypeList',
        path: '/contact_type',
        component: ContactTypeList
    },
    {
        name: 'contactTypeEdit',
        path: '/contact_type/:id/edit',
        component: ContactTypeEdit
    },
    {
        name: 'contactTypeAdd',
        path: '/contact_type/add',
        component: ContactTypeCreate
    },

    {
        name: 'countryList',
        path: '/country',
        component: CountryList
    },
    {
        name: 'countryEdit',
        path: '/country/:id/edit',
        component: CountryEdit
    },
    {
        name: 'countryAdd',
        path: '/country/add',
        component: CountryCreate
    },

    {
        name: 'industryTypeList',
        path: '/industry_type',
        component: IndustryTypeList
    },
    {
        name: 'industryTypeEdit',
        path: '/industry_type/:id/edit',
        component: IndustryTypeEdit
    },
    {
        name: 'industryTypeAdd',
        path: '/industry_type/add',
        component: IndustryTypeCreate
    }
]
