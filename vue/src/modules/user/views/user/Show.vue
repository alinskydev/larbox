<script setup>
import { Page } from '@/core/page';
import { ShowConfig } from '@/core/crud/config';
import model from '@/modules/user/models/user';

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
                        label: this.__('routes->user.user'),
                        path: 'user/user/index',
                    },
                ],
            }),
            config: new ShowConfig({
                model: model,
                title: 'username',
                http: {
                    path: 'user/user/:id',
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
