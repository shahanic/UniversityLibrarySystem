import Index from "./Pages/Index.vue";
import Navigation from "./Pages/Navigation.vue";
import ArticlePages from "./Pages/ArticlePages.vue";
import ArticlePage from "./Pages/ArticlePage.vue";
import GenericPage from "./Pages/GenericPage.vue";
import GenericPages from "./Pages/GenericPages.vue";
import EditGenericPage from "./Pages/EditGenericPage.vue";
import Faqs from "./Pages/Faqs.vue";
import QuickLinks from "./Pages/QuickLinks.vue";
import Accounts from "./Pages/Accounts.vue";
import Images from "./Pages/Images.vue";
import SubNavigation from "./Pages/SubNavigation.vue";
import Pages from "./Pages/Pages.vue";
import SaveGeneric from "./Pages/SaveGeneric.vue";

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
        path: '/generic-page/:id',
        name: "GenericPage",
        component: GenericPage
    },

    {
        path: '/generic-pages',
        name: "GenericPages",
        component: GenericPages
    },

    {
        path: '/edit-generic-page/:id',
        name: "EditGenericPage",
        component: EditGenericPage
    },

    {
        path: '/pages/:id',
        name: "Pages",
        component: Pages
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
        path: '/article-page/:id/:vue(.*)*',
        name: "ArticlePage",
        component: ArticlePage
    },

    {
        path: '/article-pages',
        name: "ArticlePages",
        component: ArticlePages
    },

    {
        path: '/add-new-page',
        name: 'SaveGeneric',
        component: SaveGeneric 
      },


 

];

