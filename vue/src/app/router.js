import { createRouter, createWebHistory } from 'vue-router';

import Main from '@/components/layouts/Main.vue';
import Empty from '@/components/layouts/Empty.vue';

import authRoutes from '@/modules/auth/routes';
import boxRoutes from '@/modules/box/routes';
import feedbackRoutes from '@/modules/feedback/routes';
import sectionRoutes from '@/modules/section/routes';
import systemRoutes from '@/modules/system/routes';
import userRoutes from '@/modules/user/routes';

let mainLayout = [
    {
        path: '',
        component: () => import('@/components/views/Home.vue'),
    },
    boxRoutes,
    feedbackRoutes,
    sectionRoutes,
    systemRoutes,
    userRoutes,
];

let emptyLayout = [authRoutes];

export default createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            component: Main,
            children: mainLayout,
        },
        {
            path: '/:locale',
            component: Main,
            children: mainLayout,
        },
        {
            path: '/',
            component: Empty,
            children: emptyLayout.concat([
                {
                    path: '/:pathMatch(.*)*',
                    component: () => import('@/components/views/Error.vue'),
                },
            ]),
        },
        {
            path: '/:locale',
            component: Empty,
            children: emptyLayout,
        },
    ],
});
