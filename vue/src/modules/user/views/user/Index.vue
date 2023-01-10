<script setup>
import { Page } from '@/core/page';
import { IndexConfig } from '@/core/crud/config';
import model from '@/modules/user/models/user';

import PageTitle from '@/components/blocks/PageTitle.vue';
import RouterLink from '@/components/blocks/RouterLink.vue';
import Index from '@/components/crud/Index.vue';

import NotificationCreate from '@/modules/user/components/notification/Create.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routes->user.user'),
            }),
            config: new IndexConfig({
                model: model,
                http: {
                    path: 'user/user',
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <NotificationCreate />

        <RouterLink to="user/user/create" class="btn btn-success">
            {{ __('routeActions->create') }}
        </RouterLink>
    </PageTitle>

    <Index />
</template>
