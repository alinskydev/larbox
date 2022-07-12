export default [
    {
        path: 'section',
        component: () => import('@/app/components/decorators/Empty.vue'),
        children: [
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
            {
                path: 'page',
                component: () => import('@/app/components/decorators/Empty.vue'),
                children: [
                    {
                        path: 'home',
                        component: () => import('./views/Home.vue'),
                    },
                    {
                        path: 'contact',
                        component: () => import('./views/Contact.vue'),
                    },
                    {
                        path: 'boxes',
                        component: () => import('./views/Boxes.vue'),
                    },
                ],
            },
        ],
    },
];
