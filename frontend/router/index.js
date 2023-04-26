import { createRouter, createWebHistory } from "vue-router";
import {isUserLoggedIn} from "@/auth/utils/useUserData";

let routes = [];

let routeFiles = require.context("./routes", true, /\.js$/);

routeFiles.keys().forEach((key) => {
    routes.push(...routeFiles(key).default);
});

const router = createRouter({
    history: createWebHistory(),
    base: '/',
    routes: [
        ...routes,
        {
            path: "/:pathMatch(.*)*",
                redirect: "error-404"
        }]
});

router.beforeEach((to, from, next) => {
    // check if the route has requires auth
    if (to.meta?.requiresAuth) {
        if (!isUserLoggedIn()) {
            next({ name: 'login' });
        }
    } else {
        if (to.meta?.redirectIfLoggedIn && isUserLoggedIn()) {
            next({ name: 'dashboard' });
        }
    }

    next();
});
export default router;
