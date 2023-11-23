import { createRouter, createWebHistory } from 'vue-router';
import sano from "./components/Sano.vue";
import sena from "./components/Sena.vue";

const routes = [
    { path: '/sano', name: 'sano', component: sano },
    { path: '/sena', name: 'sena', component: sena },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;
