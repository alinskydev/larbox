export default [
    {
        path: 'auth',
        component: () => import("@/app/views/EmptyDecorator.vue"),
        children: [
            {
                path: 'login',
                component: () => import("./views/Login.vue"),
            },
        ],
    },
];
