const Login = () => import("@/components/Login.vue");
const Register = () => import("@/components/Register.vue");
export default [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`,
        },
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: {
            middleware: "guest",
            title: `Register`,
        },
    },
];
