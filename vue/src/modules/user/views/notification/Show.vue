<script setup>
import { Page } from '@/app/core/page';
import { ShowConfig } from '@/app/core/crud/config';
import model from '@/modules/user/models/notification';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Show from '@/app/components/crud/Show.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('Просмотр'),
                breadcrumbs: [
                    {
                        label: this.__('Уведомления'),
                        path: 'user/notification',
                    },
                ],
            }),
            config: new ShowConfig({
                model: model,
                http: {
                    path: 'user/notification/:id',
                },
                titleField: 'id',
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title" />
    <Show />
</template>
