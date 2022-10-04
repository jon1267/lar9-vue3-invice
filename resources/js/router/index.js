import { createRouter, createWebHashHistory } from 'vue-router';

import InvoiceIndex from '../components/invoices/index.vue';
import notFound from '../components/notFound.vue';

const routes = [
    {
        path: '/',
        component: InvoiceIndex
    },
    {
        path: '/:pathMatch(.*)*',
        component: notFound
    }
];

const router = createRouter({
    //history: createWebHashHistory(process.env.BASE_URL),//give error on process.env.BASE_URL
    history: createWebHashHistory(),
    routes,
});

export default router
