<script setup>
import { Page } from '@/core/base/page';
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
                title: this.__('Просмотр'),
                breadcrumbs: [
                    {
                        label: this.__('Пользователи'),
                        path: 'user/user',
                    },
                ],
            }),
            config: new ShowConfig({
                model: model,
                http: {
                    path: 'user/user/:id',
                },
                titleField: 'username',
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title" />
    <Show />
</template>
