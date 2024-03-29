export default {
    path: 'system',
    component: () => import('@/components/decorators/Empty.vue'),
    children: [
        {
            path: 'settings/update',
            component: () => import('./views/settings/Update.vue'),
        },
        {
            path: 'language',
            component: () => import('@/components/decorators/Empty.vue'),
            children: [
                {
                    path: 'index',
                    component: () => import('./views/language/Index.vue'),
                },
                {
                    path: ':pk/show',
                    component: () => import('./views/language/Show.vue'),
                },
                {
                    path: ':pk/update',
                    component: () => import('./views/language/Update.vue'),
                },
            ],
        },
    ],
};
