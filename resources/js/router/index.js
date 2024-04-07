import { createRouter, createWebHistory } from "vue-router";

import ProductList from "@/components/ProductList.vue";
import ProductForm from "@/components/ProductForm.vue";
import ProductDetail from "@/components/ProductDetail.vue";
import ProductEdit from "@/components/ProductEdit.vue";
const routes = [
    {
        path: '/products',
        name: 'products',
        component: ProductList
    },
    {
        path: '/ProductForm',
        name: 'ProductForm',
        component: ProductForm
    },
    {
        path: '/ProductDetail/:id',
        name: 'ProductDetail',
        component: ProductDetail
    },
    {
        path: '/ProductEdit/:id',
        name: 'ProductEdit',
        component: ProductEdit
    },
   
]

export default createRouter({
    history: createWebHistory(),
    routes
})
