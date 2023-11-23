import { createRouter, createWebHistory } from 'vue-router';
import Index from "./views/Index.vue";
import About from "./views/About.vue";

const routes = [
    { path: '/', name: 'Index', component: Index },
    { path: '/about', name: 'About', component: About },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;
