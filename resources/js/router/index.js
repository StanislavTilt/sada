import { createWebHistory, createRouter } from "vue-router";
import Dashboard from '../components/dashboard.vue';
import Login from '../components/auth/login.vue';
import Users from '../components/users/users.vue';
import CropImage from '../components/cropImage.vue';


const routes = [
    { path: '/', name: "dashboard", component: Dashboard },
    { path: '/login',  name:"login", component: Login },
    { path: '/users',  name:"users", component: Users },
    { path: '/crop-image',  name:"cropImage", component: CropImage },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
