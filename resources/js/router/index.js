import { createRouter, createWebHistory } from 'vue-router';

import InvoiceIndex from '../components/invoices/index.vue';
import NewInvoice   from '../components/invoices/NewInvoice.vue';
import ShowInvoice  from '../components/invoices/ShowInvoice.vue';
import notFound     from '../components/notFound.vue';

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
        path: '/invoice/show/:id',
        component: ShowInvoice,
        props: true
    },
    {
        path: '/:pathMatch(.*)*',
        component: notFound
    }
];

const router = createRouter({
    history: createWebHistory('/'), //history: createWebHashHistory(process.env.BASE_URL),//error on process.env.BASE_URL
    routes,
});

export default router
