import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from '../pages/Login.vue';
import Main from '../pages/Main.vue';
import Article from '../pages/Admin/Article.vue'

// VIEWS 
import ArticleView from '../pages/Admin/views/Article.vue';

// FORMS
import ArticleForm from '../pages/Admin/views/ArticleForm.vue'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active-route',
    routes: [
        {
            path: '',
            redirect: '/dashboard'
        },
        {
            path: '',
            name: 'main',
            component: Main,
            meta: {
                requiresAuth: true
            },
            children : [
                {
                    path: '/dashboard',
                    name: 'dashboard',
                    component: Dashboard,
                },
     
                {
                    path: '/articles',
                    name: 'articles',
                    component : Article
                },
                {
                    path : '/article/create',
                    name : 'article_create',
                    component : ArticleForm
                },
                {
                    path : '/article/edit/:id',
                    name : 'article_edit',
                    component : ArticleForm
                },
                {
                    path: '/article-show/:id',
                    name: 'article_show',
                    component: ArticleView
                },
            ]
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                requiresAuth: false
            },
        },
    ]
});

router.beforeEach(async (to, from, next) => {
    localStorage.setItem('from', from.fullPath)
    // let user = null
    const user = localStorage.getItem('token')            
    // try {
    //     user = await store.dispatch('updateUser') 
    // } catch (error) {
    //     user = null
    // }

    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    
    if (!requiresAuth && user) {
        console.log('not require auth but there is user')
        next(from)
    } else if (requiresAuth && !user) {
        console.log('require auth there is no user')
        next('/login');
    } else {
        console.log('next')
        next();
    }

})

export default router;