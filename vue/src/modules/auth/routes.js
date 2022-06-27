export default [
    {
        path: 'auth',
        component: () => import('@/app/components/decorators/Empty.vue'),
        children: [
            {
                path: 'login',
                component: () => import('./views/Login.vue'),
            },
        ],
    },
];
