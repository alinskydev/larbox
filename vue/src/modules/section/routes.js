export default [
    {
        path: 'section',
        component: () => import('@/app/components/decorators/Empty.vue'),
        children: [
            {
                path: 'page',
                component: () => import('@/app/components/decorators/Empty.vue'),
                children: [
                    {
                        path: 'boxes',
                        component: () => import('./views/Boxes.vue'),
                    },
                    {
                        path: 'contact',
                        component: () => import('./views/Contact.vue'),
                    },
                    {
                        path: 'home',
                        component: () => import('./views/Home.vue'),
                    },
                ],
            },
            {
                path: 'section',
                component: () => import('@/app/components/decorators/Empty.vue'),
                children: [
                    {
                        path: 'layout',
                        component: () => import('./views/Layout.vue'),
                    },
                ],
            },
        ],
    },
];
