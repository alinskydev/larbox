<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/user/models/user';
import { IndexConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
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
    <PageTitle :text="title">
        <NotificationCreate />

        <RouterLink to="user/user/create" class="btn btn-primary">
            {{ App.t('routeActions->create') }}
        </RouterLink>
    </PageTitle>

    <Index :config="config" />
</template>
