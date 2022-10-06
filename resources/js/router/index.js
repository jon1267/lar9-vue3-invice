import { createRouter, createWebHashHistory } from 'vue-router';

import InvoiceIndex from '../components/invoices/index.vue';
import NewInvoice   from '../components/invoices/NewInvoice.vue';
import notFound from '../components/notFound.vue';

const routes = [
    {
        path: '/',
        component: InvoiceIndex
    },
    {
        path: '/invoice/new',
        component: NewInvoice
    },
    {
        path: '/:pathMatch(.*)*',
        component: notFound
    }
];

const router = createRouter({
    history: createWebHashHistory(), //history: createWebHashHistory(process.env.BASE_URL),//error on process.env.BASE_URL
    routes,
});

export default router
