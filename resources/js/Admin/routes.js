import Index from "./Pages/Index.vue";
import Navigation from "./Pages/Navigation.vue";
import SubNavigation from "./Pages/SubNavigation.vue";
import ArticlePages from "./Pages/ArticlePages.vue";
import GenericPages from "./Pages/GenericPages.vue";
import Faqs from "./Pages/Faqs.vue";
import QuickLinks from "./Pages/QuickLinks.vue";
import Accounts from "./Pages/Accounts.vue";
import Images from "./Pages/Images.vue";
import Pages from "./Pages/Pages.vue";


export const routes = [
    {
        path: '/super-user',
        name: "Dashboard",
        component: Index
    }, 
        
    {
        path: '/navigation',
        name: "Navigation",
        component: Navigation
    },
    
    {
        path: '/generic-pages',
        name: "GenericPages",
        component: GenericPages
    },

    {
        path: '/article-pages',
        name: "ArticlePages",
        component: ArticlePages
    },

    {
        path: '/faqs',
        name: "Faqs",
        component: Faqs
    },

    {
        path: '/quick-links',
        name: "QuickLinks",
        component: QuickLinks
    },

    {
        path: '/images',
        name: "Images",
        component: Images
    },

    {
        path: '/accounts',
        name: "Accounts",
        component: Accounts
    },

    {
        path: '/subnav/:id',
        name: "SubNavigation",
        component: SubNavigation
    },

    {
        path: '/pages/:id',
        name: "Pages",
        component: Pages
    },
 



];

