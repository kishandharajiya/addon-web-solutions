const Index = () => import("@/components/user/Index.vue");
const Edit = () => import("@/components/user/Edit.vue");

export default [
    {
        name: "users",
        path: "/users",
        component: Index,
        meta: {
            title: `User Lists`,
        },
    },
    {
        name: "user.edit",
        path: "users/edit/:id",
        component: Edit,
        meta: {
            title: `Edit User`,
        },
    },
];
