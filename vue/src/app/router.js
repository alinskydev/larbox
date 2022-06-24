import { createRouter, createWebHistory } from "vue-router";
import Wrapper from "@/app/views/_Wrapper.vue";
import NoWrapper from "@/app/views/_NoWrapper.vue";
import Home from "@/app/views/Home.vue";
import Error from "@/app/views/Error.vue";

import authRoutes from "@/modules/auth/routes";
import boxRoutes from "@/modules/box/routes";
import systemRoutes from "@/modules/system/routes";
import userRoutes from "@/modules/user/routes";

let wrappedRoutes = [
    {
        path: "",
        component: Home,
    },
];

wrappedRoutes = wrappedRoutes.concat(boxRoutes);
wrappedRoutes = wrappedRoutes.concat(systemRoutes);
wrappedRoutes = wrappedRoutes.concat(userRoutes);

let nonWrappedRoutes = authRoutes;

export default createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/:locale",
            component: Wrapper,
            children: wrappedRoutes,
        },
        {
            path: "/",
            component: Wrapper,
            children: wrappedRoutes,
        },
        {
            path: "/",
            component: NoWrapper,
            children: nonWrappedRoutes.concat([
                {
                    path: "/:pathMatch(.*)*",
                    component: Error,
                },
            ]),
        },
        {
            path: "/:locale",
            component: NoWrapper,
            children: nonWrappedRoutes,
        },
    ],
});
