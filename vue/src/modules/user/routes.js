export default [
    {
        path: 'user',
        component: () => import('@/components/decorators/Empty.vue'),
        children: [
            {
                path: 'notification',
                component: () => import('@/components/decorators/Empty.vue'),
                children: [
                    {
                        path: '',
                        component: () => import('./views/notification/Index.vue'),
                    },
                    {
                        path: ':id/show',
                        component: () => import('./views/notification/Show.vue'),
                    },
                ],
            },
            {
                path: 'profile',
                component: () => import('@/components/decorators/Empty.vue'),
                children: [
                    {
                        path: '',
                        component: () => import('./views/profile/Update.vue'),
                    },
                ],
            },
            {
                path: 'user',
                component: () => import('@/components/decorators/Empty.vue'),
                children: [
                    {
                        path: '',
                        component: () => import('./views/user/Index.vue'),
                    },
                    {
                        path: ':id/show',
                        component: () => import('./views/user/Show.vue'),
                    },
                    {
                        path: 'create',
                        component: () => import('./views/user/Create.vue'),
                    },
                    {
                        path: ':id/update',
                        component: () => import('./views/user/Update.vue'),
                    },
                ],
            },
        ],
    },
];
