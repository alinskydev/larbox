<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/user/models/user';
import { IndexConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import PageTitleButtons from '@/components/blocks/PageTitleButtons.vue';
import RouterLink from '@/components/blocks/RouterLink.vue';
import Index from '@/components/crud/Index.vue';

import NotificationCreate from '@/modules/user/components/notification/Create.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routes->user.user'),
            config: new IndexConfig({
                model: Model,
                http: {
                    path: 'user/user',
                },
                grid: {
                    actions: (record) => ['show', 'update', record.id !== 1 ? 'delete' : ''],
                },
            }),
        };
    },
    created() {
        Page.init({
            title: this.title,
        });
    },
};
</script>

<template>
    <PageTitle :text="title" />

    <PageTitleButtons>
        <NotificationCreate v-if="App.helpers.user.checkRoute('user/notification/create')" />

        <RouterLink to="user/user/create" class="btn btn-primary">
            {{ App.t('routeActions->create') }}
        </RouterLink>
    </PageTitleButtons>

    <Index :config="config" />
</template>
