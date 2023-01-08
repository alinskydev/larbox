export default {
    path: 'user',
    component: () => import('@/components/decorators/Empty.vue'),
    children: [
        {
            path: 'user',
            component: () => import('@/components/decorators/Empty.vue'),
            children: [
                {
                    path: 'index',
                    component: () => import('./views/user/Index.vue'),
                },
                {
                    path: ':pk/show',
                    component: () => import('./views/user/Show.vue'),
                },
                {
                    path: 'create',
                    component: () => import('./views/user/Create.vue'),
                },
                {
                    path: ':pk/update',
                    component: () => import('./views/user/Update.vue'),
                },
            ],
        },
        {
            path: 'role',
            component: () => import('@/components/decorators/Empty.vue'),
            children: [
                {
                    path: 'index',
                    component: () => import('./views/role/Index.vue'),
                },
                {
                    path: ':pk/show',
                    component: () => import('./views/role/Show.vue'),
                },
                {
                    path: 'create',
                    component: () => import('./views/role/Create.vue'),
                },
                {
                    path: ':pk/update',
                    component: () => import('./views/role/Update.vue'),
                },
            ],
        },
        {
            path: 'profile',
            component: () => import('./views/profile/Update.vue'),
        },
        {
            path: 'notification',
            component: () => import('@/components/decorators/Empty.vue'),
            children: [
                {
                    path: 'index',
                    component: () => import('./views/notification/Index.vue'),
                },
                {
                    path: ':pk/show',
                    component: () => import('./views/notification/Show.vue'),
                },
            ],
        },
    ],
};
