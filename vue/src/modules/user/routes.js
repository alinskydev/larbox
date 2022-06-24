export default [
    {
        path: 'user',
        component: () => import("@/app/views/EmptyDecorator.vue"),
        children: [
            {
                path: 'user',
                component: () => import("@/app/views/EmptyDecorator.vue"),
                children: [
                    {
                        path: '',
                        component: () => import("./views/user/Index.vue"),
                    },
                    {
                        path: ':id/show',
                        component: () => import("./views/user/Show.vue"),
                    },
                    {
                        path: 'create',
                        component: () => import("./views/user/Create.vue"),
                    },
                    {
                        path: ':id/update',
                        component: () => import("./views/user/Update.vue"),
                    },
                ],
            },
            {
                path: 'profile',
                component: () => import("@/app/views/EmptyDecorator.vue"),
                children: [
                    {
                        path: '',
                        component: () => import("./views/profile/Update.vue"),
                    },
                ],
            },
        ],
    },
];
