import { createRouter, createWebHistory } from 'vue-router';

import Main from '@/app/components/layouts/Main.vue';
import Empty from '@/app/components/layouts/Empty.vue';

import authRoutes from '@/modules/auth/routes';
import boxRoutes from '@/modules/box/routes';
import pageRoutes from '@/modules/page/routes';
import systemRoutes from '@/modules/system/routes';
import userRoutes from '@/modules/user/routes';

let mainLayout = [
    {
        path: '',
        component: () => import('@/app/views/Home.vue'),
    },
];

mainLayout = mainLayout.concat(boxRoutes);
mainLayout = mainLayout.concat(pageRoutes);
mainLayout = mainLayout.concat(systemRoutes);
mainLayout = mainLayout.concat(userRoutes);

let emptyLayout = authRoutes;

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
                    component: () => import('@/app/views/Error.vue'),
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
