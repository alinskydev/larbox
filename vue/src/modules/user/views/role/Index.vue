<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/user/models/role';
import { IndexConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import PageTitleButtons from '@/components/blocks/PageTitleButtons.vue';
import RouterLink from '@/components/blocks/RouterLink.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routes->user.role'),
            config: new IndexConfig({
                model: Model,
                http: {
                    path: 'user/role',
                },
                grid: {
                    actions: (record) => record.id !== 1 ? ['show', 'update', 'delete'] : [],
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
        <RouterLink to="user/role/create" class="btn btn-primary">
            {{ App.t('routeActions->create') }}
        </RouterLink>
    </PageTitleButtons>

    <Index :config="config" />
</template>
