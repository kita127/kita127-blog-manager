import { createRouter, createWebHistory, RouteLocationNormalized } from 'vue-router';
import Index from "./views/Index.vue";
import Article from "./views/Article.vue";

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
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;
