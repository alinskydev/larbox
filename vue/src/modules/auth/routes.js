export default [
    {
        path: 'auth',
        component: () => import('@/components/decorators/Empty.vue'),
        children: [
            {
                path: 'login',
                component: () => import('./views/Login.vue'),
            },
        ],
    },
];
