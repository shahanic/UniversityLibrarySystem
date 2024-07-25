import '../bootstrap';
import '../../css/app.css';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import 'sweetalert';

import { createRouter, createWebHistory, useRoute } from 'vue-router';
import { createPinia } from 'pinia';
import { routes } from './routes';

import CKEditor from '@ckeditor/ckeditor5-vue';

// vue Router
const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

// pinia.use(({ store }) => {
//     store.router = markRaw(router);
//     store.route = markRaw(useRoute());
//   });

import AdminLayout from './Layouts/AdminLayout.vue';
// import GenericPages from './Layouts/GenericPagesLayout.vue';
// import ArticlePages from './Layouts/ArticlePagesLayout.vue';
// import QuickLinks from './Layouts/QuickLinksLayout.vue';
// import Accounts from './Layouts/AccountLayout.vue';
// import Faqs from './Layouts/FaqsLayout.vue'
// import Images from './Layouts/ImagesLayout.vue'

const app = createApp();

// Vue-x Pinia
const pinia = createPinia()

app.use(pinia);
app.use(router);
app.component('admin-layout', AdminLayout)
// app.component('generic-layout', GenericPages)
// app.component('article-layout', ArticlePages)
// app.component('faqs-layout', Faqs)
// app.component('quicklinks-layout', QuickLinks)
// app.component('images', Images)

app.use(CKEditor);
app.component('ck-editor');

app.mount('#app');

router.beforeEach((to, from, next) => {
    document.title = `ULS CMS | ${to.name? to.name : 'Home'}`;
    next()
});


