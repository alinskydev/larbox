export default {
    path: 'box',
    component: () => import('@/components/decorators/Empty.vue'),
    children: [
        {
            path: 'box',
            component: () => import('@/components/decorators/Empty.vue'),
            children: [
                {
                    path: '',
                    component: () => import('./views/box/Index.vue'),
                },
                {
                    path: ':id/show',
                    component: () => import('./views/box/Show.vue'),
                },
                {
                    path: 'create',
                    component: () => import('./views/box/Create.vue'),
                },
                {
                    path: ':id/update',
                    component: () => import('./views/box/Update.vue'),
                },
            ],
        },
        {
            path: 'brand',
            component: () => import('@/components/decorators/Empty.vue'),
            children: [
                {
                    path: '',
                    component: () => import('./views/brand/Index.vue'),
                },
                {
                    path: ':id/show',
                    component: () => import('./views/brand/Show.vue'),
                },
                {
                    path: 'create',
                    component: () => import('./views/brand/Create.vue'),
                },
                {
                    path: ':id/update',
                    component: () => import('./views/brand/Update.vue'),
                },
            ],
        },
        {
            path: 'tag',
            component: () => import('@/components/decorators/Empty.vue'),
            children: [
                {
                    path: '',
                    component: () => import('./views/tag/Index.vue'),
                },
                {
                    path: ':id/show',
                    component: () => import('./views/tag/Show.vue'),
                },
                {
                    path: 'create',
                    component: () => import('./views/tag/Create.vue'),
                },
                {
                    path: ':id/update',
                    component: () => import('./views/tag/Update.vue'),
                },
            ],
        },
    ],
};
