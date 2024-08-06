import '../bootstrap';
import '../../css/app.css';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import 'sweetalert';

import { createRouter, createWebHistory, useRoute } from 'vue-router';
import { createPinia } from 'pinia';
import { routes } from './routes.js';
import CKEditor from '@ckeditor/ckeditor5-vue'; //
import 'ckeditor5/ckeditor5.css'; //
import AdminLayout from './Layouts/AdminLayout.vue';
import 'ckeditor5-premium-features/ckeditor5-premium-features.css';

// vue Router
const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

// Vue-x Pinia
const pinia = createPinia()

// let previousRoute = null;
router.beforeEach((to, from, next) => {
    document.title = `ULS CMS | ${to.name? to.name : 'Home'}`;
    // previousRoute = from;
    next();
});

const app = createApp();
app.use(CKEditor); //
app.use(pinia);
app.use(router);
app.component('admin-layout', AdminLayout)
app.use(CKEditor);
app.component('ckeditor', CKEditor.component);

app.mount('#app');



// export {router, previousRoute};




// import GenericPages from './Layouts/GenericPagesLayout.vue';
// import ArticlePages from './Layouts/ArticlePagesLayout.vue';
// import QuickLinks from './Layouts/QuickLinksLayout.vue';
// import Accounts from './Layouts/AccountLayout.vue';
// import Faqs from './Layouts/FaqsLayout.vue'
// import Images from './Layouts/ImagesLayout.vue'

// app.component('generic-layout', GenericPages)
// app.component('article-layout', ArticlePages)
// app.component('faqs-layout', Faqs)
// app.component('quicklinks-layout', QuickLinks)
// app.component('images', Images)

// pinia.use(({ store }) => {
//     store.router = markRaw(router);
//     store.route = markRaw(useRoute());
//   });

