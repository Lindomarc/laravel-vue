import Vue from "vue";
import Router from "vue-router";

Vue.use(Router)



const constantRoutes =  [
    { path: '/dashboard', component: require('../views/Dashboard.vue').default },
    { path: '/profile', component: require('../views/Profile.vue').default },
    // { path: '/developer', component: require('../views/Developer.vue').default },
    { path: '/users', component: require('../views/Users.vue').default },
    // { path: '/products', component: require('../views/product/Products.vue').default },
    // { path: '/product/tag', component: require('../views/product/Tag.vue').default },
    // { path: '/product/category', component: require('../views/product/Category.vue').default },
    { path: '*', component: require('../views/404.vue').default }

];

 

const createRouter = () => new Router({
    mode: 'history', // require service support
    scrollBehavior: () => ({ y: 0 }),
    routes: constantRoutes
})

const router = createRouter()

// Detail see: https://github.com/vuejs/vue-router/issues/1234#issuecomment-357941465
export function resetRouter() {
    const newRouter = createRouter()
    router.matcher = newRouter.matcher // reset router
}

export default router