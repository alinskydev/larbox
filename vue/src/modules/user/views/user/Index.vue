<script setup>
import { Page } from '@/app/core/page';
import { IndexConfig } from '@/app/core/crud/config';
import model from '@/modules/user/models/user';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import RouterLink from '@/app/components/blocks/RouterLink.vue';
import Index from '@/app/components/crud/Index.vue';

import NotificationCreate from '@/modules/user/components/notification/Create.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('Пользователи'),
            }),
            config: new IndexConfig({
                model: model,
                http: {
                    path: 'user/user',
                },
                hasSoftDelete: true,
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <NotificationCreate />

        <RouterLink to="user/user/create" class="btn btn-success">
            {{ __('Создать') }}
        </RouterLink>
    </PageTitle>

    <Index />
</template>
