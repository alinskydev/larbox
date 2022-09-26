<script setup>
import { Page } from '@/core/page';
import { ShowConfig } from '@/core/crud/config';
import model from '@/modules/user/models/notification';

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
                        label: this.__('routes->user.notification'),
                        path: 'user/notification',
                    },
                ],
            }),
            config: new ShowConfig({
                model: model,
                title: 'id',
                http: {
                    path: 'user/notification/:id',
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
