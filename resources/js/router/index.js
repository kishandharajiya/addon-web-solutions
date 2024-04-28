import { createWebHistory, createRouter } from "vue-router";
import store from "../store/index";
/* Guest Component */
/* Layouts */
const DahboardLayout = () => import("@/components/layout/Default.vue");
/* Layouts */
/* Authenticated Component */
const Dashboard = () => import("@/components/Dashboard.vue");
import AuthRouter from "./auth.js";
import UserRouter from './user.js'
import PostRouter from './post.js'
/* Authenticated Component */
const routes = [
    ...AuthRouter,
    {
        path: "/",
        component: DahboardLayout,
        meta: {
            middleware: "auth",
        },
        children: [
            {
                name: "dashboard",
                path: "/",
                component: Dashboard,
                meta: {
                    title: `Dashboard`,
                },
            },
            ...UserRouter,
            ...PostRouter
        ],
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
});
router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    if (to.meta.middleware == "guest") {
        if (store.state.auth.authenticated) {
            next({ name: "dashboard" });
        }
        next();
    } else {
        if (store.state.auth.authenticated) {
            next();
        } else {
            next({ name: "login" });
        }
    }
});
export default router;
