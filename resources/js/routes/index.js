import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes =  [
    { path: '/dashboard', component: require('../views/Dashboard.vue').default },
    { path: '/profile', component: require('../views/Profile.vue').default },
    // { path: '/developer', component: require('../views/Developer.vue').default },
    { path: '/users', component: require('../views/Users.vue').default },
    { path: '/mdfes', component: require('../views/Mdfes.vue').default },
    { path: '/veiculos', component: require('../views/Vehicles.vue').default },
    { path: '/veiculos', component: require('../views/Vehicles.vue').default },
    // { path: '/products', component: require('../views/product/Products.vue').default },
    // { path: '/product/tag', component: require('../views/product/Tag.vue').default },
    // { path: '/product/category', component: require('../views/product/Category.vue').default },
    // { path: '*', component: require('../views/NotFound.vue').default }
];

const router = new VueRouter({
    mode: "history",
    // base: process.env.BASE_URL,
    routes,
});

export default router;
