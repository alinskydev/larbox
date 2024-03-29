export default {
    path: 'box',
    component: () => import('@/components/decorators/Empty.vue'),
    children: [
        {
            path: 'box',
            component: () => import('@/components/decorators/Empty.vue'),
            children: [
                {
                    path: 'index',
                    component: () => import('./views/box/Index.vue'),
                },
                {
                    path: ':pk/show',
                    component: () => import('./views/box/Show.vue'),
                },
                {
                    path: 'create',
                    component: () => import('./views/box/Create.vue'),
                },
                {
                    path: ':pk/update',
                    component: () => import('./views/box/Update.vue'),
                },
            ],
        },
        {
            path: 'brand',
            component: () => import('@/components/decorators/Empty.vue'),
            children: [
                {
                    path: 'index',
                    component: () => import('./views/brand/Index.vue'),
                },
                {
                    path: ':pk/show',
                    component: () => import('./views/brand/Show.vue'),
                },
                {
                    path: 'create',
                    component: () => import('./views/brand/Create.vue'),
                },
                {
                    path: ':pk/update',
                    component: () => import('./views/brand/Update.vue'),
                },
            ],
        },
        {
            path: 'category',
            component: () => import('@/components/decorators/Empty.vue'),
            children: [
                {
                    path: 'tree',
                    component: () => import('./views/category/Tree.vue'),
                },
            ],
        },
        {
            path: 'tag',
            component: () => import('@/components/decorators/Empty.vue'),
            children: [
                {
                    path: 'index',
                    component: () => import('./views/tag/Index.vue'),
                },
                {
                    path: ':pk/show',
                    component: () => import('./views/tag/Show.vue'),
                },
                {
                    path: 'create',
                    component: () => import('./views/tag/Create.vue'),
                },
                {
                    path: ':pk/update',
                    component: () => import('./views/tag/Update.vue'),
                },
            ],
        },
    ],
};
