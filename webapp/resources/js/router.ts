import { createRouter, createWebHistory, RouteLocationNormalized } from 'vue-router';
import Index from "./views/Index.vue";
import Article from "./views/Article.vue";
import About from "./views/About.vue";

const routes = [
    {
        path: '/',
        name: 'Index',
        component: Index
    },
    {
        path: "/articles/:id",
        name: "Article",
        component: Article,
        props: (routes: RouteLocationNormalized) => {
            const idNum = Number(routes.params.id);
            return {
                id: idNum
            };
        },
    },
    {
        path: '/about',
        name: 'About',
        component: About
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;
