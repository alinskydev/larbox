export default {
    path: 'system',
    component: () => import('@/components/decorators/Empty.vue'),
    children: [
        {
            path: 'settings',
            component: () => import('./views/settings/Update.vue'),
        },
        {
            path: 'language',
            component: () => import('@/components/decorators/Empty.vue'),
            children: [
                {
                    path: '',
                    component: () => import('./views/language/Index.vue'),
                },
                {
                    path: ':id/show',
                    component: () => import('./views/language/Show.vue'),
                },
                {
                    path: ':id/update',
                    component: () => import('./views/language/Update.vue'),
                },
            ],
        },
    ],
};
