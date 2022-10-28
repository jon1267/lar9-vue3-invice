import { createRouter, createWebHistory } from 'vue-router'; //

import InvoiceIndex from '../components/invoices/index.vue';
import NewInvoice   from '../components/invoices/NewInvoice.vue';
import ShowInvoice  from '../components/invoices/ShowInvoice.vue';
import EditInvoice  from '../components/invoices/EditInvoice.vue';
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
        path: '/invoice/edit/:id',
        component: EditInvoice,
        props: true
    },
    {
        path: '/:pathMatch(.*)*',
        component: notFound
    }
];

const router = createRouter({
    //history: createWebHashHistory(process.env.BASE_URL), //error on process.env.BASE_URL
    history: createWebHistory('/'),
    routes,
});

export default router
