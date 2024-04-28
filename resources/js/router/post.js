const Index = () => import("@/components/post/Index.vue");
const Add = () => import("@/components/post/Add.vue");
const Edit = () => import("@/components/post/Edit.vue");

export default [
    {
        name: "posts.create",
        path: "/posts/create",
        component: Add,
        meta: {
            title: `Post Lists`,
        },
    },
    {
        name: "posts",
        path: "/posts",
        component: Index,
        meta: {
            title: `Post Lists`,
        },
    },
    {
        name: "post.edit",
        path: "posts/edit/:id",
        component: Edit,
        meta: {
            title: `Edit Post`,
        },
    },
];
