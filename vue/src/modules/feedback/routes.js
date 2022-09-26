export default {
    path: 'feedback',
    component: () => import('@/components/decorators/Empty.vue'),
    children: [
        {
            path: 'callback',
            component: () => import('@/components/decorators/Empty.vue'),
            children: [
                {
                    path: '',
                    component: () => import('./views/callback/Index.vue'),
                },
                {
                    path: ':id/show',
                    component: () => import('./views/callback/Show.vue'),
                },
            ],
        },
    ],
};
