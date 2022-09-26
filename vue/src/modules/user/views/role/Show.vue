<script setup>
import { Page } from '@/core/page';
import { ShowConfig } from '@/core/crud/config';
import model from '@/modules/user/models/role';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Show from '@/components/crud/Show.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routeActions->show'),
                breadcrumbs: [
                    {
                        label: this.__('routes->user.role'),
                        path: 'user/role',
                    },
                ],
            }),
            config: new ShowConfig({
                model: model,
                title: 'name.:locale',
                http: {
                    path: 'user/role/:id',
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title" />
    <Show />
</template>
