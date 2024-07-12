import '../bootstrap';
import '../../css/app.css';

import { createApp } from 'vue';
import 'sweetalert';

import { createRouter, createWebHistory, useRoute } from 'vue-router';
import { createPinia } from 'pinia';
import { routes } from '@/Admin/routes';

// vue Router
const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

// Vue-x Pinia
const pinia = createPinia()

pinia.use(({ store }) => {
    store.router = markRaw(router);
    store.route = markRaw(useRoute());
  });

import AdminLayout from './Layouts/AdminLayout.vue';

const app = createApp();
app.use(pinia);
app.use(router);
app.component('admin-layout', AdminLayout)
app.mount('#app');


router.beforeEach((to, from, next) => {
    document.title = `ULS CMS | ${to.name? to.name : 'Home'}`;
    next()
});
