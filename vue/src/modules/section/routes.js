export default [
    {
        path: 'section',
        component: () => import('@/components/decorators/Empty.vue'),
        children: [
            {
                path: 'page',
                component: () => import('@/components/decorators/Empty.vue'),
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
                component: () => import('@/components/decorators/Empty.vue'),
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
