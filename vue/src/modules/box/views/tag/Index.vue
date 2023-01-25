<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/box/models/tag';
import { IndexConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import RouterLink from '@/components/blocks/RouterLink.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routes->box.tag'),
            config: new IndexConfig({
                model: Model,
                http: {
                    path: 'box/tag',
                },
                selection: {
                    actions: ['deleteMultiple'],
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
        <RouterLink to="box/tag/create" class="btn btn-primary">
            {{ App.t('routeActions->create') }}
        </RouterLink>
    </PageTitle>

    <Index :config="config" />
</template>
