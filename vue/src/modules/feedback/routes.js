export default {
    path: 'feedback',
    component: () => import('@/components/decorators/Empty.vue'),
    children: [
        {
            path: 'callback',
            component: () => import('@/components/decorators/Empty.vue'),
            children: [
                {
                    path: 'index',
                    component: () => import('./views/callback/Index.vue'),
                },
                {
                    path: ':pk/show',
                    component: () => import('./views/callback/Show.vue'),
                },
            ],
        },
    ],
};
