export default [
    {
        path: 'page',
        component: () => import('@/app/components/decorators/Empty.vue'),
        children: [
            {
                path: ':name',
                component: () => import('./views/Update.vue'),
            },
        ],
    },
];
